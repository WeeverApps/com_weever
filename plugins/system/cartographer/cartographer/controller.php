<?php
/*
*
*	Cartographer Content R3S Output Plugin for Joomla 1.5
*	(c) 2010-2011 Weever Inc. <http://www.weever.ca/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.8
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
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

define( 'JPATH_COMPONENT', JPATH_BASE.DS.'plugins'.DS.'system'.DS.'cartographer');

require_once(JPATH_COMPONENT.DS.'helpers'.DS.'query.php');
require_once(JPATH_COMPONENT.DS.'models'.DS.JRequest::getCmd('view').'.php');
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'simpledom'.'.php');

class ContentController extends JController
{


	function display()
	{
			
			//$this->_model      = &$this->getModel('Category','categoryModel');

			parent::display(true);

	}
}

$controller = new ContentController();
$controller->execute(JRequest::getCmd('task'), null, 'default', 'cmd');