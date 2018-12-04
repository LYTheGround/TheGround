<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unloads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('justify')->unique();
            $table->string('prince');
            $table->boolean('taxes')->default(0);
            $table->boolean('tva')->default(0);
            $table->integer('accounting_id')->unsigned()->index();
            $table->integer('month_id')->unsigned()->index();
            $table->integer('member_id')->unsigned()->index();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('unloads');
    }
}
