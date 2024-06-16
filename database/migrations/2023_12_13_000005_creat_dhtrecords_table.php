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
        Schema::create('dhtrecords', function (Blueprint $table) {
            $table->id();
            $table->float('temperature')->nullable();
            $table->decimal('humidity_rate')->nullable();
            $table->timestamp('record_time')->useCurrent(); 
            $table->bigInteger('fk_id')->unsigned();
            $table->foreign('fk_id')->references('id')->on('dht')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dhtrecords');
    }
};
