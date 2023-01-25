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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_address');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email_address');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('policies');
            $table->string('privacy');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('id_user_created')->nullable();
            $table->string('id_user_updated')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
};
