<?php

class Create_Items_Table {

	public function up()
	{
		Schema::create('items', function($table) {
			$table->increments('id');
			$table->string('ref');
			$table->string('name');
			$table->boolean('is_armor');
			$table->boolean('is_stackable');
			$table->boolean('is_craftable');
			$table->string('image_url');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}

}