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
        Schema::create('paymentMethods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->integer('totalPrice');
            $table->string('address');
            $table->foreignId('PaymentID')->constrained('paymentMethods')->onDelete('cascade');
            $table->foreignId('CustomerID')->constrained('customers')->onDelete('cascade');
            $table->foreignId('EmployeeID')->constrained('employees')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('orderDetails', function (Blueprint $table) {
            $table->foreignId('OrderID')->constrained('orders')->onDelete('cascade');
            $table->foreignId('BookID')->constrained('books')->onDelete('cascade');
            $table->integer('soldOut');
            $table->integer('subTotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
