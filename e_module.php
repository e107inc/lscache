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

class lscache_module
{
	function __construct()
	{
		$lscachePref = e107::pref('lscache');

		if(deftrue('e_ADMIN_AREA') || empty($lscachePref['status']))
		{
			return;
		}

		// Caching Exclusions.
		if(!empty($lscachePref['exclude']))
		{
			$tmp = explode("\n",$lscachePref['exclude']);
			foreach($tmp as $line)
			{
				$line = trim($line);
				if(strpos(e_REQUEST_URI, $line) !== false)
				{
					header('X-LiteSpeed-Cache-Control: no-cache');
			//		echo "<!-- Excluded from LiteSpeed Cache -->";
					return;
				}
			}

		}

		// Precaution
		if(!empty($_POST))
		{
			header('X-LiteSpeed-Cache-Control: no-cache');
			return;
			// header('X-LiteSpeed-Purge: *');
		}

		$time = (int) !empty($lscachePref['ttl']) ? $lscachePref['ttl'] : 3600;
		$type = !empty(USERID) ? 'private' : 'public';
		header('X-LiteSpeed-Cache-Control: '.$type.', max-age='.$time);
		header('X-LiteSpeed-Tag: '.$type);

	}

}


new lscache_module;



