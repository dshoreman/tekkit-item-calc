<?php
class Mineverse_Task {

	public function run($args)
	{
		echo "Fetching data...\n";
		$data = file_get_contents('http://api.mineverse.com/q.php?key=504d1c88f10cd&request=itemdata');
		$data = json_decode($data);
		$insert = array();

		echo "Cleaning existing items...\n";
		DB::table('items')->delete();

		foreach ($data->items as $k => $a)
		{
			echo 'Adding item "'.$a->item_name.'"... ';
			$o = new Item();
			$o->ref = $k;
			$o->name = $a->item_name;
			$o->is_armor = $a->is_armor;
			$o->is_stackable = $a->is_stackable;
			$o->image_url = $a->image_url;
			$o->save();

			if (property_exists($a, 'subitems') && count($a->subitems) > 0)
			{
				echo "\nFound ".count($a->subitems)." child items:\n";
				foreach ($a->subitems as $child)
				{
					echo "\tAdding child item \"".$child->itemname."\"...\n";
					$o = new Item();
					$o->ref = $k.'.'.$child->d;
					$o->name = $child->itemname;
					$o->is_armor = $a->is_armor;
					$o->is_stackable = $a->is_stackable;
					$o->image_url = $child->image_url;
					$o->save();
				}
			}
			echo "Done!\n";
		}

		echo 'Setting last update to '.$data->lastupdate.'...';
		
		DB::table('config')
			->where('key', '=', 'mineverse.lastupdate')
			->update(array('value' => $data->lastupdate));

		echo " Done!\n";
		echo "Import complete!";
	}
}