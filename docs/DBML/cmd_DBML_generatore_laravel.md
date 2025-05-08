# Laravel DBML Generator

This README provides a comprehensive guide to using the custom `generate:dbml` Artisan command for visualizing your Laravel database structure in VS Code using DBML (Database Markup Language).

## Table of Contents

1. [Overview](#overview)
2. [Installation](#installation)
3. [How to Use](#how-to-use)
4. [Understanding the GenerateDBML Command](#understanding-the-generatedbml-command)
   - [Main Command Logic](#main-command-logic)
   - [Table Name Extraction](#table-name-extraction)
   - [Column Extraction](#column-extraction)
   - [Reference Extraction](#reference-extraction)
5. [Behind the Scenes: How DBML Works](#behind-the-scenes-how-dbml-works)
6. [Visualizing Your Database](#visualizing-your-database)
7. [Maintaining Your Database Diagrams](#maintaining-your-database-diagrams)
8. [Troubleshooting](#troubleshooting)

## Overview

The Laravel DBML Generator creates a visual representation of your database schema directly from your Laravel migration files. It transforms your migrations into DBML (Database Markup Language) format, which can then be visualized using VS Code extensions.

With this tool, you can:
- Generate a complete DBML representation of your database
- Visualize tables, columns, and relationships
- Keep your database documentation up to date

## Installation

### 1. Create the Command File

Create a new file at `app/Console/Commands/GenerateDBML.php` with the following content:

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateDBML extends Command
{
    protected $signature = 'generate:dbml';
    protected $description = 'Generate DBML file from Laravel migrations';

    public function handle()
    {
        $this->info('Generating DBML from migrations...');

        $migrationsPath = database_path('migrations');
        $migrations = File::glob($migrationsPath . '/*.php');

        $dbml = "// Database schema for YallaDiscover\n\n";
        $tables = [];
        $references = [];

        foreach ($migrations as $migration) {
            $content = File::get($migration);
            $tableName = $this->getTableName($content);

            if (!$tableName) continue;

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
            $dbml .= "Table {$table} {\n";
            foreach ($columns as $column) {
                $dbml .= "  {$column}\n";
            }
            $dbml .= "}\n\n";
        }

        // Add references
        foreach ($references as $reference) {
            $dbml .= $reference . "\n";
        }

        // Save DBML file
        $dbmlPath = base_path('database-schema.dbml');
        File::put($dbmlPath, $dbml);

        $this->info("DBML file generated at: {$dbmlPath}");
        return Command::SUCCESS;
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
                $references[] = "Ref: {$fromTable}.{$foreignKey} > {$referencedTable}.{$referencedColumn}";
            }
        }

        // Look for common foreign key patterns (e.g., user_id referencing users)
        preg_match_all('/\$table->(?:unsignedBigInteger|integer|bigInteger|foreignId)\([\'"](\w+)_id[\'"]\)/s', $tableDefinition, $idMatches, PREG_SET_ORDER);

        foreach ($idMatches as $match) {
            $referencedTable = Str::plural($match[1]);  // Assume plural table names
            $foreignKey = "{$match[1]}_id";
            $references[] = "Ref: {$fromTable}.{$foreignKey} > {$referencedTable}.id";
        }

        return $references;
    }
}
```

### 2. Register the Command

In `app/Console/Kernel.php`, add your command to the `$commands` array:

```php
protected $commands = [
    // Other commands...
    \App\Console\Commands\GenerateDBML::class,
];
```

### 3. Install Required VS Code Extensions

Install the following VS Code extensions:

1. **DBML Entity-Relationship Diagrams Visualizer** (`bocovo.dbml-erd-visualizer`)
   - This extension visualizes DBML files as ERD diagrams

2. **MySQL** (optional, for direct database viewing) (`cweijan.vscode-mysql-client2`)
   - If you want to also connect directly to your database

## How to Use

1. Run the command from your terminal:

```bash
php artisan generate:dbml
```

2. This will generate a `database-schema.dbml` file at the root of your project.

3. Open the DBML file in VS Code:

```bash
code database-schema.dbml
```

4. To visualize the diagram:
   - Press `Ctrl+Shift+P` (or `Cmd+Shift+P` on macOS)
   - Type "DBML: Show diagram" and select it
   - The diagram will open in a new tab

## Understanding the GenerateDBML Command

Let's dive deep into how the command works behind the scenes:

### Main Command Logic

The `handle()` method is the entry point for the command execution. Here's what it does step by step:

1. **Initialization**:
   ```php
   $migrationsPath = database_path('migrations');
   $migrations = File::glob($migrationsPath . '/*.php');
   $dbml = "// Database schema for YallaDiscover\n\n";
   $tables = [];
   $references = [];
   ```
   - Locates all migration files in your project
   - Initializes the DBML content with a header
   - Creates empty arrays for tables and references

2. **Processing Each Migration**:
   ```php
   foreach ($migrations as $migration) {
       $content = File::get($migration);
       $tableName = $this->getTableName($content);
       // ...processing...
   }
   ```
   - Reads each migration file
   - Extracts the table name using a regular expression
   - Processes each identified table

3. **Extracting Table Definitions**:
   ```php
   if (preg_match('/Schema::create\([\'"]' . $tableName . '[\'"],\s*function\s*\(Blueprint\s*\$table\)\s*{(.+?)}\);/s', $content, $matches)) {
       $tableDefinition = $matches[1];
       // ...processing...
   }
   ```
   - Uses a complex regex to extract the table definition block
   - Captures everything between the opening and closing braces of the Schema::create callback

4. **Building DBML Structure**:
   ```php
   foreach ($tables as $table => $columns) {
       $dbml .= "Table {$table} {\n";
       foreach ($columns as $column) {
           $dbml .= "  {$column}\n";
       }
       $dbml .= "}\n\n";
   }
   ```
   - Formats each table and its columns in DBML syntax
   - Adds relationships at the end of the file

5. **Saving The Result**:
   ```php
   $dbmlPath = base_path('database-schema.dbml');
   File::put($dbmlPath, $dbml);
   ```
   - Writes the generated DBML to a file at your project root

### Table Name Extraction

The `getTableName()` method uses regex to find the table name in Schema::create statements:

```php
private function getTableName($content)
{
    if (preg_match('/Schema::create\([\'"](.+?)[\'"]/s', $content, $matches)) {
        return $matches[1];
    }
    return null;
}
```

This regex looks for:
- The text `Schema::create(`
- Followed by a string in single or double quotes
- The captured group `(.+?)` extracts the table name

### Column Extraction

The `extractColumns()` method is the most complex part, responsible for parsing column definitions:

```php
private function extractColumns($tableDefinition)
{
    $columns = [];
    
    // Match column definitions
    preg_match_all('/\$table->(\w+)\(?(.*?)\)?->(\w+\(\)|\w+\([^)]+\)|\w+)*;/s', $tableDefinition, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        // ...processing...
    }
    
    return $columns;
}
```

Let's break down the regex:
- `\$table->(\w+)` - Matches the column type (e.g., `string`, `integer`)
- `\(?(.*?)\)?` - Optionally matches parameters in parentheses
- `->(\w+\(\)|\w+\([^)]+\)|\w+)*` - Matches method chains for modifiers like `->nullable()`
- `;` - Matches the semicolon at the end of the statement

For each matched column, the method:
1. Extracts the type, name, and modifiers
2. Handles special cases like `timestamps()` and `softDeletes()`
3. Maps Laravel column types to DBML types
4. Adds modifiers like `[null]` for nullable columns

### Reference Extraction

The `extractReferences()` method identifies relationships between tables:

```php
private function extractReferences($tableDefinition, $fromTable)
{
    $references = [];
    
    // Match foreign key constraints
    preg_match_all('/\$table->foreign\([\'"](.+?)[\'"]\)(?:->references\([\'"](.+?)[\'"]\))?(?:->on\([\'"](.+?)[\'"]\))?/s', $tableDefinition, $matches, PREG_SET_ORDER);
    
    // ...processing...
    
    // Look for common foreign key patterns
    preg_match_all('/\$table->(?:unsignedBigInteger|integer|bigInteger|foreignId)\([\'"](\w+)_id[\'"]\)/s', $tableDefinition, $idMatches, PREG_SET_ORDER);
    
    // ...processing...
    
    return $references;
}
```

This method uses two different approaches to find relationships:

1. **Explicit Foreign Keys**:
   - Looks for `$table->foreign('column')->references('ref_column')->on('ref_table')`
   - Creates a reference in the format: `Ref: table.column > ref_table.ref_column`

2. **Implied Foreign Keys**:
   - Looks for columns named like `user_id`, `product_id`, etc.
   - Assumes they reference the `id` column on the plural table name (e.g., `users`, `products`)
   - Uses Laravel's `Str::plural()` to convert singular to plural

## Behind the Scenes: How DBML Works

DBML (Database Markup Language) is a simple, readable DSL (Domain-Specific Language) for documenting database schemas. Here's what happens when you generate and visualize a DBML file:

### 1. DBML Syntax

The generator creates a text file with DBML syntax:

```
Table users {
  id int [pk, increment]
  name varchar
  email varchar [unique]
  email_verified_at timestamp [null]
  password varchar
  created_at timestamp
  updated_at timestamp
}

Table cities {
  id int [pk, increment]
  name varchar
  description text [null]
  image varchar [null]
  latitude decimal [null]
  longitude decimal [null]
  created_at timestamp
  updated_at timestamp
}

Ref: stadiums.city_id > cities.id
```

The syntax consists of:
- `Table` definitions with names and column lists
- Column type definitions (e.g., `int`, `varchar`)
- Column attributes in square brackets (e.g., `[pk, increment]`, `[null]`)
- `Ref:` statements defining relationships between tables

### 2. Parser Interpretation

When you open the visualization in VS Code:

1. The DBML extension parses the text file
2. It builds an internal representation of:
   - Tables and their structures
   - Column types and constraints
   - Relationships between tables

3. The parser validates the syntax and creates a graph data structure

### 3. Visualization Rendering

The extension then renders the diagram:

1. Tables are represented as boxes
2. Columns are listed within each table
3. Primary keys and unique constraints are highlighted
4. Relationships are drawn as lines connecting tables
5. The layout algorithm positions tables to minimize crossing lines

## Visualizing Your Database

After generating your DBML file, you can visualize it in VS Code:

1. Open the DBML file in VS Code
2. Press `Ctrl+Shift+P` (or `Cmd+Shift+P` on macOS)
3. Type "DBML: Show diagram" and select it

The resulting diagram will show:

- All your project's tables (users, cities, stadiums, teams, matches, etc.)
- Columns within each table with their types and constraints
- Relationships between tables (like stadiums belonging to cities)

For example, your YallaDiscover schema will show relationships like:
- Stadiums belong to Cities (`stadiums.city_id > cities.id`)
- Matches take place in Stadiums (`matches.stadium_id > stadiums.id`)
- Teams play in Matches (`matches.team1_id > teams.id` and `matches.team2_id > teams.id`)
- Users can favorite Cities, Stadiums, Matches, and Teams

## Maintaining Your Database Diagrams

To keep your database diagrams up to date:

1. Run the command whenever you add or modify migrations:
   ```bash
   php artisan generate:dbml
   ```

2. Review the generated DBML file for accuracy
   - Check if relationships are correctly identified
   - Verify column types and constraints

3. Reopen the visualization to see the updated diagram

## Troubleshooting

### Common Issues

1. **Missing Tables**:
   - Make sure migrations use `Schema::create` correctly
   - Check if table name extraction regex matches your syntax

2. **Missing Columns**:
   - Some Laravel column definitions may not match the expected pattern
   - Check the regex in `extractColumns()` method

3. **Missing Relationships**:
   - If using non-standard foreign key naming, relationships may not be detected
   - Consider adding explicit foreign key constraints in your migrations

4. **Visualization Not Working**:
   - Ensure your DBML syntax is correct
   - Try reinstalling the DBML VS Code extension

### Customizing the Output

You can customize the command by:

1. Modifying the header text:
   ```php
   $dbml = "// Database schema for YourProjectName\n\n";
   ```

2. Adjusting the type mapping in the switch statement to change how Laravel types map to DBML types

3. Adding support for additional column modifiers by modifying the regex and processing logic

---

## Example Output

Here's an example of what the generated DBML file might look like for the YallaDiscover project:

```
// Database schema for YallaDiscover

Table users {
  id int [pk, increment]
  name varchar
  email varchar [unique]
  email_verified_at timestamp [null]
  password varchar
  created_at timestamp
  updated_at timestamp
}

Table cities {
  id int [pk, increment]
  name varchar
  description text [null]
  image varchar [null]
  latitude decimal [null]
  longitude decimal [null]
  created_at timestamp
  updated_at timestamp
}

Table stadiums {
  id int [pk, increment]
  name varchar
  city_id int
  address varchar
  image varchar [null]
  description text [null]
  created_at timestamp
  updated_at timestamp
}

// ... more tables ...

// Relationships
Ref: stadiums.city_id > cities.id
Ref: matches.stadium_id > stadiums.id
Ref: matches.team1_id > teams.id
Ref: matches.team2_id > teams.id
// ... more relationships ...
```

The visualization will display this schema as an interactive diagram, allowing you to see the structure of your database at a glance.
