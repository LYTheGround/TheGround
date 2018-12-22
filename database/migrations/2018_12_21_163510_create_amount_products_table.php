<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmountProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amount_products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('qt');
            $table->string('ttcu');
            $table->string('total');
            $table->string('history');


            $table->integer('product_id')->index()->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('purchased_id')->index()->unsigned()->nullable();
            $table->foreign('purchased_id')->references('id')->on('purchaseds');

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
        Schema::dropIfExists('amount_products');
    }
}
