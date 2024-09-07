<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function($table)
		{
		    $table->increments('id');
		    $table->string('title');
		    $table->text('description');
			$table->enum('category', array('clothing', 'headgear', 'accessories', 'addons'));
			$table->integer('user_id');
			$table->string('currency_type', 10);
			$table->integer('cost');
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
		Schema::drop('items');
	}

}
