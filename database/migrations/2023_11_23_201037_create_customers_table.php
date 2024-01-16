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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('full_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('last_purchase_date')->nullable()->default('0000-00-00');
            $table->decimal('total_purchases', 10, 2)->nullable()->default(00.00);
            $table->integer('loyalty_points')->default(0);
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
