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
	private $pref;

	function __construct()
	{
		$this->pref = e107::pref('lscache');

		if(empty($this->pref['status']) || deftrue('e_DEBUG'))
		{
			return;
		}

		if(deftrue('e_ADMIN_AREA'))
		{
		//	$this->header('X-LiteSpeed-Purge: private, *');
			$this->header('X-LiteSpeed-Cache-Control: no-cache');
		/*	if(!empty($_POST))
			{
				$this->header('X-LiteSpeed-Purge: *');
				$this->header('X-LiteSpeed-Purge: private, *');
			}*/

			return;
		}

		// Caching Exclusions.
		if(!empty($this->pref['exclude']))
		{
			$tmp = explode("\n",$this->pref['exclude']);
			foreach($tmp as $line)
			{
				$line = trim($line);
				if(strpos(e_REQUEST_URI, $line) !== false)
				{
					$this->header('X-LiteSpeed-Cache-Control: no-cache');
					return;
				}
			}

		}

		// Precaution
		if(!empty($_POST))
		{
			$this->header('X-LiteSpeed-Cache-Control: no-cache');
			return;
			// $this->header('X-LiteSpeed-Purge: *');
		}

		$time = (int) !empty($this->pref['ttl']) ? $this->pref['ttl'] : 3600;
		$type = !empty(USERID) ? 'private' : 'public';

		$this->header('X-LiteSpeed-Cache-Control: '.$type.', max-age='.$time);

		if($route = e107::route())
		{
			$tmp = explode('/',$route);
			if(!empty($tmp[0]))
			{
				$type .= ", ".$tmp[0];
			}
		}

		$this->header('X-LiteSpeed-Tag: '.$type);

	}

	private function header($header)
	{
		header($header);
		$this->debug($header);
	}

	private function debug($header='')
	{
		if(empty($this->pref['debug']))
		{
			return;
		}

		$data =  date('c')."\t$header\t".e_REQUEST_URI."\t".defset('USERNAME', 'Guest')."\n";
		file_put_contents(__DIR__.'/lscache.log', $data, FILE_APPEND);


	}

}


new lscache_module;



