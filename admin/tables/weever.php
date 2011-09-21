<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/

defined('_JEXEC') or die;

class TableWeever extends JTable
{

	public $id 						= 0;
	public $name					= null;
	public $component 				= null;
	public $component_behaviour 	= null;
	public $component_id			= 0;
	public $icon					= null;
	public $published				= 0;
	public $parent_tab_id			= 0;
	public $cloud_tab_id			= 0;
	public $hash					= null;
	public $ordering				= 0;
	public $default					= 0;
	public $type					= null;
	public $cms_feed				= null;
	public $var 					= null;
	
	public function __construct(&$db)
	{
	
		parent::__construct('#__weever_tabs', 'id', $db);
			
	}


}