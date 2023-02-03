<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('transaction_number', 16)->unique();
            $table->integer('total');
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('payment_by', ['bank', 'gopay', 'ovo', 'dana']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};