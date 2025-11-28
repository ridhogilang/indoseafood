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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // relasi ke kategori artikel
            $table->foreignId('article_category_id')
                ->nullable()
                ->constrained('article_categories')
                ->nullOnDelete();

            $table->string('title');                 // judul artikel
            $table->string('slug')->unique();        // untuk URL
            $table->text('excerpt')->nullable();     // ringkasan
            $table->longText('body');                // isi artikel

            $table->string('thumbnail')->nullable(); // path gambar
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            // optional SEO (kalau mau dipakai nanti enak)
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
