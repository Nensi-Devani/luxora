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
            $table->string('name');
            $table->longText('description');
            $table->enum('gender', ['men', 'women']);
            $table->integer('discount')->nullable()->comment('Rs.');
            $table->string('metal_weight')->nullable();
            $table->string('metal_purity')->nullable();
            $table->string('gemstone_weight')->nullable();
            $table->string('gemstone_purity')->nullable();
            $table->integer('no_of_gemstone')->nullable();
            $table->boolean('express_delivery_available')->default(false)->comment('false=No, true=Yes');
            $table->integer('express_delivery_charge')->nullable();
            $table->string('warranty_period');
            $table->string('images');
            $table->string('certificate')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
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
