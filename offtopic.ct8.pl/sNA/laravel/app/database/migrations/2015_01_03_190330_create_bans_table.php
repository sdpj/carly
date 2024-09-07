<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bans', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('staff_id');
		    $table->string('reason');
		    $table->timestamp('expiry');
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
		Schema::drop('bans');
	}

}
