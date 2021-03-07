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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('billing_full_name');
            $table->string('billing_company')->nullable();
            $table->string('billing_phone');
            $table->string('billing_email')->nullable();
            $table->string('billing_country');
            $table->string('billing_city');
            $table->string('billing_address');
            $table->string('billing_address_two')->nullable();
            $table->string('billing_post_code');
            $table->string('billing_order_note')->nullable();
            $table->string('payment_gatway');
            $table->string('payment_trid')->nullable();
            $table->integer('payment_status')->default(0)->nullable();
            $table->string('billing_discount')->default(0);
            $table->string('billing_discount_code')->nullable();
            $table->string('billing_subtotal');
            $table->string('billing_shipping');
            $table->string('billing_total');
            $table->string('order_status')->default('PROCESSING');
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
