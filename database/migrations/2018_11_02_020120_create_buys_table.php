<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable()->unique();

            $table->string('ht')->default(0);
            $table->string('tva')->default(0);
            $table->string('ttc')->default(0);

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->integer('month_id')->unsigned()->index()->nullable();
            $table->foreign('month_id')->references('id')->on('months');

            $table->integer('trade_action_id')->unsigned()->index();
            $table->foreign('trade_action_id')->references('id')->on('trade_actions');

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
        Schema::dropIfExists('buys');
    }
}
