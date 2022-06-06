<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('lscache',true);


class lscache_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'lscache_ui',
			'path' 			=> null,
			'ui' 			=> 'lscache_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	
	//	'main/clear' 		=> array('caption'=> "Clear Cache", 'perm' => 'P'),
		// 'main/div0'      => array('divider'=> true),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P'),
		
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'LiteSpeed Cache';
}




				
class lscache_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'LiteSpeed Cache';
		protected $pluginName		= 'lscache';
	//	protected $eventName		= 'lscache-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= array (
		);		
		
		protected $fieldpref = array();
		

		protected $preftabs        = array('general'=>'General');
		protected $prefs = array(
			'status'		=> array('title'=> 'Status', 'tab'=>'general', 'type'=>'boolean', 'data' => 'str', 'help'=>'Enable/Disable Caching', 'writeParms' => array()),
			'debug'		=> array('title'=> 'Debug', 'tab'=>'general', 'type'=>'boolean', 'data' => 'str', 'help'=>'If enabled, LiteSpeed Cache will emit extra headers for testing while developing', 'writeParms' => array()),
			'ttl'		=> array('title'=> 'TTL', 'tab'=>'general', 'type'=>'number', 'data' => 'str', 'help'=>'Amount of time LiteSpeed web server will save pages in the public cache.', 'writeParms' => array()),
			'exclude'  => array('title'=> 'Exclude', 'tab'=>'general', 'type'=>'textarea', 'data'=>'str', 'help'=>'Enter partial URLs for pages you would like to exclude from caching. One per line.'),
		);

	
		public function init()
		{

			// This code may be removed once plugin development is complete. 
			if(!e107::isInstalled('lscache'))
			{
				e107::getMessage()->addWarning("This plugin is not yet installed. Saving and loading of preference or table data will fail.");
			}

		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}

		public function afterPrefsSave()
		{
			header('X-LiteSpeed-Purge: *');
		}
		
		// left-panel help menu area. (replaces e_help.php used in old plugins)
		public function renderHelp()
		{


			$caption = LAN_HELP;
			$text = 'Add the following to <b>.htaccess</b> '.print_a('
<IfModule LiteSpeed>
CacheLookup on
</IfModule>
',true);

			return array('caption'=>$caption,'text'=> $text);

		}
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
		
	
		
		
	*/
			
}
				


class lscache_form_ui extends e_admin_form_ui
{

}		
		
		
new lscache_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

