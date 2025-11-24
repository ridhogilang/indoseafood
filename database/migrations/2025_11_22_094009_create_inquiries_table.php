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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            // data company / kontak
            $table->string('company_name');
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('phone')->nullable();

            // referensi produk (opsional)
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            // detail produk yang diminta
            $table->string('fish_name')->nullable();      // nama ikan (text)
            $table->string('latin_name')->nullable();     // nama latin (text)
            $table->string('freezing_method')->nullable();
            $table->string('size')->nullable();
            $table->integer('qty')->nullable();           // jumlah (bisa dalam kg / carton)
            $table->string('port_of_destination')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
