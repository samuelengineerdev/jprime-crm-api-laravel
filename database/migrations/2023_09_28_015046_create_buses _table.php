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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('kiv')->nullable();
            $table->string('dot')->nullable();
            $table->string('bus_plate')->nullable();
            $table->string('vin')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('mile')->nullable();
            $table->string('year')->nullable();
            $table->string('passenger')->nullable();
            $table->date('oil_date')->nullable();
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
