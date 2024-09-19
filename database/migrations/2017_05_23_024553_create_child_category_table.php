<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_category')->unsigned();
            $table->string('child_category_name');
            $table->text('child_category_desc');
            $table->timestamps();

            $table->foreign('id_category')
                  ->references('id')
                  ->on('category')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_category');
    }
}
