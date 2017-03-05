<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTableForCatUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('pivot_user_cat', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('users_id')->unsigned()->nullable();
            $table->integer('cat_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::drop('pivot_user_cat');
	}

}
