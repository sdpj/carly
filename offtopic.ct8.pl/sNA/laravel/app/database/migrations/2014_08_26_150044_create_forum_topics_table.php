<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_topics', function($table)
		{
		    $table->increments('id');
		    $table->integer('order');
		    $table->integer('category');
		    $table->string('name', 255);
		    $table->string('description', 512);
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
		Schema::drop('forum_topics');
	}

}
