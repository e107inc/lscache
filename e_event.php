<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * XXX HIGHLY EXPERIMENTAL AND SUBJECT TO CHANGE WITHOUT NOTICE. 
*/

if (!defined('e107_INIT')) { exit; }


class lscache_event // plugin-folder + '_event'
{

	/**
	 * Configure functions/methods to run when specific e107 events are triggered.
	 * For a list of events, please visit: http://e107.org/developer-manual/classes-and-methods#events
	 * Developers can trigger their own events using: e107::getEvent()->trigger('plugin_event',$array);
	 * Where 'plugin' is the folder of their plugin and 'event' is a unique name of the event.
	 * $array is data which is sent to the triggered function. eg. myfunction($array) in the example below.
	 *
	 * @return array
	 */
	function config()
	{

		$event = array();

		$event[] = array(
			'name'	=> "admin_after_clear_cache", // when this is triggered... (see http://e107.org/developer-manual/classes-and-methods#events)
			'function'	=> "clearCache",
		);

		$event[] = array(
			'name'	=> "admin_ui_updated", // when this is triggered... (see http://e107.org/developer-manual/classes-and-methods#events)
			'function'	=> "clearCache",
		);

		$event[] = array(
			'name'	=> "admin_ui_created", // when this is triggered... (see http://e107.org/developer-manual/classes-and-methods#events)
			'function'	=> "clearCache",
		);

		$event[] = array(
			'name'	=> "admin_ui_delete", // when this is triggered... (see http://e107.org/developer-manual/classes-and-methods#events)
			'function'	=> "clearCache",
		);


		return $event;

	}


	function clearCache($data=null)
	{

		if(!empty($data['plugin']))
		{
			header('X-LiteSpeed-Purge: public,tag='.$data['plugin'].';private,tag='.$data['plugin']);
			e107::getMessage()->addInfo('Clearing LiteSpeed public/private cache with tag:<b>'.$data['plugin'].'</b>');
		}
		else
		{
			header('X-LiteSpeed-Purge: public,*;private,*');
			e107::getMessage()->addInfo('Clearing all LiteSpeed public/private cache');
		}


	}





} //end class

