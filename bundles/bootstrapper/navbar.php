<?php namespace Bootstrapper;

use \HTML;

/**
 * Navbar for creating Twitter Bootstrap style Navbar.
 *
 * @package	 Bundles
 * @subpackage  Twitter
 * @author	  Patrick Talmadge - Follow @patricktalmadge
 *
 * @see http://twitter.github.com/bootstrap/
 */
class Navbar
{

	// Navbar Toggle options.
	const STATIC_BAR = '';
	const FIX_TOP = 'navbar-fixed-top';
	const FIX_BOTTOM = 'navbar-fixed-bottom';


	/**
	 * Create a new Navbar instance.
	 *
	 * @param  string	 $brand
	 * @param  string	 $brand_url
	 * @param  array	  $menu
	 * @param  string	 $type
	 * @param  bool	   $collapsible
	 * @param  array	  $attributes
	 * @param  bool  	  $autoroute
	 * @return Navbar
	 */
	public static function create($brand, $brand_url, $menus, $type = Navbar::STATIC_BAR, $collapsible = false, $attributes = array(), $autoroute = true)
	{
		$attributes = Helpers::add_class($attributes, 'navbar '.$type);

		//Open navbar containers
		$html = '<div'.HTML::attributes($attributes).'>';
		$html .= '<div class="navbar-inner"><div class="container">';

	  	if($collapsible)
	  	{
	  		$html .= '<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</a>';
	  	}

	  	$html .= '<a class="brand" href="'.$brand_url.'">'.$brand.'</a>';

	  	// Support adding a btn-dropdown
	  	if (array_key_exists('usernav', $menus))
	  	{
	  		$usernav = $menus['usernav'];
	  		unset($menus['usernav']);
	  		$is_btn = isset($usernav['items']);

	  		$html .= '<div class="btn-group pull-right">';
	  		$html .= $is_btn ? '<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">' : '<a class="btn" href="#">';
	  		$html .= '<i class="icon-user"></i> ' . $usernav['label'] ;
	  		$html .= $is_btn ? '<span class="caret"></span></a>' : '</a>';

		  	if (isset($usernav['items']))
		  	{
		  		$html .= '<ul class="dropdown-menu">';
			  	foreach ($usernav['items'] as $item)
			  	{
					if (!is_array($item))
					{
						// if string is ||| use vertical divider else use normal divider
						$html .= $item === '|||' ? '<li class="divider-vertical"></li>' : '<li class="divider"></li>';
					}
					else
					{
						$html .= '<li><a href="' . $item['url'] . '">' . $item['label'] . '</li>';
					}
			  	}
			  	$html .= '</ul>';
			}
		  	$html .= '</div>';
	  	}
	  	// End btn-dropdown support

	  	if($collapsible)
	  		$html .= '<div class="nav-collapse">';

	  	foreach ($menus as $menu)
		{
			// If is string add to html
			if (is_string($menu))
			{
				$html .= $menu;
			}
			else
			{
				$attr = isset($menu['attributes']) ? $menu['attributes'] : array();
				$html .= Navigation::unstyled($menu['items'], false, $attr, $autoroute);
			}
		}

	  	if($collapsible)
	  		$html .= '</div>';

	  	//close navbar containers
	  	$html .= '</div></div></div>';
	  	return $html;
	}
}