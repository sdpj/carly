<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->enum('type', array('donation'));
		    $table->integer('sender_id');
		    $table->tinyInteger('seen');
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
		Schema::drop('notifications');
	}

}
