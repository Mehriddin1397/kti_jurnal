<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained('journals');
            $table->string('title', 500);
            $table->text('abstract')->nullable();
            $table->string('keywords', 500)->nullable();
            $table->string('article_type')->nullable();
            $table->string('language')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('plagiarism_file')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('assigned_editor_id')->nullable();
            $table->text('reviewer_notes')->nullable();
            $table->unsignedBigInteger('article_id')->nullable();
            $table->timestamps();
        });

        Schema::create('submission_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('submissions')->onDelete('cascade');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('organization')->nullable();
            $table->string('email')->nullable();
            $table->string('orcid', 25)->nullable();
            $table->boolean('is_corresponding')->default(false);
            $table->tinyInteger('order')->unsigned()->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission_authors');
        Schema::dropIfExists('submissions');
    }
};
