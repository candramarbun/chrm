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
         Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number')->unique();
            $table->unsignedInteger('customer_id');
            $table->foreign(columns: 'customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->date('sale_date');
            $table->timestamps();
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->increments('id'); // Use increments for primary key
            $table->unsignedInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('sales');
    }
};
