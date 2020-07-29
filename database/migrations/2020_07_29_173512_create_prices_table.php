<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();

            $table->unsignedFloat('value')->nullable(true)->comment('value of the currency in this date');
            $table->string('source', 50)->nullable(true)->comment('source of the price');

            // foreign keys
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id', 'fk_cerrency_in_orders')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');

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
        Schema::table('prices', function(Blueprint $table) {
            $table->dropForeign('fk_cerrency_in_orders');
        });
        Schema::dropIfExists('prices');
    }
}
