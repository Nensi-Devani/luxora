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
            $table->foreignId('metal_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('gemstone_id')->constrained();
            $table->foreignId('occasion_id')->constrained();
            $table->string('name');
            $table->longText('description');
            $table->enum('gender', ['men', 'women']);
            $table->integer('delivery_charge')->nullable();
            $table->boolean('express_delivery_available')->default(false)->comment('false=No, true=Yes');
            $table->integer('express_delivery_charge')->nullable();
            $table->string('warranty_period');
            $table->string('images');
            $table->string('certificate')->nullable();
            $table->enum('status',['0','1'])->default(1)->comment("1=Active,0=Inactive");
            $table->timestamps();
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
