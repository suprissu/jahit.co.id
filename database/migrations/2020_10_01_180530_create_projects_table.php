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
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('partner_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('address');
            $table->string('status');
            $table->integer('count')->unsigned();
            $table->longText('note');
            $table->double('cost')->unsigned()->nullable();
            $table->date('start_date')->nullable(); 
            $table->date('deadline')->nullable();
            $table->longText('feedback')->nullable();
            $table->integer('rating')->unsigned()->nullable();
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
        Schema::dropIfExists('projects');
    }
}
