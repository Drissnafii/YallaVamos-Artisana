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
        // Since we're using MySQL, this migration is unnecessary
        // The proper ENUM update is handled directly in the 2025_04_14_210937_update_accommodations_type_enum.php migration
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed in down migration since up does nothing
    }
};
