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
        Schema::table('drproducts', function (Blueprint $table) {

            $table->unsignedBigInteger('product_id')->after('quantity');

            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drproducts', function (Blueprint $table) {

            $table->unsignedBigInteger('product_id')->after('quantity');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }
};
