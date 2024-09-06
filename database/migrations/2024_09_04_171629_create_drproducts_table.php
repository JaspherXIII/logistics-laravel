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
        Schema::create('drproducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deliveryreceipt_id');
            $table->integer('quantity')->default(1); 

            $table->foreign('deliveryreceipt_id')->references('id')->on('deliveryreceipts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drproducts');
    }
};
