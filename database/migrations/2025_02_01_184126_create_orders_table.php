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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('total_amount');
            $table->enum('status',['pending','shipped','delivered','cancelled']);
            $table->date('shipped_date');
            $table->date('delivered_date');
            $table->boolean('is_express_delivery')->default(false);
            $table->integer('delivery_charges')->nullable();
            $table->string('payment_mode')->default('COD');
            $table->enum('payment_status',['pending','done']);
            $table->foreignId('user_address_id')->constrained();
            $table->string('tracking_no')->nullable();
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
