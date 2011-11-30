<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.2.3
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

		$appData = $this->get('appdata');
		$tabRows = array();
		
		$this->assignRef('tier', $appData->config->tier);

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
		
		if( comWeeverHelper::componentExists("com_k2") )
		{
		
			$blogK2CategoryDropdown =& $this->get('blogk2categorydropdown');
			$mapK2CategoryDropdown =& $this->get('mapk2categorydropdown');
			$directoryK2CategoryDropdown =& $this->get('directoryk2categorydropdown');
			$pageK2CategoryDropdown =& $this->get('pagek2categorydropdown');
	
		}
		else 
		{
		
			$blogK2CategoryDropdown = ""; $mapK2CategoryDropdown=""; 
			$pageK2CategoryDropdown=""; $directoryK2CategoryDropdown = "";
		
		}
		
		$this->assignRef('blogK2CategoryDropdown',$blogK2CategoryDropdown);
		$this->assignRef('mapK2CategoryDropdown',$mapK2CategoryDropdown);
		$this->assignRef('directoryK2CategoryDropdown',$directoryK2CategoryDropdown);
		$this->assignRef('pageK2CategoryDropdown',$pageK2CategoryDropdown);
		
		$blogMenuDropdown =& $this->get('blogmenudropdown');
		$this->assignRef('blogMenuDropdown',$blogMenuDropdown);
		
		$directoryJCategoryDropdown =& $this->get('directoryjcategorydropdown');
		$this->assignRef('directoryJCategoryDropdown',$directoryJCategoryDropdown);
		
		$blogJCategoryDropdown =& $this->get('blogjcategorydropdown');
		$this->assignRef('blogJCategoryDropdown',$blogJCategoryDropdown);

		$pageMenuDropdown =& $this->get('pagemenudropdown');
		$this->assignRef('pageMenuDropdown',$pageMenuDropdown);
		
		$pageJCategoryDropdown =& $this->get('pagejcategorydropdown');
		$this->assignRef('pageJCategoryDropdown',$pageJCategoryDropdown);
		
		$jContactDropdown =& $this->get('jcontactdropdown');
		$this->assignRef('jContactDropdown',$jContactDropdown);
		
		$this->assign('site_key', $state->get('site_key'));

       /* Get the values from the state object that were inserted in the model's construct function */
       $lists['order_Dir'] = $state->get( 'filter_order_Dir' );
       $lists['order']     = $state->get( 'filter_order' );

       $this->assignRef( 'lists', $lists );
       
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(6);
		$this->assign('appEnabled', $row->setting);
		
		$row->load(11);
		$this->assign('about_app', $row->setting);

		$row->load(13);
		$this->assign('about_app_name', $row->setting);

		$theme = $this->get('themedata');
		$this->assignRef('theme',$theme);
		
		comWeeverHelper::getJsStrings();			
		
		/* Time zone stuff for Facebook Events... */
		
	    $list = DateTimeZone::listAbbreviations();
	    $idents = DateTimeZone::listIdentifiers();
	
	    $data = $offset = $added = array();
	    foreach ($list as $abbr => $info) {
	        foreach ($info as $zone) {
	            if ( ! empty($zone['timezone_id'])
	                AND
	                ! in_array($zone['timezone_id'], $added)
	                AND 
	                  in_array($zone['timezone_id'], $idents)) {
	                $z = new DateTimeZone($zone['timezone_id']);
	                $c = new DateTime(null, $z);
	                $zone['time'] = $c->format('H:i a');
	                $data[] = $zone;
	                $offset[] = $z->getOffset($c);
	                $added[] = $zone['timezone_id'];
	            }
	        }
	    }
	
	    array_multisort($offset, SORT_ASC, $data);
	    $options = array();
	    $times = array();
	    foreach ($data as $key => $row) {
	        $options[$row['time']][] = $row['timezone_id'];
	        $times[$row['time']] = $row['time'];
	    }
	    
	    $this->assignRef('timezone_ids', $options);
	    $this->assignRef('timezone_times', $times);
	    
	    $version = new JVersion;
	    $joomla = $version->getShortVersion();
	    
	    if(substr($joomla,0,3) == '1.5')  // ### 1.5 only
	    {
	    	$link = 'index.php?option=com_content&amp;task=element&amp;tmpl=component&amp;object=id';
	    	$this->assignRef('jArticleLink', $link);
	    }
	    else 
	    {
	    	$link = 'index.php?option=com_content&amp;task=element&amp;tmpl=component&amp;layout=modal&amp;function=jSelectArticleNew';
	    	$this->assignRef('jArticleLink', $link);	    
	    }
	
		JSubMenuHelper::addEntry(JText::_('WEEVER_TAB_ITEMS'), 'index.php?option=com_weever', true);
		JSubMenuHelper::addEntry(JText::_('WEEVER_THEMING'), 'index.php?option=com_weever&view=theme&task=theme', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_ACCOUNT'), 'index.php?option=com_weever&view=account&task=account', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_SUPPORT_TAB'), 'index.php?option=com_weever&view=support&task=support', false);


		parent::display($tpl);
	
	}
	

}