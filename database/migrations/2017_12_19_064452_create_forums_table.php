<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->default();
            $table->integer('category_id')->unsigned()->default();
            $table->integer('forum_status_id')->unsigned()->default();
            $table->string('title',191);
            $table->string('description', 191);

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('Cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('Cascade')->onDelete('Cascade'); 
            $table->foreign('forum_status_id')->references('id')->on('forum_status')->onUpdate('Cascade')->onDelete('Cascade');

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
        Schema::dropIfExists('forums');
    }
}
