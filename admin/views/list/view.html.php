<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	1.8
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
	
		comWeeverHelper::phpVersionCheck();
	
		//$k2Categories 	= new stdClass();
		$component 		= JComponentHelper::getComponent( 'com_weever' );
		$params 		= new JParameter( $component->params );
		
		JRequest::setVar('layout','default');
		
		$state 			= &$this->get( 'state' );
		$tabsData 		= $this->get('tabsdata');
		$appData 		= json_decode($tabsData)->results;
		$accountData 	= $this->get('AccountData');
		$tabRows 		= array();
		
		// fix for broken URLs
		$row			=& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(4);
		
		if( $row->setting != $appData->config->primary_domain ) {
		
			$row->setting 	= $appData->config->primary_domain;		
			$row->store();
			
		}
		
		$document 		= &JFactory::getDocument();
		
		$document->addCustomTag (
		
			'<script type="text/javascript">'.
			
				'wx.tabSyncData = ' . $tabsData .
			
			'</script>'
			
		);
		
		$this->assignRef('tier', $appData->config->tier);
		$this->assignRef('theme',$appData->theme_params);
		$this->assignRef('account', $accountData);

		foreach((array)$appData->tabs as $k=>$v)
		{
			
			$componentRow = $v->type . "Rows";
			${$componentRow}[] = $v;
		
		}
		
		$this->assignRef('tabRows', $tabRows);
		$this->assignRef('blogRows', $blogRows);
		$this->assignRef('directoryRows', $directoryRows);
		$this->assignRef('pageRows', $pageRows);
		$this->assignRef('componentRows', $componentRows);
		$this->assignRef('listingComponentRows', $listingComponentRows);
		$this->assignRef('contactRows', $contactRows);
		$this->assignRef('videoRows', $videoRows);
		$this->assignRef('photoRows', $photoRows);
		$this->assignRef('socialRows', $socialRows);
		$this->assignRef('formRows', $formRows);
		$this->assignRef('aboutappRows', $aboutappRows);
		$this->assignRef('panelRows', $panelRows);
		$this->assignRef('calendarRows', $calendarRows);
		$this->assignRef('mapRows', $mapRows);
		$this->assignRef('proximityRows', $proximityRows);
		/*
		if( comWeeverHelper::componentExists("com_k2") )
			$k2Categories 	= $this->get('k2Categories');
		*/	
		$contentCategories 	= $this->get('contentCategories');
		$menuItems 			= $this->get('menuItems');
		$menuJoomlaBlogs	= $this->get('menuJoomlaBlogs');
		$menuK2Blogs		= $this->get('menuK2Blogs');
		$menuEasyBlogBlogs		= $this->get('menuEasyBlogBlogs');
		$contactItems		= $this->get('contactItems');
		
		//$this->assignRef('k2Categories', $k2Categories);
		$this->assignRef('contentCategories', $contentCategories);
		$this->assignRef('menuJoomlaBlogs', $menuJoomlaBlogs);
		$this->assignRef('menuK2Blogs', $menuK2Blogs);
		$this->assignRef('menuEasyBlogBlogs', $menuEasyBlogBlogs);
		$this->assignRef('contactItems', $contactItems);
		
		$this->assign('site_key', $state->get('site_key'));

		$lists['order_Dir'] = $state->get( 'filter_order_Dir' );
		$lists['order']     = $state->get( 'filter_order' );
		
		$this->assignRef( 'lists', $lists );
		
		$this->assign('appEnabled', comWeeverHelper::getAppStatus() );
		
		comWeeverHelper::getJsStrings();			
		
		if( JRequest::getVar("wxTabSync") )
		{
			var_dump($appData);
		}
	
		JSubMenuHelper::addEntry(JText::_('WEEVER_TAB_ITEMS'), 'index.php?option=com_weever', true);
		JSubMenuHelper::addEntry(JText::_('WEEVER_THEMING'), 'index.php?option=com_weever&view=theme&task=theme', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_ACCOUNT'), 'index.php?option=com_weever&view=account&task=account', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_SUPPORT_TAB'), 'index.php?option=com_weever&view=support&task=support', false);

		parent::display($tpl);
	
	}

}