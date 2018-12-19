<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('sender_id')->unsigned()->default();
            $table->integer('receiver_id')->unsigned()->default(); 
            $table->string('content',191); 

            $table->foreign('sender_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('Cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onUpdate('Cascade')->onDelete('Cascade');

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
        Schema::dropIfExists('messages');
    }
}
