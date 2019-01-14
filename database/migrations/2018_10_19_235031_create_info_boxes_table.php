<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_boxes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('brand')->unique()->nullable();
            $table->string('name');
            $table->string('licence')->nullable();
            $table->string('ice')->nullable();
            $table->string('turnover')->nullable();
            $table->string('taxes')->nullable();
            $table->string('fax')->nullable();
            $table->string('speaker');
            $table->string('address');
            $table->string('build');
            $table->string('floor')->nullable();
            $table->string('apt_nbr')->nullable();
            $table->string('zip')->nullable();

            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('info_boxes');
    }
}
