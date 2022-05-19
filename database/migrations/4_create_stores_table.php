<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('store_id');
            $table->string('parent_id')->unsigned()->nullable();
            $table->integer('store_type_id')->unsigned()->nullable();
            $table->string('name', 120)->nullable();
            $table->string('app_name', 200)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('zip', 15)->nullable();
            $table->string('email', 60)->nullable();
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
