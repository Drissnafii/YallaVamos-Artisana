<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL, we can use MODIFY COLUMN with ENUM
        DB::statement("ALTER TABLE accommodations MODIFY COLUMN type ENUM('hotel', 'apartment', 'riad', 'guesthouse', 'other') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert back to regular VARCHAR
        DB::statement("ALTER TABLE accommodations MODIFY COLUMN type VARCHAR(255) NOT NULL");
    }
};
