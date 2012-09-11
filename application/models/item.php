<?php

class Item extends Eloquent  {

	public function recipes()
	{
		return $this->has_many_and_belongs_to('Recipe');
	}
}
