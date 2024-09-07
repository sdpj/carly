<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('api_keys', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->string('key', 32);
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
		Schema::drop('api_keys');
	}

}
