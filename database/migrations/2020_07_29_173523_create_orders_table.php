<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('user_email', 120)->nullable(false)->comment('email of customer');
            $table->unsignedFloat('exchange_total_value')->nullable(false);

            // foriegn keys
            $table->unsignedBigInteger('from_price')->nullable(false);
            $table->unsignedBigInteger('to_price')->nullable(false);

            $table->foreign('from_price', 'fk_from_price_in_orders')->references('id')->on('prices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('to_price', 'fk_to_price_in_orders')->references('id')->on('prices')->onDelete('set null')->onUpdate('cascade');

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
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('fk_from_price_in_orders');
            $table->dropForeign('fk_to_price_in_orders');
        });
        Schema::dropIfExists('orders');
    }
}
