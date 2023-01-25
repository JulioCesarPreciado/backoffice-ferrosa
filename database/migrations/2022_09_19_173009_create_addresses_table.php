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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip_code');
            $table->string('notes')->nullable();;
            $table->string('status')->default('CREADO DESDE SISTEMA');
            $table->string('validity')->default('ACTIVO');
            $table->bigInteger('id_user_created')->nullable();
            $table->bigInteger('id_user_updated')->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
