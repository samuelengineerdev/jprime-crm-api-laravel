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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name')->unique(); // Nombre del producto
            $table->text('description')->nullable(); // Descripción del producto (opcional)
            $table->decimal('unit_price', 8, 2)->nullable(); // Precio del producto (8 dígitos en total, 2 decimales)
            $table->integer('stock_quantity')->nullable(); // Cantidad en stock
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps(); // Campos de registro de tiempo

            // Puedes agregar más campos según tus necesidades, como 'category', 'brand', etc.
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
