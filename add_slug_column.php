<?php

// Bootstrap the Laravel application
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Use the DB facade to run the raw SQL query
try {
    // Check if the column already exists
    $columnExists = DB::select("SHOW COLUMNS FROM categories LIKE 'slug'");
    
    if (empty($columnExists)) {
        // Add the slug column if it doesn't exist
        DB::statement("ALTER TABLE categories ADD COLUMN slug VARCHAR(255) UNIQUE AFTER name");
        echo "Success: The 'slug' column has been added to the 'categories' table.\n";
    } else {
        echo "Info: The 'slug' column already exists in the 'categories' table.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
