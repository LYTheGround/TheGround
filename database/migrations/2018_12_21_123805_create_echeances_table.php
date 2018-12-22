<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcheancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echeances', function (Blueprint $table) {
            $table->increments('id');

            $table->string('prince');
            $table->date('date');
            $table->date('payed')->nullable();

            $table->integer('buy_id')->index()->unsigned()->nullable();
            $table->foreign('buy_id')->references('id')->on('buys');
            $table->integer('sale_id')->index()->unsigned()->nullable();
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->integer('company_id')->index()->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

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
        Schema::dropIfExists('echeances');
    }
}
