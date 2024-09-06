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
        Schema::create('picklistproducts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('picklist_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1); 

            $table->foreign('picklist_id')->references('id')->on('picklists');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picklistproducts');
    }
};
