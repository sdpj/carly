<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alerts', function($table)
		{
		    $table->increments('id');
		    $table->enum('type', array('normal', 'success', 'warning', 'danger'));
		    $table->string('text', 255);
		    $table->integer('user_id');
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
		Schema::drop('alerts');
	}

}
