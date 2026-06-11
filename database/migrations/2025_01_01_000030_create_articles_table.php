<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained('journals');
            $table->string('title_uz', 500);
            $table->string('title_en', 500)->nullable();
            $table->string('title_ru', 500)->nullable();
            $table->string('slug', 500)->unique();
            $table->text('abstract_uz')->nullable();
            $table->text('abstract_en')->nullable();
            $table->text('abstract_ru')->nullable();
            $table->string('keywords_uz', 500)->nullable();
            $table->string('keywords_en', 500)->nullable();
            $table->string('keywords_ru', 500)->nullable();
            $table->smallInteger('volume')->unsigned()->nullable();
            $table->smallInteger('issue')->unsigned()->nullable();
            $table->smallInteger('page_from')->unsigned()->nullable();
            $table->smallInteger('page_to')->unsigned()->nullable();
            $table->string('doi')->nullable();
            $table->string('language')->default('uz');
            $table->string('article_type')->default('research');
            $table->string('pdf_file')->nullable();
            $table->longText('full_text_html')->nullable();
            $table->longText('references')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_open_access')->default(true);
            $table->date('received_at')->nullable();
            $table->date('accepted_at')->nullable();
            $table->date('published_at')->nullable();
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
