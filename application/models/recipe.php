<?php

class Recipe extends Eloquent {

	public function items()
	{
		return $this->has_many_and_belongs_to('Item')->with('slot');
	}

	public static function get_totals($recipe)
	{
		$items = array();

		foreach ($recipe->items as $item)
		{
			if (!array_key_exists($item->id, $items))
			{
				$items[$item->id] = $item;
				$items[$item->id]->count = 0;
			}
			$items[$item->id]->count++;
		}

		return $items;
	}

	public static function get_combined_totals($recipe_ids = array())
	{
		$data = $recipes = array();

		foreach ($recipe_ids as $recipe)
		{
			array_key_exists($recipe, $recipes) ? $recipes[$recipe]++ : $recipes[$recipe] = 1;
		}

		foreach ($recipes as $id => $count)
		{
			$ingredients = Recipe::get_totals(Recipe::find($id));

			foreach ($ingredients as $iid => $ingredient)
			{
				$ingredient->count *= $count;

				if (!array_key_exists($iid, $data))
				{
					$data[$iid] = array(
						'name' => $ingredient->name,
						'image_url' => $ingredient->image_url,
						'count' => 0
					);
				}
				$data[$iid]['count'] += $ingredient->count;
			}
		}
		
		sort($data);
		return $data;
	}
}
