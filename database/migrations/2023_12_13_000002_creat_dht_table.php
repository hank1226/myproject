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
        Schema::create('dht', function (Blueprint $table) {
            $table->id();
            $table->string('dht_sn')->unique();
            $table->timestamps(); 
            $table->unsignedBigInteger('fk_id');
            $table->foreign('fk_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dht');
    }
};
