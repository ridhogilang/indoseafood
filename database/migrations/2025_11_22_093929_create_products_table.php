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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_category_id')
                  ->nullable()
                  ->constrained('product_categories')
                  ->nullOnDelete();

            $table->string('name');           // Nama ikan, misal: "Yellowfin Tuna"
            $table->string('latin_name')->nullable(); // Thunnus albacares
            $table->string('slug')->unique(); // yellowfin-tuna
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
