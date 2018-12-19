<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->default();
            $table->integer('forum_id')->unsigned()->default();
            $table->string('content',191);

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('Cascade');
            $table->foreign('forum_id')->references('id')->on('forums')->onUpdate('Cascade')->onDelete('Cascade');

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
        Schema::dropIfExists('threads');
    }
}
