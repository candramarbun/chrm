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
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add foreign key to inventories table
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('category'); // Drop the old category column
            $table->integer('category_id')->unsigned()->nullable()->after('unit_price');
            $table->foreign('category_id')->references('id')->on('inventory_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category')->nullable(); // Restore the old column
        });
        Schema::dropIfExists('inventory_categories');
    }
};
