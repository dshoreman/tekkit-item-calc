<?php

class Create_Config_Table {

	public function up()
	{
		Schema::create('config', function($table) {
			$table->increments('id');
			$table->string('key')->unique();
			$table->string('value');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('config');
	}

}