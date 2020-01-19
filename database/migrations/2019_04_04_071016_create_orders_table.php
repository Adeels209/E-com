<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->longText('order_no');
            $table->string('paid_price');
            $table->string('email');
            $table->integer('user_id')->nullable();
            $table->longText('address');
            $table->longText('address_apartment');
            $table->string('city');
            $table->string('phonenumber');
            $table->string('zipcode');
            $table->longText('user_note')->nullable();
            $table->enum('status',['PENDINNG','ACCEPTED','ONDELIVERY','DELIVERED','REJECTED']);
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
        Schema::dropIfExists('orders');
    }
}
