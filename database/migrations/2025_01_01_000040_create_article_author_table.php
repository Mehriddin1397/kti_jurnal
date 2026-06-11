<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('authors');
            $table->tinyInteger('order')->unsigned()->default(1);
            $table->boolean('is_corresponding')->default(false);
            $table->string('organization')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_author');
    }
};
