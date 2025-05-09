<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class GenerateDBML extends Command
{
    protected $signature = 'generate:dbml';
    protected $description = 'Generate DBML file from Laravel migrations';    public function handle()
    {
        $this->info('Generating DBML from migrations...');

        // Tables to explicitly exclude (like comments)
        $excludedTables = ['comments'];

        $migrationsPath = database_path('migrations');
        $migrations = File::glob($migrationsPath . '/*.php');

        // Sort migrations by date to process in chronological order
        usort($migrations, function($a, $b) {
            return basename($a) <=> basename($b);
        });

        $dbml = "// Database schema for YallaDiscover\n\n";
        $tables = [];
        $references = [];
        $droppedTables = $excludedTables; // Start with predefined excluded tables

        foreach ($migrations as $migration) {
            $content = File::get($migration);

            // Check for dropped tables in migration filenames that clearly indicate table removal
            if (str_contains(basename($migration), 'drop_') || str_contains(basename($migration), 'remove_')) {
                if (preg_match('/Schema::dropIfExists\([\'"](.+?)[\'"]\)/s', $content, $dropMatches)) {
                    $droppedTable = $dropMatches[1];
                    $droppedTables[] = $droppedTable;
                    $this->info("Found dropped table: {$droppedTable}");

                    // Remove from tables if previously added
                    if (isset($tables[$droppedTable])) {
                        unset($tables[$droppedTable]);
                    }

                    // Remove any references to/from this table
                    $references = array_filter($references, function($ref) use ($droppedTable) {
                        return !str_contains($ref, $droppedTable . '.');
                    });
                }
                continue;
            }

            $tableName = $this->getTableName($content);

            if (!$tableName) continue;

            // Skip if this table is excluded or was dropped in a later migration
            if (in_array($tableName, $droppedTables) || in_array($tableName, $excludedTables)) {
                continue;
            }

            $this->info("Processing migration for table: {$tableName}");

            // Extract table definition
            if (preg_match('/Schema::create\([\'"]' . $tableName . '[\'"],\s*function\s*\(Blueprint\s*\$table\)\s*{(.+?)}\);/s', $content, $matches)) {
                $tableDefinition = $matches[1];

                $columns = $this->extractColumns($tableDefinition);
                if (empty($columns)) continue;

                $tables[$tableName] = $columns;

                // Extract references
                $refs = $this->extractReferences($tableDefinition, $tableName);
                if (!empty($refs)) {
                    $references = array_merge($references, $refs);
                }
            }
        }

        // Generate DBML content
        foreach ($tables as $table => $columns) {
            // Skip excluded tables
            if ($table === 'comments' || in_array($table, $droppedTables)) {
                continue;
            }

            $dbml .= "Table {$table} {\n";
            foreach ($columns as $column) {
                $dbml .= "  {$column}\n";
            }
            $dbml .= "}\n\n";
        }

        // Add references, but filter out any related to dropped tables
        foreach ($references as $reference) {
            // Skip references related to comments or any excluded table
            $skipReference = false;

            foreach ($droppedTables as $droppedTable) {
                if (str_contains($reference, "$droppedTable.") || str_contains($reference, "> $droppedTable.")) {
                    $skipReference = true;
                    break;
                }
            }

            if (!$skipReference) {
                $dbml .= $reference . "\n";
            }
        }

        // Save DBML file
        $dbmlPath = base_path('database-schema.dbml');
        File::put($dbmlPath, $dbml);

        $this->info("DBML file generated at: {$dbmlPath}");
        return SymfonyCommand::SUCCESS;
    }

    private function getTableName($content)
    {
        if (preg_match('/Schema::create\([\'"](.+?)[\'"]/s', $content, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function extractColumns($tableDefinition)
    {
        $columns = [];

        // Match column definitions
        preg_match_all('/\$table->(\w+)\(?(.*?)\)?->(\w+\(\)|\w+\([^)]+\)|\w+)*;/s', $tableDefinition, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $type = $match[1];
            $name = trim($match[2], '\'"(), ');
            $modifiers = isset($match[3]) ? $match[3] : '';

            // Skip timestamps and softDeletes
            if (in_array($type, ['timestamps', 'softDeletes']) && empty($name)) {
                if ($type === 'timestamps') {
                    $columns[] = "created_at timestamp";
                    $columns[] = "updated_at timestamp";
                } elseif ($type === 'softDeletes') {
                    $columns[] = "deleted_at timestamp";
                }
                continue;
            }

            // Format column definition
            $columnDef = "{$name} ";

            // Map Laravel column types to DBML types
            switch ($type) {
                case 'bigIncrements':
                case 'increments':
                    $columnDef .= "int [pk, increment]";
                    break;
                case 'string':
                    $columnDef .= "varchar";
                    break;
                case 'integer':
                case 'unsignedInteger':
                case 'bigInteger':
                case 'unsignedBigInteger':
                    $columnDef .= "int";
                    break;
                case 'boolean':
                    $columnDef .= "boolean";
                    break;
                case 'text':
                case 'longText':
                    $columnDef .= "text";
                    break;
                case 'dateTime':
                case 'timestamp':
                    $columnDef .= "timestamp";
                    break;
                case 'date':
                    $columnDef .= "date";
                    break;
                case 'decimal':
                case 'double':
                case 'float':
                    $columnDef .= "decimal";
                    break;
                case 'json':
                case 'jsonb':
                    $columnDef .= "json";
                    break;
                default:
                    $columnDef .= $type;
            }

            // Add modifiers
            if (str_contains($modifiers, 'nullable')) {
                $columnDef .= " [null]";
            }

            if (str_contains($modifiers, 'unique')) {
                $columnDef .= " [unique]";
            }

            $columns[] = $columnDef;
        }

        return $columns;
    }

    private function extractReferences($tableDefinition, $fromTable)
    {
        $references = [];

        // Match foreign key constraints
        preg_match_all('/\$table->foreign\([\'"](.+?)[\'"]\)(?:->references\([\'"](.+?)[\'"]\))?(?:->on\([\'"](.+?)[\'"]\))?/s', $tableDefinition, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $foreignKey = $match[1];
            $referencedColumn = isset($match[2]) ? $match[2] : 'id';
            $referencedTable = isset($match[3]) ? $match[3] : '';

            if ($referencedTable) {
                // Skip references to the comments table
                if ($referencedTable === 'comments' || $fromTable === 'comments') {
                    continue;
                }
                $references[] = "Ref: {$fromTable}.{$foreignKey} > {$referencedTable}.{$referencedColumn}";
            }
        }

        // Look for common foreign key patterns (e.g., user_id referencing users)
        preg_match_all('/\$table->(?:unsignedBigInteger|integer|bigInteger|foreignId)\([\'"](\w+)_id[\'"]\)/s', $tableDefinition, $idMatches, PREG_SET_ORDER);

        foreach ($idMatches as $match) {
            $referencedTable = Str::plural($match[1]);  // Assume plural table names
            $foreignKey = "{$match[1]}_id";

            // Skip references to the comments table
            if ($referencedTable === 'comments' || $fromTable === 'comments') {
                continue;
            }

            $references[] = "Ref: {$fromTable}.{$foreignKey} > {$referencedTable}.id";
        }

        return $references;
    }
}
