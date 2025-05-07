<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id'); // Это наш уникальный идентификатор
            $table->string('title', 255); // Заголовок поста
            $table->string('slug', 255)->unique(); // Уникальный слаг для поста
            $table->string('excerpt', 255); // Краткое содержание поста
            $table->text('content'); // Полное содержание поста
            $table->integer('rate'); // Рейтинг поста
            $table->timestamps(); // Время создания и обновления
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
