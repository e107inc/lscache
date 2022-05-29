<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2014 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Related configuration module - News
 *
 *
*/

if (!defined('e107_INIT')) { exit; }


$lscachePref = e107::pref('lscache');

if(deftrue('USER_AREA')) // prevents inclusion of JS/CSS/meta in the admin area.
{
	//e107::js('lscache', 'js/lscache.js');      // loads e107_plugins/lscache/js/lscache.js on every page.
	e107::css('lscache', 'css/lscache.css');    // loads e107_plugins/lscache/css/lscache.css on every page
	e107::meta('keywords', 'lscache,words');   // sets meta keywords on every page.
}



