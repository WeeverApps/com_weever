<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
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
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');


class WeeverViewList extends JView
{


	public function display($tpl = null)
	{
	
		JRequest::setVar('layout','default');
		$component = JComponentHelper::getComponent( 'com_weever' );
		$params = new JParameter( $component->params );
		
		/* Call the state object */
		$state =& $this->get( 'state' );
		
		if(!$state->get('site_key'))
		{
		
			JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));
		
		}		
		
		$tabRows =& $this->get('tabdata');
		$blogRows =& $this->get('blogdata');
		$pageRows =& $this->get('pagedata');
		$componentRows =& $this->get('componentdata');
		$listingComponentRows =& $this->get('listingcomponentdata');
		$contactRows =& $this->get('contactdata');
		$videoRows =& $this->get('videodata');
		$photoRows =& $this->get('photodata');
		$socialRows =& $this->get('socialdata');
		
		$this->assignRef('tabRows', $tabRows);
		$this->assignRef('blogRows', $blogRows);
		$this->assignRef('pageRows', $pageRows);
		$this->assignRef('componentRows', $componentRows);
		$this->assignRef('listingComponentRows', $listingComponentRows);
		$this->assignRef('contactRows', $contactRows);
		$this->assignRef('videoRows', $videoRows);
		$this->assignRef('photoRows', $photoRows);
		$this->assignRef('socialRows', $socialRows);
		
		$blogMenuDropdown =& $this->get('blogmenudropdown');
		$this->assignRef('blogMenuDropdown',$blogMenuDropdown);
		
		$blogJCategoryDropdown =& $this->get('blogjcategorydropdown');
		$this->assignRef('blogJCategoryDropdown',$blogJCategoryDropdown);
		
		$blogK2CategoryDropdown =& $this->get('blogk2categorydropdown');
		$this->assignRef('blogK2CategoryDropdown',$blogK2CategoryDropdown);

		$pageMenuDropdown =& $this->get('pagemenudropdown');
		$this->assignRef('pageMenuDropdown',$pageMenuDropdown);
		
		$pageJCategoryDropdown =& $this->get('pagejcategorydropdown');
		$this->assignRef('pageJCategoryDropdown',$pageJCategoryDropdown);
		
		$pageK2CategoryDropdown =& $this->get('pagek2categorydropdown');
		$this->assignRef('pageK2CategoryDropdown',$pageK2CategoryDropdown);
		
		$jContactDropdown =& $this->get('jcontactdropdown');
		$this->assignRef('jContactDropdown',$jContactDropdown);
		
		$this->assign('site_key', $state->get('site_key'));

       /* Get the values from the state object that were inserted in the model's construct function */
       $lists['order_Dir'] = $state->get( 'filter_order_Dir' );
       $lists['order']     = $state->get( 'filter_order' );

       $this->assignRef( 'lists', $lists );
       
		$row =& JTable::getInstance('WeeverConfig', 'Table');

		$row->load(100);
		$theme = json_decode($row->setting);
		$this->assignRef('theme',$theme);
		
		$this->get('jsStrings');			
		
		JSubMenuHelper::addEntry(JText::_('WEEVER_TAB_ITEMS'), 'index.php?option=com_weever', true);
		JSubMenuHelper::addEntry(JText::_('WEEVER_THEMING'), 'index.php?option=com_weever&view=theme&task=theme', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_ACCOUNT'), 'index.php?option=com_weever&view=account&task=account', false);


		parent::display($tpl);
	
	}

}