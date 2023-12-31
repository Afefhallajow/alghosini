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
        Schema::create('products_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();

            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('item_id')
                ->references('id')->on('items')->onDelete('cascade');
$table->float('percent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_items');
    }
};
