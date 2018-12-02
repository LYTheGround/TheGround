<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profit');
            $table->string('tva');
            $table->string('taxes');
            $table->string('tva_after_unload');
            $table->string('taxes_after_unload');
            $table->integer('accounting_id');
            $table->date('date');
            $table->timestamps();
        });
        Schema::create('month_unload', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month_id');
            $table->integer('unload_id');
            $table->integer('tva');
            $table->integer('taxes');
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
        Schema::dropIfExists('months');
        Schema::dropIfExists('month_unload');
    }
}
