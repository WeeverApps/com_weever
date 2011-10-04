<?php
/*
*
*	Weever Cartographer R3S Output Template for Joomla
*	(c) 2010-2011 Weever Inc. <http://www.weever.ca/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
*	Version: 	0.9.2
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
*
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
jimport('joomla.environment.uri');

require_once(JPATH_THEMES . DS . 'weever_cartographer' . DS . 'simpledom' . DS . 'simpledom.php');
require_once(JPATH_THEMES . DS . 'weever_cartographer' . DS . 'classes' . DS . 'r3s.php');



	$lang =& JFactory::getLanguage();
    $mainframe = &JFactory::getApplication();
   
    // override K2's leading/primary/secondary/link lists
    JRequest::setVar('limit', 15);
    $items = $this->get('data');
    
    $feed = new R3SChannelMap;
    $feed->count = count($items);
    $feed->thisPage = 1;
    $feed->lastPage = 1;
    $feed->language = $lang->_default;
    $feed->sort = "normal";
    $feed->url = JURI::root()."index.php?".$_SERVER['QUERY_STRING'];
    $feed->description = "test";
    $feed->name = $this->category->name;
    $feed->items = array();
	        
	$feed->url = str_replace("?template=weever_cartographer","",$feed->url);
	$feed->url = str_replace("&template=weever_cartographer","",$feed->url);
	        
	        
	foreach((array)$items as $k=>$v)
    {
    	include('category_item.php');           	
    }
    

    
	// Set the MIME type for JSON output.
	$document =& JFactory::getDocument();
	header('Content-type: application/json');		
	header('Cache-Control: no-cache, must-revalidate');
	
	$callback = JRequest::getVar('callback');		

	$json = json_encode($feed);
	
	if($callback)
		$json = $callback . "(". $json .")";
	
	print_r($json);
	jexit();