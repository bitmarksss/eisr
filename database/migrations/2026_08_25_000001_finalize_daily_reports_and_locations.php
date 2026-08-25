<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('levels') && ! Schema::hasTable('locations')) {
            Schema::rename('levels', 'locations');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('locations') && ! Schema::hasTable('levels')) Schema::rename('locations', 'levels');
    }
};
