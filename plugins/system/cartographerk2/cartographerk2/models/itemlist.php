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
*  Original copyrights below this line
*  ===================================
**
 * @version		$Id: itemlist.php 555 2010-09-17 13:17:20Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

class K2ModelItemlist extends JModel {

    function getData($ordering = NULL) {

        $user = &JFactory::getUser();
        $aid = $user->get('aid');
        $db = &JFactory::getDBO();
        $params = &JComponentHelper::getParams('com_k2');
        $limitstart = JRequest::getInt('limitstart');
        $limit = JRequest::getInt('limit');
        $task = JRequest::getCmd('task');
        if($task=='search' && $params->get('googleSearch'))
        	return array();

        $jnow = &JFactory::getDate();
        $now = $jnow->toMySQL();
        $nullDate = $db->getNullDate();

        if (JRequest::getWord('format') == 'feed')
            $limit = $params->get('feedLimit');
            
            // ### i.* replaced with all but text

        $query = "SELECT i.introtext, i.id, i.title, i.alias, i.catid, i.video, i.gallery, i.extra_fields, i.extra_fields_search, i.created, i.created_by, i.created_by_alias, i.modified, i.modified_by, i.publish_up, i.image_caption as image, i.video_caption, i.video_credits, i.metadesc, i.metadata, c.name as categoryname,c.id as categoryid, c.alias as categoryalias";
        if ($ordering == 'best')
            $query .= ", (r.rating_sum/r.rating_count) AS rating";

        $query.=" FROM #__k2_items as i LEFT JOIN #__k2_categories AS c ON c.id = i.catid";

        if ($ordering == 'best')
            $query .= " LEFT JOIN #__k2_rating r ON r.itemID = i.id";

        if ($task == 'tag')
            $query .= " LEFT JOIN #__k2_tags_xref AS tags_xref ON tags_xref.itemID = i.id LEFT JOIN #__k2_tags AS tags ON tags.id = tags_xref.tagID";

        if($task=='user' && !$user->guest && $user->id==JRequest::getInt('id')){
        	$query .= " WHERE ";
        }
        else {
        	 $query .= " WHERE i.published = 1 AND ";
        }

        $query .= "i.access <= {$aid}"
        ." AND i.trash = 0"
        ." AND c.published = 1"
        ." AND c.access <= {$aid}"
        ." AND c.trash = 0";

        if( !($task=='user' && !$user->guest && $user->id==JRequest::getInt('id') )) {
        	$query .= " AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )";
        	$query .= " AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )";
        }

        //Build query depending on task
        switch ($task) {

            case 'category':
                $id = JRequest::getInt('id');

                $category = &JTable::getInstance('K2Category', 'Table');
                $category->load($id);
                $cparams = new JParameter($category->params);

                if ($cparams->get('inheritFrom')) {

                    $parent = &JTable::getInstance('K2Category', 'Table');
                    $parent->load($cparams->get('inheritFrom'));
                    $cparams = new JParameter($parent->params);
                }

                if ($cparams->get('catCatalogMode')) {
                    $query .= " AND c.id={$id} ";
                } else {
                	$clearFlag = JRequest::getBool('clearFlag');
                    $categories = K2ModelItemlist::getCategoryChilds($id, $clearFlag);
                    $categories[] = $id;
                    $categories = @array_unique($categories);
                    JArrayHelper::toInteger($categories);
                    $sql = @implode(',', $categories);
                    $query .= " AND c.id IN ({$sql})";
                }


                break;

            case 'user':
                $id = JRequest::getInt('id');
                $query .= " AND i.created_by={$id} AND i.created_by_alias=''";
                break;

            case 'search':
                $badchars = array('#', '>', '<', '\\');
                $search = trim(str_replace($badchars, '', JRequest::getString('searchword', null)));
                if (! empty($search)) {
                    $sql = K2ModelItemlist::prepareSearch($search);
                    if (! empty($sql)) {
                        $query .= $sql;
                    } else {
                        $rows = array();
                        return $rows;
                    }
                }
                break;

            case 'date':
                if ((JRequest::getInt('month')) && (JRequest::getInt('year'))) {
                    $month = JRequest::getInt('month');
                    $year = JRequest::getInt('year');
                    $query .= " AND MONTH(i.created) = {$month} AND YEAR(i.created)={$year} ";
                    if (JRequest::getInt('day')) {
                        $day = JRequest::getInt('day');
                        $query .= " AND DAY(i.created) = {$day}";
                    }

                    if (JRequest::getInt('catid')) {
                        $catid = JRequest::getInt('catid');
                        $query .= " AND i.catid={$catid}";
                    }

                }
                break;

            case 'tag':
                $tag = JRequest::getString('tag');
                jimport('joomla.filesystem.file');
                if (JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish') && $task == 'tag') {

                    $registry = &JFactory::getConfig();
                    $lang = $registry->getValue("config.jflang");

                    $sql = " SELECT reference_id FROM #__jf_content as jfc LEFT JOIN #__languages as jfl ON jfc.language_id = jfl.id";
                    $sql .= " WHERE jfc.value = ".$db->Quote($tag);
                    $sql .= " AND jfc.reference_table = 'k2_tags'";
                    $sql .= " AND jfc.reference_field = 'name' AND jfc.published=1";

                    $db->setQuery($sql, 0, 1);
                    $result = $db->loadResult();

                }

                if (isset($result) && $result > 0) {
                    $query .= " AND (tags.id) = {$result}";
                } else {
                    $query .= " AND (tags.name) = ".$db->Quote($tag);
                }

                $categories = $params->get('categoriesFilter', NULL);
                if (is_array($categories)){
                	JArrayHelper::toInteger($categories);
                    $query .= " AND i.catid IN(".implode(',', $categories).")";
                }
                if (is_string($categories))
                    $query .= " AND i.catid = {$categories}";
                break;

            default:
               
               if(!JRequest::getVar('Itemid'))
               {
               
               		 $searchIDs = $params->get('categories');
               
  				} 
  				else
  				{
               
	               $menu = &JSite::getMenu();
	               $menuparams = NULL;
	               $menuparams = $menu->getParams(JRequest::getVar('Itemid'));
	               
	               $searchIDs = $menuparams->get('categories');

				}
                if (is_array($searchIDs) && count($searchIDs)) {

                    if ($params->get('catCatalogMode')) {
                        $sql = @implode(',', $searchIDs);
                        $query .= " AND i.catid IN ({$sql})";
                    } else {
                        $childIDs = array();
                        foreach ($searchIDs as $catid) {
                            $categories = K2ModelItemlist::getCategoryChilds($catid);
                            foreach ($categories as $child) {
                                $childIDs[] = $child;
                            }
                        }

                        $allIDs = @array_merge($searchIDs, $childIDs);
                        $result = @array_unique($allIDs);
                        JArrayHelper::toInteger($result);
                        if (count($result)) {
                            $sql = @implode(',', $result);
                            $query .= " AND i.catid IN ({$sql})";
                        }
                    }
                }

                break;
        }

        //Set featured flag
        if ($task == 'category' || empty($task)) {
            if (JRequest::getInt('featured') == '0') {
                $query .= " AND i.featured != 1";
            } else if (JRequest::getInt('featured') == '2') {
                $query .= " AND i.featured = 1";
            }
        }

        //Remove duplicates
        //$query .= " GROUP BY i.id";

        //Set ordering
        switch ($ordering) {

            case 'date':
                $orderby = 'i.created ASC';
                break;

            case 'rdate':
                $orderby = 'i.created DESC';
                break;

            case 'alpha':
                $orderby = 'i.title';
                break;

            case 'ralpha':
                $orderby = 'i.title DESC';
                break;

            case 'order':
                if (JRequest::getInt('featured') == '2')
                    $orderby = 'i.featured_ordering';
                else
                    $orderby = 'i.ordering';
                break;

            case 'rorder':
                if (JRequest::getInt('featured') == '2')
                    $orderby = 'i.featured_ordering DESC';
                else
                    $orderby = 'i.ordering DESC';
                break;

            case 'hits':
                $orderby = 'i.hits DESC';
                break;

            case 'rand':
                $orderby = 'RAND()';
                break;

            case 'best':
                $orderby = 'rating DESC';
                break;

            default:
                $orderby = 'i.id DESC';
                break;
        }

        $query .= " ORDER BY ".$orderby;
        $db->setQuery($query, $limitstart, $limit);
        $rows = $db->loadObjectList();
        return $rows;
    }

    function getTotal() {

        $user = &JFactory::getUser();
        $aid = $user->get('aid');
        $db = &JFactory::getDBO();
        $params = &JComponentHelper::getParams('com_k2');
        $task = JRequest::getCmd('task');

        if($task=='search' && $params->get('googleSearch'))
        	return 0;

        $jnow = &JFactory::getDate();
        $now = $jnow->toMySQL();
        $nullDate = $db->getNullDate();

        $query = "SELECT COUNT(*) FROM #__k2_items as i"." LEFT JOIN #__k2_categories c ON c.id = i.catid";

        if ($task == 'tag')
            $query .= " LEFT JOIN #__k2_tags_xref tags_xref ON tags_xref.itemID = i.id LEFT JOIN #__k2_tags tags ON tags.id = tags_xref.tagID";

        if($task=='user' && !$user->guest && $user->id==JRequest::getInt('id')){
        	$query .= " WHERE ";
        }
        else {
        	 $query .= " WHERE i.published = 1 AND ";
        }

        $query .= "i.access <= {$aid}"
        ." AND i.trash = 0"
        ." AND c.published = 1"
        ." AND c.access <= {$aid}"
        ." AND c.trash = 0";

        $query .= " AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )";
        $query .= " AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )";

        //Build query depending on task
        switch ($task) {

            case 'category':
                $id = JRequest::getInt('id');

                $category = &JTable::getInstance('K2Category', 'Table');
                $category->load($id);
                $cparams = new JParameter($category->params);

                if ($cparams->get('inheritFrom')) {

                    $parent = &JTable::getInstance('K2Category', 'Table');
                    $parent->load($cparams->get('inheritFrom'));
                    $cparams = new JParameter($parent->params);
                }

                if ($cparams->get('catCatalogMode')) {
                    $query .= " AND c.id={$id} ";
                } else {
                    $categories = K2ModelItemlist::getCategoryChilds($id);
                    $categories[] = $id;
                    $categories = @array_unique($categories);
                    JArrayHelper::toInteger($categories);
                    $sql = @implode(',', $categories);
                    $query .= " AND c.id IN ({$sql})";
                }


                break;


            case 'user':
                $id = JRequest::getInt('id');
                $query .= " AND i.created_by={$id} AND i.created_by_alias=''";
                break;

            case 'search':
                $badchars = array('#', '>', '<', '\\');
                $search = trim(str_replace($badchars, '', JRequest::getString('searchword', null)));
                if (! empty($search)) {
                    $sql = K2ModelItemlist::prepareSearch($search);
                    if (! empty($sql)) {
                        $query .= $sql;
                    } else {
                        $result = 0;
                        return $result;
                    }
                }
                break;

            case 'date':
                if ((JRequest::getInt('month')) && (JRequest::getInt('year'))) {
                    $month = JRequest::getInt('month');
                    $year = JRequest::getInt('year');
                    $query .= " AND MONTH(i.created) = {$month} AND YEAR(i.created)={$year} ";
                    if (JRequest::getInt('day')) {
                        $day = JRequest::getInt('day');
                        $query .= " AND DAY(i.created) = {$day}";
                    }

                    if (JRequest::getInt('catid')) {
                        $catid = JRequest::getInt('catid');
                        $query .= " AND i.catid={$catid}";
                    }

                }
                break;

            case 'tag':
                $tag = JRequest::getString('tag');
                jimport('joomla.filesystem.file');
                if (JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish') && $task == 'tag') {

                    $registry = &JFactory::getConfig();
                    $lang = $registry->getValue("config.jflang");

                    $sql = " SELECT reference_id FROM #__jf_content as jfc LEFT JOIN #__languages as jfl ON jfc.language_id = jfl.id";
                    $sql .= " WHERE jfc.value = ".$db->Quote($tag);
                    $sql .= " AND jfc.reference_table = 'k2_tags'";
                    $sql .= " AND jfc.reference_field = 'name' AND jfc.published=1";

                    $db->setQuery($sql, 0, 1);
                    $result = $db->loadResult();

                }

                if (isset($result) && $result > 0) {
                    $query .= " AND (tags.id) = {$result}";
                } else {
                    $query .= " AND (tags.name) = ".$db->Quote($tag);
                }
                $categories = $params->get('categoriesFilter', NULL);
                if (is_array($categories))
                    $query .= " AND i.catid IN(".implode(',', $categories).")";
                if (is_string($categories))
                    $query .= " AND i.catid = {$categories}";
                break;

            default:
                $searchIDs = $params->get('categories');

                if (is_array($searchIDs) && count($searchIDs)) {

                    if ($params->get('catCatalogMode')) {
                        $sql = @implode(',', $searchIDs);
                        $query .= " AND i.catid IN ({$sql})";
                    } else {
                        $childIDs = array();
                        foreach ($searchIDs as $catid) {
                            $categories = K2ModelItemlist::getCategoryChilds($catid);
                            foreach ($categories as $child) {
                                $childIDs[] = $child;
                            }
                        }

                        $allIDs = @array_merge($searchIDs, $childIDs);
                        $result = @array_unique($allIDs);
                        JArrayHelper::toInteger($result);
                        if (count($result)) {
                            $sql = @implode(',', $result);
                            $query .= " AND i.catid IN ({$sql})";
                        }
                    }
                }

                break;
        }

        //Set featured flag
        if ($task == 'category' || empty($task)) {
            if (JRequest::getVar('featured') == '0') {
                $query .= " AND i.featured != 1";
            } else if (JRequest::getVar('featured') == '2') {
                $query .= " AND i.featured = 1";
            }
        }
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;
    }

    function getCategoryChilds($catid, $clear = false) {

        static $array = array();
        if ($clear)
            $array = array();
        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $catid = (int) $catid;
        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE parent={$catid} AND published=1 AND trash=0 AND access<={$aid} ORDER BY ordering ";
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        foreach ($rows as $row) {
            array_push($array, $row->id);
            if (K2ModelItemlist::hasChilds($row->id)) {
                K2ModelItemlist::getCategoryChilds($row->id);
            }
        }
        return $array;
    }

    function hasChilds($id) {

        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $id = (int) $id;
        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE parent={$id} AND published=1 AND trash=0 AND access<={$aid} ";
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        if (count($rows)) {
            return true;
        } else {
            return false;
        }
    }

    function getCategoryFirstChilds($catid, $ordering = NULL) {

        $user = &JFactory::getUser();
        $aid = $user->get('aid');
        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE parent={$catid} AND published=1 AND trash=0 AND access<={$aid} ";

        switch ($ordering) {

            case 'order':
                $order = " ordering ASC";
                break;

            case 'alpha':
                $order = " name ASC";
                break;

            case 'ralpha':
                $order = " name DESC";
                break;

            case 'reversedefault':
                $order = " id DESC";
                break;

            default:
                $order = " id ASC";
                break;

        }

        $query .= " ORDER BY {$order}";

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }

        return $rows;
    }

    function countCategoryItems($id) {

        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $id = (int) $id;
        $db = &JFactory::getDBO();

        $jnow = &JFactory::getDate();
        $now = $jnow->toMySQL();
        $nullDate = $db->getNullDate();

        $catIDs = array();
        $catIDs[] = $id;
        $categories = K2ModelItemlist::getCategoryChilds($id, true);
        foreach ($categories as $child) {
            $catIDs[] = $child;
        }
        $total = 0;
        JArrayHelper::toInteger($catIDs);
        foreach ($catIDs as $catid) {
            $query = "SELECT COUNT(*) FROM #__k2_items WHERE catid={$catid} AND published=1 AND trash=0 AND access<=".$aid;
            $query .= " AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." )";
            $query .= " AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." )";
            $db->setQuery($query);
            $total += $db->loadResult();

        }
        return $total;
    }

    function getUserProfile($id = NULL) {

        $db = &JFactory::getDBO();
        if (is_null($id))
            $id = JRequest::getInt('id');
        else
        	$id = (int) $id;
        $query = "SELECT id, gender, description, image, url, `group`, plugins FROM #__k2_users WHERE userID={$id}";
        $db->setQuery($query);
        $row = $db->loadObject();
        return $row;
    }

    function getAuthorLatest($itemID, $limit, $userID) {

        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $itemID = (int) $itemID;
        $userID = (int) $userID;
        $limit = (int) $limit;
        $db = &JFactory::getDBO();

        $jnow = &JFactory::getDate();
        $now = $jnow->toMySQL();
        $nullDate = $db->getNullDate();

        $query = "SELECT i.*, c.alias as categoryalias FROM #__k2_items as i LEFT JOIN #__k2_categories c ON c.id = i.catid WHERE i.id != {$itemID}"." AND i.published = 1"." AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )"." AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )"." AND i.access <= {$aid}"." AND i.trash = 0"." AND i.created_by = {$userID}"." AND i.created_by_alias=''"." AND c.published = 1"." AND c.access <= {$aid}"." AND c.trash = 0"." ORDER BY i.created DESC";

        $db->setQuery($query, 0, $limit);
        $rows = $db->loadObjectList();
        return $rows;
    }

    function getRelatedItems($itemID, $tags, $limit) {

        $params = &JComponentHelper::getParams('com_k2');
        $itemID = (int) $itemID;
        foreach ($tags as $tag) {
            $tagIDs[] = $tag->id;
        }
        JArrayHelper::toInteger($tagIDs);
        $sql = implode(',', $tagIDs);

        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $db = &JFactory::getDBO();

        $jnow = &JFactory::getDate();
        $now = $jnow->toMySQL();
        $nullDate = $db->getNullDate();

        $query = "SELECT DISTINCT itemID FROM #__k2_tags_xref WHERE tagID IN ({$sql}) AND itemID!={$itemID}";
 		$db->setQuery($query);
        $itemsIDs = $db->loadResultArray();

        if(!count($itemsIDs))
        	return array();

        $sql = implode(',', $itemsIDs);

        $query = "SELECT i.*, c.alias as categoryalias FROM #__k2_items as i"
        ." LEFT JOIN #__k2_categories c ON c.id = i.catid"
        ." WHERE i.published = 1"
        ." AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )"
        ." AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )"
        ." AND i.access <= {$aid}"." AND i.trash = 0"." AND c.published = 1"." AND c.access <= {$aid}"
        ." AND c.trash = 0"
        ." AND (i.id) IN ({$sql})"
        ." ORDER BY i.created DESC";

        $db->setQuery($query, 0, $limit);
        $rows = $db->loadObjectList();
        foreach ($rows as $item) {

            //Image
            $item->imageXSmall = '';
            $item->imageSmall = '';
            $item->imageMedium = '';
            $item->imageLarge = '';
            $item->imageXLarge = '';

            if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XS.jpg'))
                $item->imageXSmall = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_XS.jpg';

            if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_S.jpg'))
                $item->imageSmall = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_S.jpg';

            if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_M.jpg'))
                $item->imageMedium = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_M.jpg';

            if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_L.jpg'))
                $item->imageLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_L.jpg';

            if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XL.jpg'))
                $item->imageXLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_XL.jpg';

            if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_Generic.jpg'))
                $item->imageGeneric = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_Generic.jpg';

            //Author
            if (! empty($item->created_by_alias)) {
                $item->author->name = $item->created_by_alias;
                $item->author->avatar = K2HelperUtilities::getAvatar('alias');
            } else {
                $author = &JFactory::getUser($item->created_by);
                $item->author = $author;
                $item->author->link = JRoute::_(K2HelperRoute::getUserRoute($item->created_by));
                $item->author->profile = K2ModelItem::getUserProfile($item->created_by);
                $item->author->avatar = K2HelperUtilities::getAvatar($author->id, $author->email, $params->get('userImageWidth'));
            }

            if (!is_object($item->author->profile)) {

                $item->author->profile = new JObject;
                $item->author->profile->gender = NULL;

            }


        }
        return $rows;
    }

    function prepareSearch($search) {

    	jimport('joomla.filesystem.file');
    	$db = &JFactory::getDBO();
    	$language = &JFactory::getLanguage();
    	$defaultLang = $language->getDefault();
    	$currentLang = $language->getTag();
    	$length = JString::strlen($search);

    	if (JString::substr($search, 0, 1) == '"' && JString::substr($search, $length - 1, 1) == '"') {
    		$type = 'exact';
    	}
    	else {
    		$type='any';
    	}

    	if (JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish') && $currentLang != $defaultLang) {

    		$conditions = array();
    		$search_ignore = array();
    		$sql = '';

    		$ignoreFile = $language->getLanguagePath().DS.$currentLang.DS.$currentLang.'.ignore.php';

    		if (JFile::exists($ignoreFile)) {
    			include $ignoreFile;
    		}

    		if ($type=='exact') {

    			$word = JString::substr($search, 1, $length - 2);

    			if (JString::strlen($word) > 3 && !in_array($word, $search_ignore)) {
    				$word = $db->Quote('%'.$db->getEscaped($word, true).'%', false);



    				$jfQuery = " SELECT reference_id FROM #__jf_content as jfc LEFT JOIN #__languages as jfl ON jfc.language_id = jfl.id";
    				$jfQuery .= " WHERE jfc.reference_table = 'k2_items'";
    				$jfQuery .= " AND jfl.code=".$db->Quote($currentLang);
    				$jfQuery .= " AND jfc.published=1";
    				$jfQuery .= " AND jfc.value LIKE ".$word;
    				$jfQuery .= " AND (jfc.reference_field = 'title'
								OR jfc.reference_field = 'introtext'
								OR jfc.reference_field = 'fulltext'
								OR jfc.reference_field = 'image_caption'
								OR jfc.reference_field = 'image_credits'
								OR jfc.reference_field = 'video_caption'
								OR jfc.reference_field = 'video_credits'
								OR jfc.reference_field = 'extra_fields_search'
								OR jfc.reference_field = 'metadesc'
								OR jfc.reference_field = 'metakey'
					)";
    				$db->setQuery($jfQuery);
    				$result = $db->loadResultArray();
    				$result = @array_unique($result);
    				JArrayHelper::toInteger($result);
    				if (count($result)) {
    					$conditions[] = "i.id IN(".implode(',', $result).")";
    				}

    			}

    		} else {
    			$search = explode(' ', JString::strtolower($search));
    			foreach ($search as $searchword) {

    				if (JString::strlen($searchword) > 3 && !in_array($searchword, $search_ignore)) {

    					$word = $db->Quote('%'.$db->getEscaped($searchword, true).'%', false);

    					$jfQuery = " SELECT reference_id FROM #__jf_content as jfc LEFT JOIN #__languages as jfl ON jfc.language_id = jfl.id";
    					$jfQuery .= " WHERE jfc.reference_table = 'k2_items'";
    					$jfQuery .= " AND jfl.code=".$db->Quote($currentLang);
    					$jfQuery .= " AND jfc.published=1";
    					$jfQuery .= " AND jfc.value LIKE ".$word;
    					$jfQuery .= " AND (jfc.reference_field = 'title'
									OR jfc.reference_field = 'introtext'
									OR jfc.reference_field = 'fulltext'
									OR jfc.reference_field = 'image_caption'
									OR jfc.reference_field = 'image_credits'
									OR jfc.reference_field = 'video_caption'
									OR jfc.reference_field = 'video_credits'
									OR jfc.reference_field = 'extra_fields_search'
									OR jfc.reference_field = 'metadesc'
									OR jfc.reference_field = 'metakey'
						)";
    					$db->setQuery($jfQuery);
    					$result = $db->loadResultArray();
    					$result = @array_unique($result);
    					foreach ($result as $id) {
    						$allIDs[] = $id;
    					}

    					if (JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish') && $currentLang != $defaultLang) {

    						if (isset($allIDs) && count($allIDs)) {
    							JArrayHelper::toInteger($allIDs);
    							$conditions[] = "i.id IN(".implode(',', $allIDs).")";
    						}

    					}


    				}

    			}


    		}

    		if (count($conditions)) {
    			$sql = " AND (".implode(" OR ", $conditions).")";
    		}

    	}
    	else {

    		$sql = " AND MATCH(i.title, i.introtext, i.`fulltext`,i.image_caption,i.image_credits,i.video_caption,i.video_credits,i.extra_fields_search,i.metadesc,i.metakey) ";
    		if ($type=='exact') {
    			$text = JString::trim($search,'"');
    			$text = $db->Quote('"'.$db->getEscaped($text, true).'"', false);
    		}
    		else {
    			$search = JString::str_ireplace('*', '', $search);
    			$words = explode(' ', $search);
    			for($i=0; $i<count($words); $i++){
    				$words[$i].= '*';
    			}
    			$search = implode(' ', $words);
    			$text = $db->Quote($db->getEscaped($search, true), false);
    		}
    		$sql.= "AGAINST ({$text} IN BOOLEAN MODE)";

    	}

    	return $sql;

    }

    function getModuleItems($moduleID) {

        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__modules WHERE id={$moduleID} AND published=1 AND client_id=0";
        $db->setQuery($query, 0, 1);
        $module = $db->loadObject();
        $format = JRequest::getWord('format');
        if (is_null($module))
            JError::raiseError(404, JText::_("NOT FOUND"));
        else {
            $params = new JParameter($module->params);
            switch ($module->module) {

                case 'mod_k2_content':
                    require_once (JPATH_SITE.DS.'modules'.DS.'mod_k2_content'.DS.'helper.php');
                    $helper = new modK2ContentHelper;
                    $items = $helper->getItems($params, $format);
                    break;

                case 'mod_k2_comments':
										if($params->get('module_usage')==1)
											JError::raiseError(404, JText::_("NOT FOUND"));
											
										require_once (JPATH_SITE.DS.'modules'.DS.'mod_k2_comments'.DS.'helper.php');
										$helper = new modK2CommentsHelper;
										$items = $helper->getLatestComments($params);
										
										foreach($items as $item){
											$item->title = $item->userName.' '.JText::_('commented on').' '.$item->title;
											$item->introtext = $item->commentText;
											$item->created=$item->commentDate;
											$item->id = $item->itemID;
										}
                    break;

                default:
                    JError::raiseError(404, JText::_("NOT FOUND"));

            }

            $result = new JObject;
            $result->items = $items;
            $result->title = $module->title;
            $result->module = $module->module;
            $result->params = $module->params;
            return $result;

        }

    }

}
