<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.1
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

jimport('joomla.application.component.model');

class WeeverModelTheme extends JModel
{

	public 	$json = null;

	public function __construct()
	{
       
       parent::__construct();
       
       $this->json = comWeeverHelper::getJsonThemeSync();
       
       $query = " SELECT `setting` FROM #__weever_config WHERE `option`='site_key' ";
       $db = &JFactory::getDBO();
       
       $db->setQuery($query);
       $key = $db->loadObject();
       $this->setState('site_key', $key->setting);
       
	}
	
	public function getAppData()
	{
		
		return $this->json;
	
	}
	
}