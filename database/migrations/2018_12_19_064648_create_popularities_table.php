<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopularitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popularities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voter_user_id')->unsigned()->default();
            $table->integer('target_user_id')->unsigned()->default();
            $table->integer('popularity_status_id')->unsigned()->default();

            $table->foreign('voter_user_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('Cascade');
            $table->foreign('target_user_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('Cascade');
            $table->foreign('popularity_status_id')->references('id')->on('popularity_status')->onUpdate('Cascade')->onDelete('Cascade');
            
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
        Schema::dropIfExists('popularities');
    }
}
