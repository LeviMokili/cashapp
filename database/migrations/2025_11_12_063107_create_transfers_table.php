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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->decimal('amount', 15, 2);
            $table->string('ville_provenance');
            $table->string('ville_destination');
            $table->string('guichetier_provenance');
            $table->string('guichetier_destination');
            $table->date('date_transfer');
            $table->string('telephone');
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('reference_code');
            $table->index('status');
            $table->index('created_by');
            $table->index('date_transfer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
