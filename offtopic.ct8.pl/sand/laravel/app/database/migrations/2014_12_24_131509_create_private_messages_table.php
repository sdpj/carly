<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('private_messages', function($table)
		{
		    $table->increments('id');
		    $table->integer('sender_id');
		    $table->integer('recipient_id');
		    $table->text('message');
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
		Schema::drop('private_messages');
	}

}
