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
// In create_chats_table migration
Schema::create('chats', function (Blueprint $table) {
    $table->id();
    $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
