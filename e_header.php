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

if(!empty($_POST))
{
	header('X-LiteSpeed-Purge: *');
}

if(!empty($lscachePref['status']) && deftrue('USER_AREA'))
{
	$time = (int) !empty($lscachePref['ttl']) ? $lscachePref['ttl'] : 3600;
	$type = !empty(USERID) ? 'private' : 'public';
	header('X-LiteSpeed-Cache-Control: '.$type.', max-age='.$time);
	header('X-LiteSpeed-Tag: '.$type);
}





