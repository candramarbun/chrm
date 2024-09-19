<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name');
            $table->string('project_number');
            $table->integer('project_customer')->unsigned();
            $table->integer('project_category')->unsigned();
            $table->enum('status', ['ongoing', 'closed']);
            $table->string('contract_date');
            $table->string('contract_number');
            $table->timestamps();

            $table->foreign('project_customer')
                ->references('id')
                ->on('customer')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('project_category')
                ->references('id')
                ->on('child_category')
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
        Schema::dropIfExists('project');
    }
}
