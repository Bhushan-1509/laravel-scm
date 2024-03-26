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
            $table->uuid();
            $table->string('company_name');
            $table->text('address');
            $table->string("pincode");
            $table->string("state");
            $table->string('gst_no');
            $table->string('company_in_sez');
            $table->string('company_type');
            $table->decimal('distance_from_andheri');
            $table->decimal('distance_from_vasai');
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
