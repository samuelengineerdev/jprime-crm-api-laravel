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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('type_of_service')->nullable();
            $table->string('category_of_products')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('deleted')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
