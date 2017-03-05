<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('description')->nullable();
            $table->string('image')->nullable();
            $table->string('task_address');
            $table->string('time_slot');
            $table->integer('users_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
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
		//
        Schema::drop('tasks');

	}

}
