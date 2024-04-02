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
            $table->id()->autoIncrement();
            $table->uuid()->nullable();
            $table->string('company_name');
            $table->string('challan_no');
            $table->string('type');
            //$table->string('product_barcode_symbology')->nullable();
            $table->string('apm_challan_no');
            $table->integer('size');
            $table->integer('quantity');
            $table->string('for');
            $table->decimal('cutting_size');
            $table->decimal('cutting_weight');
            $table->integer('order_no');
            $table->integer('order_size')->nullable();
            $table->integer("stage")->default(1);
            $table->text('notes');
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
