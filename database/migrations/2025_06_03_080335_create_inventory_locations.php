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
        Schema::create('inventory_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add foreign key to inventories table
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('location'); // Drop the old location column
            $table->integer('location_id')->unsigned()->nullable()->after('category_id');
            $table->foreign('location_id')->references('id')->on('inventory_locations')->onDelete('set null');
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
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
            $table->string('location')->nullable(); // Restore the old column
        });
        Schema::dropIfExists('inventory_locations');
    }
};
