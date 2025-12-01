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
        Schema::create('email_campaign_contacts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('email_campaign_id')
                ->constrained('email_campaigns')
                ->onDelete('cascade');

            $table->foreignId('email_contact_id')
                ->constrained('email_contacts')
                ->onDelete('cascade');

            $table->enum('status', ['pending', 'sent', 'failed'])
                ->default('pending');

            $table->timestamp('sent_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_campaign_contacts');
    }
};
