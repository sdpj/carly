<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function($table)
		{
		    $table->increments('id');
			$table->enum('type', array('stipend', 'login', 'change_password', 'change_email'));
			$table->integer('user_id');
			$table->string('ip', 15);
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
		Schema::drop('logs');
	}

}
