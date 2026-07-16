<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });

        // Existing rows were shared across all journals; each journal now
        // manages its own set of "about" pages via the seeder.
        DB::table('about_pages')->delete();

        Schema::table('about_pages', function (Blueprint $table) {
            $table->foreignId('journal_id')->after('id')->constrained('journals')->cascadeOnDelete();
            $table->unique(['journal_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropUnique(['journal_id', 'slug']);
            $table->dropConstrainedForeignId('journal_id');
            $table->unique('slug');
        });
    }
};
