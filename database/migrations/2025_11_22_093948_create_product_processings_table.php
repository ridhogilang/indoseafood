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
        Schema::create('product_processings', function (Blueprint $table) {
           $table->id();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();

            $table->string('name');               // Whole, WGGS, Fillet Skin On, dll
            $table->string('freezing_method')->nullable(); // ex: "-22°C", "IQF"
            $table->string('size')->nullable();   // ex: "500–800 gr"
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_processings');
    }
};
