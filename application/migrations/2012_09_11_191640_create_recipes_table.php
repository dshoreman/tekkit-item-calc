<?php

class Create_Recipes_Table {

	public function up()
	{
		Schema::create('recipes', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('item_recipe', function($table) {
			$table->increments('id');
			$table->integer('item_id')->unsigned()->index();
			$table->integer('recipe_id')->unsigned()->index();
			$table->integer('slot');
			$table->timestamps();

			$table->foreign('item_id')->references('id')->on('items');
			$table->foreign('recipe_id')->references('id')->on('recipes');
		});
	}

	public function down()
	{
		Schema::drop('item_recipe');
		Schema::drop('recipes');
	}

}