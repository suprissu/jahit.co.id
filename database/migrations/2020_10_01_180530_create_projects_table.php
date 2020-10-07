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
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->bigInteger('partner_id')->unsigned()->index()->nullable();
            $table->bigInteger('category_id')->unsigned()->index();
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
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('project_categories')->onDelete('cascade');
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
