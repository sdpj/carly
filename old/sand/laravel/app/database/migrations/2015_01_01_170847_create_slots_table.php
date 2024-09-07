<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slots', function($table)
		{
		    $table->increments('id');
			$table->integer('user_id');
			$table->integer('slot1');
			$table->integer('slot2');
			$table->integer('slot3');
			$table->integer('slot4');
			$table->integer('slot5');
			$table->integer('slot6');
			$table->integer('slot7');
			$table->integer('slot8');
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
		Schema::drop('slots');
	}

}
