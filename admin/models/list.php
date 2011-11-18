<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.2.1
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


	public $blogs		= null;
	public $contacts	= null;
	public $pages		= null;
	public $dropdown 	= null;
	public $sortOrder	= null;
	public $components 	= null;
	public $json		= null;
	public $jsonTheme 	= null;
	public $data		= null;
	
	public function __construct()
	{
        
        parent::__construct();
        
        $this->json = comWeeverHelper::getJsonTabSync();
        $this->jsonTheme = comWeeverHelper::getJsonThemeSync();
         
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
        
        $query = " SELECT `setting` FROM #__weever_config WHERE `option`='site_key' ";
        $db = &JFactory::getDBO();
        
        $db->setQuery($query);
        $key = $db->loadObject();
       
        $filter_order     = $mainframe->getUserStateFromRequest($option.'filter_order', 'filter_order', 'ordering', 'cmd');
        $filter_order_Dir = $mainframe->getUserStateFromRequest($option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word');
 
        $this->setState('filter_order', $filter_order);
        $this->setState('filter_order_Dir', $filter_order_Dir);
        $this->setState('site_key', $key->setting);
        
	}
	
	private function _buildContentOrderBy()
	{
    	
    	$mainframe = JFactory::getApplication();
    	$option = JRequest::getCmd('option');

            $orderby = '';
            $filter_order     = $this->getState('filter_order');
            $filter_order_Dir = $this->getState('filter_order_Dir');

            /* Error handling is never a bad thing*/
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
		
	public function getAppData()
	{
		
		return $this->json;
	
	}
	
	public function getThemeData()
	{
		
		return $this->jsonTheme;
	
	}
	

	public function getJContactDropdown()
	{
		
		$this->dropdown = null;

		$this->getJContactDB();
		$this->parseJContactToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function getJContactDB()
	{
	
		$version = new JVersion;
		$joomla = $version->getShortVersion();
		
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT * FROM #__contact_details WHERE published = '1' AND access < '2'"; 
		} 
		else 
		{
		 	$query = "SELECT * FROM #__contact_details WHERE published = '1' AND access = '0'"; 
		}
	
		$this->contacts = $this->_getList($query);		

	}

	public function parseJContactToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-contact-joomla'>
		<select name='component_id' id='wx-add-contact-joomla-select' class='wx-component-id-select'><option value='0'>".JText::_('WEEVER_CHOOSE_CONTACT_PARENTHESES')."</option>";
		$hidden_array = "";
		$hidden = "";
	
		foreach((object)$this->contacts as $k=>$v)
		{

			$this->dropdown .= "<option value='".$v->id."'>".$v->name."</option>";
			$hidden = "<input type='hidden' name='contact_name[]' value='".$v->name."' />";
			$hidden_array .= $v->id.",";
		
		}
		
		$hidden_array = rtrim($hidden_array,",");
		$hidden .= "<input type='hidden' name='comp_array' value='".$hidden_array."' />";

		$this->dropdown .= "</select></div>". $hidden;
	
	}


	public function getPageK2CategoryDropdown()
	{
		
		$this->dropdown = null;
	
		$this->getPageK2CategoryDB();
		$this->parsePageK2CategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function getPageK2CategoryDB()
	{
	
		$this->pages = null;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
	
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access < '2'";  
		} 
		else 
		{
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access = '0'";  
		}
	

		$this->pages = $this->_getList($query);
	
	}	
	
	public function parsePageK2CategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-page-category-k2'>
		<select name='unnamed' id='wx-add-page-category-k2-select' class='wx-cms-feed-select'><option value='0'>".JText::_('WEEVER_CHOOSE_PAGE_K2CATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->pages as $k=>$v)
		{
			$link = "index.php?option=com_k2&view=itemlist&layout=category&task=category&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
		
	
	
	
	public function getPageJCategoryDropdown()
	{
		
		$this->dropdown = null;
	
		$this->getPageJCategoryDB();
		$this->parsePageJCategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function getPageJCategoryDB()
	{
	
		$this->pages = null;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
	
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access < '2'";  
		} 
		else 
		{
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access = '0'";  
		}
	

		$this->pages = $this->_getList($query);
	
	}	
	
	public function parsePageJCategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-page-category-joomla'>
		<select name='unnamed' id='wx-add-page-category-joomla-select' class='wx-cms-feed-select'><option value='0'>".JText::_('WEEVER_CHOOSE_PAGE_JCATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->pages as $k=>$v)
		{
			$link = "index.php?option=com_content&view=category&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
	
	
	public function getBlogMenuDropdown()
	{
	
		$this->dropdown = null;
	
		$this->getBlogMenuDB();
		$this->parseBlogMenuToSelectList();
	
		return $this->dropdown;
	
	}
	
	
		
	public function parseBlogMenuToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-blog-menu-item'>
		<select name='unnamed' id='wx-add-blog-menu-item-select' class='wx-cms-feed-select'><option>".JText::_('WEEVER_CHOOSE_BLOG_PARENTHESES')."</option>";
	
		foreach((object)$this->blogs as $k=>$v)
		{
			
			$this->dropdown .= "<option value='".$v->link."&template=weever_cartographer&Itemid=".$v->id."'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
	
	
	public function getBlogMenuDB()
	{
	
		$this->blogs = null;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
	
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT *, title AS name FROM #__menu WHERE (link LIKE '%option=com_content&view=category%' OR link LIKE '%option=com_k2&view=itemlist%' OR link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=featured%') AND published = '1' AND access < '2'";  
		} 
		else 
		{
		 	$query = "SELECT * FROM #__menu WHERE (link LIKE '%option=com_content&view=category%' OR link LIKE '%option=com_k2&view=itemlist%' OR link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=frontpage%') AND published = '1' AND access = '0'";  
		}
	

		$this->blogs = $this->_getList($query);		

	}
	

	
	public function getBlogJCategoryDropdown()
	{
	
		$this->dropdown = null;
	
		$this->getBlogJCategoryDB();
		$this->parseBlogJCategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function getDirectoryJCategoryDropdown()
	{
	
		$this->dropdown = null;
	
		$this->getBlogJCategoryDB();
		$this->parseDirectoryJCategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function parseDirectoryJCategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-directory-jcategory-item'>
		<select name='unnamed' id='wx-add-directory-jcategory-item-select' class='wx-cms-feed-select'><option>".JText::_('WEEVER_CHOOSE_DIRECTORY_JCATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->blogs as $k=>$v)
		{
			
			$link = "index.php?option=com_content&view=category&layout=blog&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
	
		
	public function parseBlogJCategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-blog-jcategory-item'>
		<select name='unnamed' id='wx-add-blog-jcategory-item-select' class='wx-cms-feed-select'><option>".JText::_('WEEVER_CHOOSE_BLOG_JCATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->blogs as $k=>$v)
		{
			
			$link = "index.php?option=com_content&view=category&layout=blog&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
	
	public function getBlogJCategoryDB()
	{
	
	
		$this->blogs = null;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
	
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access < '2'";  
		} 
		else 
		{
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access = '0'";  
		}
	

		$this->blogs = $this->_getList($query);
	
	}
	

	public function getBlogK2CategoryDropdown()
	{
	
		$this->dropdown = null;
	
		$this->getBlogK2CategoryDB();
		$this->parseBlogK2CategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function getMapK2CategoryDropdown()
	{
	
		$this->dropdown = null;
	
		$this->getBlogK2CategoryDB();
		$this->parseMapK2CategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	public function getDirectoryK2CategoryDropdown()
	{
	
		$this->dropdown = null;
	
		$this->getBlogK2CategoryDB();
		$this->parseDirectoryK2CategoryToSelectList();
	
		return $this->dropdown;
	
	}
	
	
		
	public function parseBlogK2CategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-blog-k2-category-item'>
		<select name='unnamed' id='wx-add-blog-k2-category-item-select' class='wx-cms-feed-select'><option>".JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->blogs as $k=>$v)
		{
			
			$link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
	
	public function parseDirectoryK2CategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-directory-k2-category-item'>
		<select name='unnamed' id='wx-add-directory-k2-category-item-select' class='wx-cms-feed-select'><option>".JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->blogs as $k=>$v)
		{
			
			$link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}

	public function parseMapK2CategoryToSelectList()
	{
	
		// pare to view soon
		$this->dropdown .= " <div id='wx-add-map-k2-category-item'>
		<select name='unnamed' id='wx-add-map-k2-category-item-select' class='wx-cms-feed-select'><option>".JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES')."</option>";
	
		foreach((object)$this->blogs as $k=>$v)
		{
			
			$link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id;
			$this->dropdown .= "<option value='".$link."&template=weever_cartographer'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}

	
	public function getBlogK2CategoryDB()
	{
	
		$this->blogs = null;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
	
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access < '2'";  
		} 
		else 
		{
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access = '0'";  
		}
	
		$this->blogs = $this->_getList($query);
	
	}
	
		
	public function getPageMenuDropdown()
	{
	
		$this->dropdown = null;
		
		$this->getPageMenuDB();
		$this->parsePageMenuToSelectList();
	
		return $this->dropdown;	
	
	}

	
	public function parsePageMenuToSelectList()
	{
	

		$this->dropdown .= " <div id='wx-add-page-menu-item'>
		<select id='wx-add-page-menu-item-select' class='wx-cms-feed-select' name='noname'><option value='0'>".JText::_('WEEVER_CHOOSE_CONTENT_ITEM_PARENTHESES')."</option>";
	
		foreach((object)$this->pages as $k=>$v)
		{
			
			$this->dropdown .= "<option value='".$v->link."'>".$v->name."</option>";
		
		}
		
		$this->dropdown .= "</select>
		</div>";
	
	}
	
	
	public function getPageMenuDB()
	{
	
		$this->pages = null;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
	
		if(substr($joomla,0,3) == '1.6' || substr($joomla,0,3) == '1.7' || substr($joomla,0,3) == '1.8' || substr($joomla,0,3) == '1.9')
		{
		 	$query = "SELECT *, title AS name FROM #__menu WHERE (link LIKE '%option=com_content&view=article%' OR link LIKE '%option=com_k2&view=item&layout=item%') AND published = '1' AND access < '2'"; 
		} 
		else 
		{
		 	$query = "SELECT * FROM #__menu WHERE (link LIKE '%option=com_content&view=article%' OR link LIKE '%option=com_k2&view=item&layout=item%') AND published = '1' AND access = '0'"; 
		}
		
		$this->pages = $this->_getList($query);		

	}



}