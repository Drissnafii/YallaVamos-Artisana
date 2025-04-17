<?php

// Bootstrap the Laravel application
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Use the DB facade to run the raw SQL query
try {
    // Check if the column exists
    $columnExists = DB::select("SHOW COLUMNS FROM categories LIKE 'slug'");
    
    if (!empty($columnExists)) {
        // Drop the slug column if it exists
        DB::statement("ALTER TABLE categories DROP COLUMN slug");
        echo "Success: The 'slug' column has been removed from the 'categories' table.\n";
    } else {
        echo "Info: The 'slug' column doesn't exist in the 'categories' table.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
