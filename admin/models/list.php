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

jimport('joomla.application.component.model');

class WeeverModelList extends JModel
{

	public $sortOrder	= null;
	public $components 	= null;
	public $json		= null;
	public $jsonTheme 	= null;
	public $jsonAccount = null;
	public $data		= null;
	
	public function __construct()
	{
        
        parent::__construct();
        
        $this->json 			= comWeeverHelper::getJsonTabSync();
    
        if( $this->json != false )        
        	$this->jsonAccount 		= comWeeverHelper::getJsonAccountSync();
         
        $mainframe 	= JFactory::getApplication();
        $option 	= JRequest::getCmd('option');
        
        $key = comWeeverHelper::getKey();
       
        $filter_order     = $mainframe->getUserStateFromRequest($option.'filter_order', 'filter_order', 'ordering', 'cmd');
        $filter_order_Dir = $mainframe->getUserStateFromRequest($option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word');
 
        $this->setState('filter_order', $filter_order);
        $this->setState('filter_order_Dir', $filter_order_Dir);
        $this->setState('site_key', $key);
        
	}
	
	private function _buildContentOrderBy()
	{
    	
    	$mainframe = JFactory::getApplication();
    	$option = JRequest::getCmd('option');

        $orderby = '';
        $filter_order     = $this->getState('filter_order');
        $filter_order_Dir = $this->getState('filter_order_Dir');

        if(!empty($filter_order) && !empty($filter_order_Dir) ){
                $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
        }

        return $orderby;
	}
	
		
	public function getCountSubtabs()
	{
	
		$db = &JFactory::getDBO();		
		
		$query = "	SELECT	type ".
				"	FROM	#__weever_tabs ".
				"	WHERE	published = '1' ".
				"	AND		type <> ".$db->Quote("tab")." ";
				
		$db->setQuery($query);
		$subtabs = $db->loadObjectList();
		$count = array("blog"=>0, "page"=>0, "video"=>0, "photo"=>0, "social"=>0, "contact"=>0);
		
		foreach((array)$subtabs as $k=>$v)
		{
			$count[$v->type]++;
		}
		
		return $count;	
	
	}
	
	
	public function getAccountData()
	{
		
		return $this->jsonAccount;
	
	}
	
		
	public function getTabsData()
	{
		
		return $this->json;
	
	}
	
	
	public function getContactItems()
	{
	
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__contact_details WHERE published = '1' AND access = '0'"; 
		else 
		 	$query = "SELECT * FROM #__contact_details WHERE published = '1' AND access < '2'"; 

	
		return $this->_getList($query);		

	}

	
	public function getMenuJoomlaBlogs()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE ( link LIKE '%option=com_content&view=category%' OR  link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=frontpage%' ) AND published = '1'";  
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE ( link LIKE '%option=com_content&view=category%' OR link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=featured%' ) AND published = '1'";  

		return $this->_getList($query);		

	}
	
	
	public function getMenuK2Blogs()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE link LIKE '%option=com_k2&view=itemlist%' AND published = '1'";  
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE link LIKE '%option=com_k2&view=itemlist%' AND published = '1'";  

		return $this->_getList($query);		

	}
	

	public function getMenuEasyBlogBlogs()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE link LIKE '%option=com_easyblog&view=categories%' OR link LIKE '%option=com_easyblog&view=tags%' AND published = '1'";  
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE (link LIKE '%option=com_easyblog&view=categories%' OR link LIKE '%option=com_easyblog&view=tags%') AND published = '1' AND title NOT LIKE '%COM_EASYBLOG_ADMIN%'";  

		return $this->_getList($query);		

	}
	
	
	public function getContentCategories()
	{
	
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1'";  
		else 
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1'";  
	
		return $this->_getList($query);
	
	}
	
/*
	public function getK2Categories()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access = '0'";  
		else 
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access < '2'";  
	
		return $this->_getList($query);
	
	}
*/	
	
	public function getMenuItems()
	{

		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE (link LIKE '%option=com_content&view=article%' OR link LIKE '%option=com_k2&view=item&layout=item%') AND published = '1'"; 
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE (link LIKE '%option=com_content&view=article%' OR link LIKE '%option=com_k2&view=item&layout=item%') AND published = '1'"; 
		
		return $this->_getList($query);		

	}



}