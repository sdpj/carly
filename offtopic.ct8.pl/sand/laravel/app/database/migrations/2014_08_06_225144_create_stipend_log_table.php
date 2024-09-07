<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStipendLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stipend_log', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
			$table->integer('stipend_amount');
			$table->integer('balance_before');
			$table->integer('balance_after');
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
		Schema::drop('stipend_log');
	}

}
