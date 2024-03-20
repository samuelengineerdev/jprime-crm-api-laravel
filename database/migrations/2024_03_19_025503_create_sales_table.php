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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('date');
            $table->string('notes');
            $table->string('expiration_date');
            $table->string('next_payment_date');
            $table->decimal('discount', 10, 1);
            $table->decimal('tax', 10, 1);
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('client_account_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
