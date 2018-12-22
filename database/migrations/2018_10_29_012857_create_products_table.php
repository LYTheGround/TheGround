<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable()->unique();
            $table->string('name');
            // auto  generate
            $table->string('ref')->nullable();
            $table->string('tva');
            $table->string('size')->nullable();
            // description de produit
            $table->longText('description')->nullable();
            // la quantité actuel dans le stock
            $table->string('qt')->default(0);
            // le minimum de la quantité dans le stock
            $table->string('qt_min')->default(0);
            // la total des prix d'achat de ce produit en stock actuellement
            $table->string('amount')->default(0);
            // le créateur du produit
            $table->integer('member_id')->unsigned()->index()->nullable();
            $table->foreign('member_id')->references('id')->on('members');

            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->timestamps();
        });

        Schema::create('client_product', function (Blueprint $table) {
            $table->increments('id');

            $table->string('min_prince');

            $table->integer('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });

        Schema::create('product_provider', function (Blueprint $table) {
            $table->increments('id');

            $table->string('min_prince');

            $table->integer('provider_id')->unsigned()->index();
            $table->foreign('provider_id')->references('id')->on('providers');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('products');
    }
}
