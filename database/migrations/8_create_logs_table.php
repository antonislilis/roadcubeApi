<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time', 50)->nullable();
            $table->string('ip', 20)->nullable();
            $table->string('method', 10)->nullable();
            $table->string('header', 100)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('status_code', 20)->nullable();
            $table->string('user_name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('body')->nullable();
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
        Schema::drop('logs');
    }
};
