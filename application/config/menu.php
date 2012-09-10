<?php

$menu = array(
	array(
		'attributes' => array(),
		'items' => array(
		)
	),
);

if (Auth::user())
{
	$menu['usernav'] = array(
		'label' => Auth::user()->username,
		'items' => array(
			array(
				'label' => 'Profile',
				'url' => URL::to('admin/user/profile')
			),
			'---',
			array(
				'label' => 'Logout',
				'url' => URL::to('admin/user/logout')
			)
		)
	);
}
else
{
	$menu['usernav'] = array(
		'label' => 'Login / Register',
	);
}

return array(

	'admin' => Navbar::create(Config::get('application.name'), URL::base(), $menu, Navbar::FIX_TOP, true, array('class' => 'navbar-inverse')),

);
