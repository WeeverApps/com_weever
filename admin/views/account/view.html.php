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

jimport('joomla.application.component.view');
jimport('joomla.plugin.helper');

class WeeverViewAccount extends JView
{

	public function display($tpl = null)
	{
	
		$component = JComponentHelper::getComponent( 'com_weever' );

		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(6);
		$this->assign('appEnabled', $row->setting);
		$row->load(7);
		$staging = $row->setting;
		$this->assign('stagingMode', $row->setting);

		/* Call the state object */
		$state =& $this->get( 'state' );
		
		if(!$state->get('site_key'))
		{
		
			JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));
		
		}		
		
		$this->assign('site_key', $state->get('site_key'));
		
		$appData = $this->get('appdata');
		
		$this->assignRef('account',$appData);

		comWeeverHelper::getJsStrings();

		JSubMenuHelper::addEntry(JText::_('WEEVER_TAB_ITEMS'), 'index.php?option=com_weever', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_THEMING'), 'index.php?option=com_weever&view=theme&task=theme', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_ACCOUNT'), 'index.php?option=com_weever&view=account&task=account', true);

		
		parent::display($tpl);
	
	}



}