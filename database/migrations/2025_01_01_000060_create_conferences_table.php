<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title_uz');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('description_uz')->nullable();
            $table->text('description_en')->nullable();
            $table->string('venue')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('submission_deadline')->nullable();
            $table->date('registration_deadline')->nullable();
            $table->boolean('is_online')->default(false);
            $table->text('topics')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('status')->default('upcoming');
            $table->unsignedBigInteger('proceedings_journal_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
