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
        Schema::create('pzemrecords', function (Blueprint $table) {
            $table->id(); 
            $table->float('Voltage')->nullable();
            $table->float('Current')->nullable();
            $table->float('Power')->nullable();
            $table->float('Energy')->nullable();
            $table->float('PF')->nullable();
            $table->float('Frequency')->nullable();
            $table->timestamp('record_time')->useCurrent();
            $table->unsignedBigInteger('fk_id');
            $table->foreign('fk_id')->references('id')->on('pzem')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pzemrecords');
    }
};
