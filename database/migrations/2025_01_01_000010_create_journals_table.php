<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('slug')->unique();
            $table->string('issn_print', 20)->nullable();
            $table->string('issn_online', 20)->nullable();
            $table->text('description_uz')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('aims_and_scope')->nullable();
            $table->text('peer_review_policy')->nullable();
            $table->text('author_guidelines')->nullable();
            $table->text('ethics_policy')->nullable();
            $table->string('chief_editor')->nullable();
            $table->string('chief_editor_title')->nullable();
            $table->string('frequency')->default('quarterly');
            $table->year('founding_year')->nullable();
            $table->string('submission_email')->nullable();
            $table->boolean('is_indexed_google_scholar')->default(true);
            $table->boolean('is_indexed_hak')->default(false);
            $table->boolean('is_indexed_inlibrary')->default(false);
            $table->boolean('is_indexed_scopus')->default(false);
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
