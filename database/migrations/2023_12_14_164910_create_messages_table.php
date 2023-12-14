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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('ack')->default(0);
            $table->string('chatId', 100);
            $table->string('from', 100);
            $table->string('to', 100)->nullable();
            $table->string('type', 50);
            $table->text('body')->nullable();
            $table->boolean('fromMe')->default(0);
            $table->string('attachmentType', 50)->nullable();
            $table->string('attachmentLink')->nullable();
            $table->string('deviceType')->nullable();
            $table->double('timestamp');
            $table->boolean('isRead')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
