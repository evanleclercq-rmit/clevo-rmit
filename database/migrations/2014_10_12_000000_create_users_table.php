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
            $table->increments('id');
            $table->string('name');
			$table->string('city')->nullable();
			$table->integer('age')->nullable();
            $table->string('email')->unique();
			$table->integer('balance')->default(20000);
            $table->string('password');
            $table->boolean('admin')->default(true);
            $table->string('holdings')->nullable();
            $table->string('watchlist')->nullable();
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
        Schema::drop('users');
    }
}
