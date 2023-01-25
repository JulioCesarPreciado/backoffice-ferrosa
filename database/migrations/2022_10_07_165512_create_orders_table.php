<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->float('subtotal',10,2)->default(0);
            $table->float('discount',10,2)->default(0);
            $table->float('shipping',10,2)->default(0);
            $table->float('tax',10,2)->default(0);
            $table->float('total',10,2)->default(0);
            $table->string('coupon_name')->nullable();
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->string('status')->default('ORDEN REALIZADA');
            $table->string('validity')->default('ACTIVO');
            $table->bigInteger('id_user_created');
            $table->bigInteger('id_user_updated');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
};
