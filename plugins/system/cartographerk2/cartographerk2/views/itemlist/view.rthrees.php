<?php
/*
*
*	Cartographer for K2 R3S Output Plugin for Joomla 1.5
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
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
* 
*  Original copyrights below this line
*  ===================================
**
 * @version		$Id: view.html.php 553 2010-09-13 10:26:33Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
jimport( 'joomla.environment.uri' );


class R3SItemMap {

	public 		$type;
	public 		$description;
	public 		$name;
	public 		$datetime		= array("published"=>"","modified"=>"","start"=>"","end"=>"");
	public 		$image			= array("mobile"=>"","full"=>"");
	public 		$tags			= array();
	public 		$url;
	public 		$uuid;
	public 		$author;
	public 		$publisher;
	public 		$relationships;

}

class R3SChannelMap {

	public 		$thisPage;
	public 		$lastPage;
	public 		$count;
	public 		$type			= "htmlContent";
	public 		$sort;
	public 		$language		= "en-GB"; // fill in Joomla lang
	public 		$copyright;
	public 		$license;
	public 		$generator		= "Cartographer-K2 for Joomla 1.5 v0.8";
	public 		$publisher;
	public 		$rating;
	public 		$url;
	public 		$description;
	public 		$name;
	public 		$r3sVersion		= "0.8";
	public 		$relationships;
	public 		$items;

}

class K2ViewItemlist extends JView {

    function display($tpl = null) 
    {

        $mainframe = &JFactory::getApplication();
        $params = &JComponentHelper::getParams('com_k2');
        $model = &$this->getModel('itemlist');
        $limitstart = JRequest::getInt('limitstart');
        $view = JRequest::getWord('view');
        $task = JRequest::getWord('task');


        //Get data depending on task
        switch ($task) {

            case 'category':
                //Get category
                $id = JRequest::getInt('id');
                JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
                $category = &JTable::getInstance('K2Category', 'Table');
                $category->load($id);

                //Access check
                $user = &JFactory::getUser();
                if ($category->access > $user->get('aid', 0)) {
                    JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                }
                if (!$category->published || $category->trash) {
                    JError::raiseError(404, JText::_("Category not found"));
                }

                //Merge params
                $cparams = new JParameter($category->params);
                if ($cparams->get('inheritFrom')) {
                    $masterCategory = &JTable::getInstance('K2Category', 'Table');
                    $masterCategory->load($cparams->get('inheritFrom'));
                    $cparams = new JParameter($masterCategory->params);
                }
                $params->merge($cparams);

                //Category link
               	$category->link = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($category->id.':'.urlencode($category->alias))));

                //Category image
                if (! empty($category->image)) {
                    $category->image = JURI::root().'media/k2/categories/'.$category->image;
                } else {
                    if ($params->get('catImageDefault')) {
                        $category->image = JURI::root().'components/com_k2/images/placeholder/category.png';
                    }
                }

                //Category plugins
                $dispatcher = &JDispatcher::getInstance();
                JPluginHelper::importPlugin('content');
                $category->text = $category->description;
                $dispatcher->trigger('onPrepareContent', array ( & $category, &$params, $limitstart));
                $category->description = $category->text;

                //Category K2 plugins
                $category->event->K2CategoryDisplay = '';
                JPluginHelper::importPlugin('k2');
                $results = $dispatcher->trigger('onK2CategoryDisplay', array(&$category, &$params, $limitstart));
                $category->event->K2CategoryDisplay = trim(implode("\n", $results));
                $category->text = $category->description;
                $dispatcher->trigger('onK2PrepareContent', array ( & $category, &$params, $limitstart));
                $category->description = $category->text;

                $this->assignRef('category', $category);
                $this->assignRef('user', $user);

                //Category childs
                $ordering = $params->get('subCatOrdering');
                $childs = $model->getCategoryFirstChilds($id, $ordering);
                if (count($childs)) {
                    foreach ($childs as $child) {
                        if ($params->get('subCatTitleItemCounter'))
                            $child->numOfItems = $model->countCategoryItems($child->id);

                        if (! empty($child->image)) {
                            $child->image = JURI::root().'media/k2/categories/'.$child->image;
                        } else {
                            if ($params->get('catImageDefault')) {
                                $child->image = JURI::root().'components/com_k2/images/placeholder/category.png';
                            }
                        }

                        $child->name = htmlspecialchars($child->name, ENT_QUOTES);
                        $child->link = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($child->id.':'.urlencode($child->alias))));
                        $subCategories[] = $child;

                    }
                    $this->assignRef('subCategories', $subCategories);
                }

                //Set limit
                $limit = $params->get('num_leading_items') + $params->get('num_primary_items') + $params->get('num_secondary_items') + $params->get('num_links');

                //Set featured flag
                JRequest::setVar('featured', $params->get('catFeaturedItems'));

                //Set layout
                $this->setLayout('category');

                //Set title
                $title = $category->name;
                $category->name = htmlspecialchars($category->name, ENT_QUOTES);
                break;

            case 'user':
                //Get user
                $id = JRequest::getInt('id');
                $user = &JFactory::getUser($id);

                //Check user status
                if ($user->block) {
                    JError::raiseError(404, JText::_('User not found'));
                }

                //Get K2 user profile
                $user->profile = $model->getUserProfile();

                //User image
                $user->avatar = K2HelperUtilities::getAvatar($user->id, $user->email, $params->get('userImageWidth'));

                //User K2 plugins
                $user->event->K2UserDisplay = '';
                if (is_object($user->profile) && $user->profile->id > 0) {

                    $dispatcher = &JDispatcher::getInstance();
                    JPluginHelper::importPlugin('k2');
                    $results = $dispatcher->trigger('onK2UserDisplay', array(&$user->profile, &$params, $limitstart));
                    $user->event->K2UserDisplay = trim(implode("\n", $results));

                }


                $this->assignRef('user', $user);
                
                $db = &JFactory::getDBO();
                $nullDate = $db->getNullDate();
                $date = &JFactory::getDate();
				$now = $date->toMySQL();
				
				$this->assignRef('nullDate', $nullDate);
				$this->assignRef('now', $now);
                

                //Set layout
                $this->setLayout('user');

                //Set limit
                $limit = $params->get('userItemCount');

                //Set title
                $title = $user->name;
                $user->name = htmlspecialchars($user->name, ENT_QUOTES);

                break;

            case 'tag':
                //Set layout
                $this->setLayout('generic');

                //Set limit
                $limit = $params->get('genericItemCount');

                //set title
                $title = JText::_('Displaying items by tag:').' '.JRequest::getVar('tag');
                break;

            case 'search':
                //Set layout
                $this->setLayout('generic');

                //Set limit
                $limit = $params->get('genericItemCount');

                //Set title
                $title = JText::_('Search results for:').' '.JRequest::getVar('searchword');
                break;

            case 'date':
                //Set layout
                $this->setLayout('generic');

                //Set limit
                $limit = $params->get('genericItemCount');

                //Set title
                if (JRequest::getInt('day')) {
                    $date = strtotime(JRequest::getInt('year').'-'.JRequest::getInt('month').'-'.JRequest::getInt('day'));
                    $title = JText::_('Items filtered by date:').' '.JHTML::_('date', $date, '%A, %d %B %Y');
                } else {
                    $date = strtotime(JRequest::getInt('year').'-'.JRequest::getInt('month'));
                    $title = JText::_('Items filtered by date:').' '.JHTML::_('date', $date, '%B %Y');
                }
                break;

            default:
                //Set layout
                $this->setLayout('category');
                $user = &JFactory::getUser();
                $this->assignRef('user', $user);

                //Set limit
                $limit = $params->get('num_leading_items') + $params->get('num_primary_items') + $params->get('num_secondary_items') + $params->get('num_links');
                //Set featured flag
                JRequest::setVar('featured', $params->get('catFeaturedItems'));

                //Set title
                $title = $params->get('page_title');

                break;

        }

        //Set limit for model
        //if(!$limit) $limit = 10;
        //JRequest::setVar('limit', $limit);

        //Get ordering
        if($task=='tag')
        	$ordering = $params->get('tagOrdering');
        else
        	$ordering = $params->get('catOrdering');

        //Get items
        $items = $model->getData($ordering);
        
        $feed = new R3SChannelMap;
        $feed->count = count($items);
        $feed->thisPage = 1;
        $feed->lastPage = 1;
        $feed->sort = "normal";
        $feed->url = JURI::root()."index.php?".$_SERVER['QUERY_STRING'];
        $feed->description = ""; //nothing yet
        $feed->name = $category->text;
        $feed->items = array();
		        
		$feed->url = str_replace("?format=rthrees","",$feed->url);
		$feed->url = str_replace("format=rthrees","",$feed->url);
		        
        foreach((array)$items as $v)
        {
        	$v->image = null;
        	
        	if(JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$v->id).'_XS.jpg'))
        	{
        		$v->image = JURI::root().'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5('Image'.$v->id)."_XS.jpg";
        	}	
        	else
        	{
        		$html = SimpleHTMLDomHelper::str_get_html($v->introtext);
        		
        		foreach(@$html->find('img') as $vv)
        		{
        			if($vv->src)
        				$v->image = JURI::root().$vv->src;
        		}
        		
        		if(!$v->image)
        			$v->image = JURI::root()."media/com_weever/icon_live.png";
        	}
        	
        	$v->introtext = "";
        	
        	$feedItem = new R3SItemMap;
        	
        	$feedItem->type = "htmlContent";
        	$feedItem->description = $v->introtext;
        	$feedItem->name = $v->title;
        	$feedItem->datetime["published"] = $v->created;
        	$feedItem->datetime["modified"] = $v->modified;
        	$feedItem->image["mobile"] = $v->image;
        	$feedItem->image["full"] = $v->image;
        	$feedItem->url = JURI::root()."index.php?option=com_k2&view=item&id=".$v->id;
        	$feedItem->author = $v->created_by;
        	$feedItem->publisher = $mainframe->getCfg('sitename');
        	
        	$feedItem->url = str_replace("?format=rthrees","",$feedItem->url);
        	$feedItem->url = str_replace("format=rthrees","",$feedItem->url);
        	
        	$feed->items[] = $feedItem;
        	
        }
        
        
        // Create DOM from URL or file
        
        
        /*
        foreach((array) $items as $v)
        {
        	$html = SimpleHTMLDomHelper::str_get_html($v->image);
        	
        	echo $v->image;
        	die();
        	$v->image = "";
        	foreach($html->find('img') as $vv)
        	{
        		$v->image = $vv->src;
        		break;
    		}
    		if(!$v->image)
    		{
    			$html = SimpleHTMLDomHelper::str_get_html($v->empty);
    			
    			foreach($html->find('img') as $vv)
    			{
    				$v->image = $vv->src;
    				break;
    			}
    			
    			
    		}
    		$v->empty = "";
        }
        */
        
		// Set the MIME type for JSON output.
		$document =& JFactory::getDocument();
		$document->setMimeEncoding( 'application/json' );
		
		header('Cache-Control: no-cache, must-revalidate');
		
		$callback = JRequest::getVar('callback');		

		$json = json_encode($feed);
		
		if($callback)
			$json = $callback . "(". $json .")";
		
		print_r($json);
		jexit();

    }

}
