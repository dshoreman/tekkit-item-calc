<?php

class Recipe extends Eloquent {

	public function items()
	{
		return $this->has_many_and_belongs_to('Item')->with('slot');
	}
}
