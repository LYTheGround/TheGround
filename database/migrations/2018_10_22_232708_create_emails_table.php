<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->boolean('default')->default(0);

            $table->integer('info_id')->unsigned()->index()->nullable();
            $table->foreign('info_id')->references('id')->on('infos');

            $table->integer('info_box_id')->unsigned()->index()->nullable();
            $table->foreign('info_box_id')->references('id')->on('info_boxes');

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
        Schema::dropIfExists('emails');
    }
}
