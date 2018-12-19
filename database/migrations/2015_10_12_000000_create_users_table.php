<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('role_id')->unsigned()->default(1);
            $table->string('name',191);
            $table->string('email',191)->unique();
            $table->string('password',191);
            $table->string('phone',191);
            $table->date('birthday');
            $table->string('gender',191);
            $table->string('address', 191);
            $table->string('profile_pic', 191);
            $table->integer('good_popularity');
            $table->integer('bad_popularity');

            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('Cascade')->onDelete('Cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
