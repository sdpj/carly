<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('badge_type', function($table)
		{
		    $table->increments('id');
		    $table->string('name');
		    $table->text('description');
		    $table->string('filename');
		    $table->timestamps();
		    $table->softDeletes();
		});
		Schema::create('badge_user', function($table)
		{
		    $table->increments('id');
		    $table->integer('badge_id');
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
		Schema::drop('badge_type');
		Schema::drop('badge_user');
	}

}
