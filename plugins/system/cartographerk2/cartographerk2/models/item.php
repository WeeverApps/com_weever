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
* 
*  Original copyrights below this line
*  ===================================
**
 * @version		$Id: item.php 561 2010-09-22 14:01:25Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

class K2ModelItem extends JModel
{

	function getData() {

		$id = JRequest::getInt('id');
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_items WHERE id={$id}";
		$db->setQuery($query, 0, 1);
		$row = $db->loadObject();
		return $row;
	}

	function prepareItem($item, $view, $task){

		jimport('joomla.filesystem.file');
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
		$limitstart=JRequest::getInt('limitstart');

		//Initialize params
		if ($view!='item'){

			$component = JComponentHelper::getComponent( 'com_k2' );
			$params = new JParameter( $component->params );
			$itemid = JRequest::getInt( 'Itemid' );
			if ($itemid) {
				$menu = JSite::getMenu();
				$menuparams = $menu->getParams( $itemid );
				$params->merge( $menuparams );
			}

		}
		else {
			$params = & JComponentHelper::getParams('com_k2');
		}

		//Category
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_categories WHERE id=".(int)$item->catid;
		$db->setQuery($query, 0, 1);
		$category = $db->loadObject();

		$item->category=$category;
		$item->category->link=urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($category->id.':'.urlencode($category->alias))));

		//Read more link
		$link = K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias),$item->catid.':'.urlencode($item->category->alias));
		$item->link=urldecode(JRoute::_($link));

		//Print link
		$item->printLink = urldecode(JRoute::_($link.'&tmpl=component&print=1'));

		//Params
		$cparams = new JParameter( $category->params );
		$iparams = new JParameter( $item->params );
		$item->params= $params;
		if ($cparams->get('inheritFrom')){
			$masterCategoryID = $cparams->get('inheritFrom');
			$query = "SELECT * FROM #__k2_categories WHERE id=".(int)$masterCategoryID;
			$db->setQuery($query, 0, 1);
			$masterCategory = $db->loadObject();
			$cparams = new JParameter( $masterCategory->params );
		}
		$item->params->merge($cparams);
		$item->params->merge($iparams);

		//Edit link
		//if (K2HelperPermissions::canEditItem($item->created_by,$item->catid))
		//$item->editLink = JRoute::_('index.php?option=com_k2&view=item&task=edit&cid='.$item->id.'&tmpl=component');

		//Tags
		if(
		($view=='item' && ($item->params->get('itemTags') || $item->params->get('itemRelated'))) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemTags')) ||
		($view=='itemlist' && $task=='user' && $item->params->get('userItemTags')) ||
		($view=='latest' && $params->get('latestItemTags'))
		)
		{
			$tags = K2ModelItem::getItemTags($item->id);
			for ($i=0; $i<sizeof($tags); $i++) {
				$tags[$i]->link = JRoute::_(K2HelperRoute::getTagRoute($tags[$i]->name));
			}
			$item->tags=$tags;
		}


		//Image
		$item->imageXSmall='';
		$item->imageSmall='';
		$item->imageMedium='';
		$item->imageLarge='';
		$item->imageXLarge='';

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


		//Extra fields
		if(
		($view=='item' && $item->params->get('itemExtraFields')) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemExtraFields')) ||
		($view=='itemlist' && ($task=='search' || $task=='tag' || $task=='date') && $item->params->get('genericItemExtraFields'))
		)
		{
			$item->extra_fields=K2ModelItem::getItemExtraFields($item->extra_fields);
		}

		//Attachments
		if(
		($view=='item' && $item->params->get('itemAttachments')) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemAttachments'))
		)
		{
			$item->attachments=K2ModelItem::getItemAttachments($item->id);
		}


		//Rating
		if(
		($view=='item' && $item->params->get('itemRating')) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemRating'))
		)
		{
			$item->votingPercentage = K2ModelItem::getVotesPercentage($item->id);
			$item->numOfvotes = K2ModelItem::getVotesNum($item->id);

		}

		//Filtering
		if ($params->get('introTextCleanup')){
			$filterTags	= preg_split( '#[,\s]+#', trim( $params->get( 'introTextCleanupExcludeTags' ) ) );
			$filterAttrs = preg_split( '#[,\s]+#', trim( $params->get( 'introTextCleanupTagAttr' ) ) );
			$filter	= new JFilterInput( $filterTags, $filterAttrs, 0, 1 );
			$item->introtext= $filter->clean( $item->introtext );
		}

		if ($params->get('fullTextCleanup')){
			$filterTags	= preg_split( '#[,\s]+#', trim( $params->get( 'fullTextCleanupExcludeTags' ) ) );
			$filterAttrs = preg_split( '#[,\s]+#', trim( $params->get( 'fullTextCleanupTagAttr' ) ) );
			$filter	= new JFilterInput( $filterTags, $filterAttrs, 0, 1 );
			$item->fulltext= $filter->clean( $item->fulltext );
		}

		if ($item->params->get('catItemIntroTextWordLimit') && $task=='category'){
			$item->introtext = K2HelperUtilities::wordLimit($item->introtext, $item->params->get('catItemIntroTextWordLimit'));
		}

		$item->cleanTitle = $item->title;
		$item->title = htmlspecialchars($item->title, ENT_QUOTES);
		$item->image_caption = htmlspecialchars($item->image_caption, ENT_QUOTES);

		//Author
		if(
		($view=='item' && ($item->params->get('itemAuthorBlock') || $item->params->get('itemAuthor'))) ||
		($view=='itemlist' && ($task=='' || $task=='category') && ($item->params->get('catItemAuthorBlock') || $item->params->get('catItemAuthor')) ) ||
		($view=='itemlist' && $task=='user')
		)
		{
			if (!empty($item->created_by_alias)){
				$item->author->name = $item->created_by_alias;
				$item->author->avatar = K2HelperUtilities::getAvatar('alias');
				$item->author->link = JURI::root();
			}
			else {
				$author=&JFactory::getUser($item->created_by);
				$item->author = $author;
				$item->author->link = JRoute::_(K2HelperRoute::getUserRoute($item->created_by));
				$item->author->profile = K2ModelItem::getUserProfile($item->created_by);
				$item->author->avatar = K2HelperUtilities::getAvatar($author->id, $author->email, $params->get('userImageWidth'));
			}

			if (!isset($item->author->profile) || is_null($item->author->profile)){

				$item->author->profile = new JObject;
				$item->author->profile->gender = NULL;

			}


		}

		//Num of comments
		$item->numOfComments = K2ModelItem::countItemComments($item->id);

		return $item;
	}

	function prepareFeedItem(&$item){

		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
		$params = & JComponentHelper::getParams('com_k2');
		$limitstart=0;

		//Category
		$category = & JTable::getInstance('K2Category', 'Table');
		$category->load($item->catid);
		$item->category=$category;

		//Read more link
		$item->link=urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.$item->alias,$item->catid.':'.urlencode($item->category->alias))));

		//Filtering
		if ($params->get('introTextCleanup')){
			$filterTags	= preg_split( '#[,\s]+#', trim( $params->get( 'introTextCleanupExcludeTags' ) ) );
			$filterAttrs = preg_split( '#[,\s]+#', trim( $params->get( 'introTextCleanupTagAttr' ) ) );
			$filter	= new JFilterInput( $filterTags, $filterAttrs, 0, 1 );
			$item->introtext= $filter->clean( $item->introtext );
		}

		if ($params->get('fullTextCleanup')){
			$filterTags	= preg_split( '#[,\s]+#', trim( $params->get( 'fullTextCleanupExcludeTags' ) ) );
			$filterAttrs = preg_split( '#[,\s]+#', trim( $params->get( 'fullTextCleanupTagAttr' ) ) );
			$filter	= new JFilterInput( $filterTags, $filterAttrs, 0, 1 );
			$item->fulltext= $filter->clean( $item->fulltext );
		}

		//Description
		$item->description = '';

		//Item image
		if ($params->get('feedItemImage') && JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_'.$params->get('feedImgSize').'.jpg')){
			$item->description.= '<div class="K2FeedImage"><img src="'.JURI::root().'/media/k2/items/cache/'.md5('Image'.$item->id).'_'.$params->get('feedImgSize').'.jpg" alt="'.$item->title.'" /></div>';
		}

		//Item Introtext
		if($params->get('feedItemIntroText')){
			//Introtext word limit
			if ($params->get('feedTextWordLimit') && $item->introtext){
				$item->introtext=K2HelperUtilities::wordLimit($item->introtext,$params->get('feedTextWordLimit'));
			}
			$item->description.= '<div class="K2FeedIntroText">'.$item->introtext.'</div>';
		}

		//Item Fulltext
		if($params->get('feedItemFullText') && $item->fulltext){
			$item->description.= '<div class="K2FeedFullText">'.$item->fulltext.'</div>';
		}
		
		//Item Tags
		if($params->get('feedItemTags')){
			$tags = K2ModelItem::getItemTags($item->id);
			if(count($tags)){
				$item->description.='<div class="K2FeedTags"><ul>';
				foreach($tags as $tag){
					$item->description.='<li>'.$tag->name.'</li>';
				}
				$item->description.='<ul></div>';
			}
		}
		
		//Item Video
		if($params->get('feedItemVideo') && $item->video){
			if (!empty($item->video) && JString::substr($item->video, 0, 1) !== '{') {
				$item->description.= '<div class="K2FeedVideo">'.$item->video.'</div>';
			}
			else {
				$params->set('vfolder', 'media/k2/videos');
				if(JString::strpos($item->video, 'remote}')){
					preg_match("#}(.*?){/#s",$item->video, $matches);
					if(!JString::strpos($matches[1], 'http://}'))
						$item->video = str_replace($matches[1], JURI::root().$matches[1], $item->video);
				}
				$dispatcher = &JDispatcher::getInstance();
				JPluginHelper::importPlugin ('content');
				$item->text=$item->video;
				$dispatcher->trigger ( 'onPrepareContent', array (&$item, &$params, $limitstart ) );
				$item->description.= '<div class="K2FeedVideo">'.$item->text.'</div>';
			}
		}
		
		//Item gallery
		if($params->get('feedItemGallery') && $item->gallery){
			$params->set('galleries_rootfolder', 'media/k2/galleries');
			$params->set('popup_engine', 'mootools_slimbox');
			$params->set('enabledownload', '0');
			$dispatcher = &JDispatcher::getInstance();
			JPluginHelper::importPlugin ('content');
			$item->text=$item->gallery;
			$dispatcher->trigger ( 'onPrepareContent', array (&$item, &$params, $limitstart ) );
			$item->description.= '<div class="K2FeedGallery">'.$item->text.'</div>';
		}
		
		//Item attachments
		if($params->get('feedItemAttachments')){
			$attachments = K2ModelItem::getItemAttachments($item->id);
			if(count($attachments)){
				$item->description.='<div class="K2FeedAttachments"><ul>';
				foreach($attachments as $attachment){
					$item->description.='<li><a title="'.htmlentities($attachment->titleAttribute, ENT_QUOTES, 'UTF-8').'" href="'.JRoute::_('index.php?option=com_k2&view=item&task=download&id='.$attachment->id).'">'.$attachment->title.'</a></li>';
				}
				$item->description.='<ul></div>';
			}			
		}
		

		//Author
		if (!empty($item->created_by_alias)){
			$item->author->name = $item->created_by_alias;
		}
		else {
			$author=&JFactory::getUser($item->created_by);
			$item->author = $author;
			$item->author->link = JRoute::_(K2HelperRoute::getUserRoute($item->created_by));
			$item->author->profile = K2ModelItem::getUserProfile($item->created_by);
		}

		return $item;
	}

	function execPlugins($item, $view, $task){

		$params = & JComponentHelper::getParams('com_k2');
		$limitstart=JRequest::getInt('limitstart');

		//Import plugins
		$dispatcher = &JDispatcher::getInstance();
		JPluginHelper::importPlugin ('content');

		//Gallery
		if(
		($view=='item' && $item->params->get('itemImageGallery')) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemImageGallery'))
		)
		{
			$params->set('galleries_rootfolder', 'media/k2/galleries');
			$params->set('popup_engine', 'mootools_slimbox');
			$params->set('enabledownload', '0');
			$item->text=$item->gallery;
			$dispatcher->trigger ( 'onPrepareContent', array (&$item, &$params, $limitstart ) );
			$item->gallery=$item->text;
		}

		//Video
		if(
		($view=='item' && $item->params->get('itemVideo')) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemVideo')) ||
		($view=='latest' && $item->params->get('latestItemVideo'))
		)
		{
			if (!empty($item->video) && JString::substr($item->video, 0, 1) !== '{') {
				$item->video=$item->video;
				$item->videoType='embedded';
			}
			else {
				$item->videoType='allvideos';
				$params->set('vfolder', 'media/k2/videos');

				if(JString::strpos($item->video, 'remote}')){
					preg_match("#}(.*?){/#s",$item->video, $matches);
					if(JString::substr($matches[1], 0, 7)!='http://')
						$item->video = JString::str_ireplace($matches[1], JURI::root().$matches[1], $item->video);
				}

				if($view=='item'){
					$params->set('vwidth', $item->params->get('itemVideoWidth'));
					$params->set('vheight', $item->params->get('itemVideoHeight'));
					$params->set('autoplay', $item->params->get('itemVideoAutoPlay'));
				}
				else if($view=='latest'){
					$params->set('vwidth', $item->params->get('latestItemVideoWidth'));
					$params->set('vheight', $item->params->get('latestItemVideoHeight'));
					$params->set('autoplay', $item->params->get('latestItemVideoAutoPlay'));
				}
				else {
					$params->set('vwidth', $item->params->get('catItemVideoWidth'));
					$params->set('vheight', $item->params->get('catItemVideoHeight'));
					$params->set('autoplay', $item->params->get('catItemVideoAutoPlay'));
				}

				$item->text=$item->video;
				$dispatcher->trigger ( 'onPrepareContent', array (&$item, &$params, $limitstart ) );
				$item->video=$item->text;
			}

		}

		//Plugins
		$item->text='';
		$params->set('vfolder', NULL);
		$params->set('vwidth', NULL);
		$params->set('vheight', NULL);
		$params->set('autoplay', NULL);
		$params->set('galleries_rootfolder', NULL);
		$params->set('popup_engine', NULL);
		$params->set('enabledownload', NULL);


		if ($view=='item'){

			if ($item->params->get('itemIntroText'))
			$item->text.= $item->introtext;
			if ($item->params->get('itemFullText'))
			$item->text.= '{K2Splitter}'.$item->fulltext;
		}
		else {

			switch($task){
				case '':
				case 'category':
					if ($item->params->get('catItemIntroText')) $item->text.= $item->introtext;
					break;

				case 'user':
					if ($item->params->get('userItemIntroText')) $item->text.= $item->introtext;
					break;
				default:
					if ($item->params->get('genericItemIntroText')) $item->text.= $item->introtext;
					break;
			}

		}

		$results = $dispatcher->trigger('onBeforeDisplay', array ( & $item, &$params, $limitstart));
		$item->event->BeforeDisplay = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onAfterDisplay', array ( & $item, &$params, $limitstart));
		$item->event->AfterDisplay = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onAfterDisplayTitle', array ( & $item, &$params, $limitstart));
		$item->event->AfterDisplayTitle = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onBeforeDisplayContent', array ( & $item, &$params, $limitstart));
		$item->event->BeforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onAfterDisplayContent', array ( & $item, &$params, $limitstart));
		$item->event->AfterDisplayContent = trim(implode("\n", $results));

		$dispatcher->trigger('onPrepareContent', array ( & $item, &$params, $limitstart));


		//K2 plugins
		$item->event->K2BeforeDisplay = '';
		$item->event->K2AfterDisplay = '';
		$item->event->K2AfterDisplayTitle = '';
		$item->event->K2BeforeDisplayContent = '';
		$item->event->K2AfterDisplayContent = '';

		if(
		($view=='item' && $item->params->get('itemK2Plugins')) ||
		($view=='itemlist' && ($task=='' || $task=='category') && $item->params->get('catItemK2Plugins')) ||
		($view=='itemlist' && $task=='user' && $item->params->get('userItemK2Plugins'))
		)
		{
			JPluginHelper::importPlugin ( 'k2' );

			$results = $dispatcher->trigger('onK2BeforeDisplay', array ( & $item, &$params, $limitstart));
			$item->event->K2BeforeDisplay = trim(implode("\n", $results));

			$results = $dispatcher->trigger('onK2AfterDisplay', array ( & $item,& $params, $limitstart));
			$item->event->K2AfterDisplay = trim(implode("\n", $results));

			$results = $dispatcher->trigger('onK2AfterDisplayTitle', array ( & $item, &$params, $limitstart));
			$item->event->K2AfterDisplayTitle = trim(implode("\n", $results));

			$results = $dispatcher->trigger('onK2BeforeDisplayContent', array ( & $item, &$params, $limitstart));
			$item->event->K2BeforeDisplayContent = trim(implode("\n", $results));

			$results = $dispatcher->trigger('onK2AfterDisplayContent', array ( & $item, &$params, $limitstart));
			$item->event->K2AfterDisplayContent = trim(implode("\n", $results));

			$dispatcher->trigger('onK2PrepareContent', array ( & $item, &$params, $limitstart));

		}

		if ($view=='item'){
			@list($item->introtext, $item->fulltext) = explode('{K2Splitter}', $item->text);
		}
		else {
			$item->introtext = $item->text;
		}


		return $item;

	}

	function hit($id){

		$row = & JTable::getInstance('K2Item', 'Table');
		$row->hit($id);
	}

	function vote(){

		$mainframe = &JFactory::getApplication();
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables' );

		//Get item
		$item = & JTable::getInstance('K2Item', 'Table');
		$item->load(JRequest::getInt('itemID'));

		//Get category
		$category = & JTable::getInstance('K2Category', 'Table');
		$category->load($item->catid);

		//Access check
		$user = JFactory::getUser();
		if ($item->access > $user->get('aid', 0) || $category->access > $user->get('aid', 0)) {
			JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
		}

		//Published check
		if (!$item->published || $item->trash ) {
			JError::raiseError( 404, JText::_("Item not found") );
		}
		if (!$category->published || $category->trash) {
			JError::raiseError( 404, JText::_("Item not found") );
		}


		$rate = JRequest::getVar('user_rating', 0, '', 'int');

		if ( $rate >= 1 && $rate <= 5) {
			$db = & JFactory::getDBO();
			$userIP =  $_SERVER['REMOTE_ADDR'];
			$query = "SELECT * FROM #__k2_rating WHERE itemID =".(int)$item->id;
			$db->setQuery($query);
			$rating = $db->loadObject();

			if (!$rating) {
				$query = "INSERT INTO #__k2_rating ( itemID, lastip, rating_sum, rating_count ) VALUES ( ".(int)$item->id.", ".$db->Quote($userIP).", {$rate}, 1 )";
				$db->setQuery($query);
				$db->query();
				echo JText::_('Thanks for rating!');

			}

			else {
				if ($userIP != ($rating->lastip)) {
					$query = "UPDATE #__k2_rating".
					" SET rating_count = rating_count + 1, rating_sum = rating_sum + {$rate}, lastip = ".$db->Quote($userIP).
					" WHERE itemID = {$item->id}";
					$db->setQuery($query);
					$db->query();
					echo JText::_('Thanks for rating!');

				}
				else {
					echo JText::_('You have already rated this item.');
				}
			}

		}
		$mainframe->close();
	}


	function getVotesNum($itemID=NULL) {

		$mainframe = &JFactory::getApplication();
		$user = JFactory::getUser();
		$xhr = false;
		if (is_null($itemID)){
			$itemID = JRequest::getInt('itemID');
			$xhr = true;
		}

		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_rating WHERE itemID = ".(int)$itemID;
		$db->setQuery($query);
		$vote = $db->loadObject();

		if (!is_null($vote)) $rating_count = intval($vote->rating_count);
		else $rating_count=0;

		if ($rating_count != 1) {
			$result="(".$rating_count." ".JText::_('votes').")";
		}
		else {
			$result="(".$rating_count." ".JText::_('vote').")";
		}
		if ($xhr){
			echo $result;
			$mainframe->close();
		}
		else return $result;
	}

	function getVotesPercentage($itemID=NULL) {

		$mainframe = &JFactory::getApplication();
		$user = JFactory::getUser();
		$db = & JFactory::getDBO();
		$xhr = false;
		$result = 0;
		if (is_null($itemID)){

			$itemID = JRequest::getInt('itemID');
			$xhr= true;
		}

		$query = "SELECT * FROM #__k2_rating WHERE itemID = ".(int)$itemID;
		$db->setQuery($query);
		$vote = $db->loadObject();

		if (!is_null($vote) && $vote->rating_count != 0) {
			$result = number_format(intval($vote->rating_sum)/intval($vote->rating_count), 2)*20;
		}
		if ($xhr){
			echo $result;
			$mainframe->close();
		}
		else return $result;
	}

	function comment(){

		$mainframe = &JFactory::getApplication();
		jimport('joomla.mail.helper');
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables' );
		$params = &JComponentHelper::getParams('com_k2');
		$user = JFactory::getUser();
		$config =& JFactory::getConfig();


		//Get item
		$item = & JTable::getInstance('K2Item', 'Table');
		$item->load(JRequest::getInt('itemID'));

		//Get category
		$category = & JTable::getInstance('K2Category', 'Table');
		$category->load($item->catid);

		//Access check
		if ($item->access > $user->get('aid', 0) || $category->access > $user->get('aid', 0)) {
			JError::raiseError( 403, JText::_("ALERTNOTAUTH") );
		}

		//Published check
		if (!$item->published || $item->trash ) {
			JError::raiseError( 404, JText::_("Item not found") );
		}
		if (!$category->published || $category->trash) {
			JError::raiseError( 404, JText::_("Item not found") );
		}

		//Check permissions
		if ((($params->get('comments') == '2') && ($user->id > 0) && K2HelperPermissions::canAddComment($item->catid)) || ($params->get('comments') == '1')) {

			$row = & JTable::getInstance ( 'K2Comment', 'Table' );

			if (! $row->bind ( JRequest::get ( 'post' ) )) {
				echo $row->getError();
				$mainframe->close();
			}

			$row->commentText=JRequest::getString('commentText', '', 'default', 4);
			
			//Strip a tags since all urls will be converted to links automatically on runtime
			$filter	= new JFilterInput(array('a'), array(), 1);
			$row->commentText = $filter->clean( $row->commentText );
			
			//Clean vars
			$filter = & JFilterInput::getInstance();
			$row->userName = $filter->clean( $row->userName, 'username' );
			$row->commentURL = $filter->clean( $row->commentURL, 'path' );
			
			
			$datenow =& JFactory::getDate();
			$row->commentDate = $datenow->toMySQL();

			if (!$user->guest) {
				$row->userID = $user->id;
				$row->commentEmail = $user->email;
				$row->userName=$user->name;
			}

			$userName = trim($row->userName);
			$commentEmail = trim($row->commentEmail);
			$commentText = trim($row->commentText);
			$commentURL = trim($row->commentURL);

			if ( empty($userName) || $userName==JText::_( 'enter your name...' ) || empty($commentText) || $commentText==JText::_( 'enter your comment here...' ) || empty($commentEmail) || $commentEmail==JText::_( 'enter your e-mail address...' )) {
				echo JText::_('You need to fill in all required fields!');
				$mainframe->close();
			}

			if (!JMailHelper::isEmailAddress($commentEmail)) {
				echo JText::_('Invalid e-mail address!');
				$mainframe->close();
			}


			if ($user->guest){
				$db = & JFactory::getDBO();
				$query = "SELECT COUNT(*) FROM #__users WHERE name=".$db->Quote($userName)." OR email=".$db->Quote($commentEmail);
				$db->setQuery($query);
				$result = $db->loadresult();
				if ($result>0){
					echo JText::_('The name or email address you typed is already in use!');
					$mainframe->close();
				}

			}


			if ($params->get('recaptcha') && $user->guest) {
				require_once (JPATH_COMPONENT.DS.'lib'.DS.'recaptchalib.php');
				$privatekey = $params->get('recaptcha_private_key');
				$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
				if (!$resp->is_valid) {
					echo JText::_("The words you typed did not match the ones displayed. Please try again.");
					$mainframe->close();
				}
			}

			if ($commentURL == JText::_( 'enter your site URL...') || $commentURL == "") {
				$row->commentURL = NULL;
			}
			else {
				if (substr($commentURL, 0, 7) != 'http://') {
					$row->commentURL = 'http://'.$commentURL;
				}
			}

			if ($params->get('commentsPublishing')) {
				$row->published = 1;
			}
			else {
				$row->published = 0;
			}

			if (!$row->store()) {
				echo $row->getError();
				$mainframe->close();
			}

			if ($params->get('commentsPublishing')) {
				if ($config->getValue( 'config.caching' )){
					echo JText::_('Thank you. Your comment will be published shortly.');
				}
				else {
					echo '<span class="success">'.JText::_('Comment added! Refreshing page...').'</span>';
				}

			}
			else {
				echo JText::_('Comment added and waiting for approval.');
			}

		}
		$mainframe->close();
	}

	function getItemTags($itemID){

		$db = & JFactory::getDBO();
		$query="SELECT * FROM #__k2_tags as tags WHERE tags.published=1 AND tags.id IN (SELECT tagID FROM #__k2_tags_xref WHERE itemID=".(int)$itemID.")";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}

	function getItemExtraFields($itemExtraFields){

		jimport('joomla.filesystem.file');
		$db = & JFactory::getDBO ();
		require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php');
		$json=new Services_JSON;
		$jsonObjects=$json->decode($itemExtraFields);
		$imgExtensions = array('jpg','jpeg','gif','png');
		$params = & JComponentHelper::getParams('com_k2');

		if (count($jsonObjects)<1)
		return NULL;

		foreach ($jsonObjects as $object){
			$extraFieldsIDs[]=$object->id;
		}
		JArrayHelper::toInteger($extraFieldsIDs);
		$condition=@implode(',',$extraFieldsIDs);

		$query="SELECT * FROM #__k2_extra_fields WHERE published=1 AND id IN ({$condition}) ORDER BY ordering ASC";
		$db->setQuery($query);
		$rows = $db->loadObjectList();

		for ($i=0; $i<sizeof($rows); $i++){

			$value='';
			$values = array();
			foreach ($jsonObjects as $object){

				if ($rows[$i]->id==$object->id){

					if ( $rows[$i]->type=='textfield'|| $rows[$i]->type=='textarea'){
						$value=$object->value;
					}
					
					else if($rows[$i]->type=='labels'){
						$labels = explode(',', $object->value);
						if(!is_array($labels)){
							$labels = (array)$labels;
						}
						$value='';
						foreach($labels as $label){
							$label = JString::trim($label);
							$label = str_replace('-',' ' ,$label);
							$value.='<a href="'.JRoute::_('index.php?option=com_k2&view=itemlist&task=search&searchword='.urlencode($label)).'">'.$label.'</a> ';
						}
						
						
					}

					else if($rows[$i]->type=='select'|| $rows[$i]->type=='radio'){
						foreach ($json->decode($rows[$i]->value) as $option){
							if ($option->value==$object->value)
							$value.=$option->name;
						}
					}

					else if ($rows[$i]->type=='multipleSelect'){
						foreach ($json->decode($rows[$i]->value) as $option){
							if (@in_array($option->value,$object->value))
							$values[]=$option->name;
						}
						$value=@implode(', ',$values);
					}

					else if ($rows[$i]->type=='csv'){
						$array = $object->value;
						if(count($array)){
							$value.='<table cellspacing="0" cellpadding="0" class="csvTable">';
							foreach($array as $key=>$row){
								$value.='<tr>';
								foreach($row as $cell){
									$value.=($key>0)?'<td>'.$cell.'</td>':'<th>'.$cell.'</th>';
								}
								$value.='</tr>';
							}
							$value.='</table>';
						}

					}

					else {
						foreach ($json->decode($rows[$i]->value) as $option){

							switch ($object->value[2]){
								case 'same':
								default:
									$attributes='';
									break;

								case 'new':
									$attributes='target="_blank"';
									break;

								case 'popup':
									$attributes='class="classicPopup" rel="{x:'.$params->get('linkPopupWidth').',y:'.$params->get('linkPopupHeight').'}"';
									break;

								case 'lightbox':
									$filename = @basename($object->value[1]);
									$extension = JFile::getExt($filename);
									if (!empty($extension) && in_array($extension,$imgExtensions)) {
										$attributes='class="modal"';
									}
									else {
										$attributes='class="modal" rel="{handler:\'iframe\',size:{x:'.$params->get('linkPopupWidth').',y:'.$params->get('linkPopupHeight').'}}"';
									}
									break;

							}
							$value = $object->value[1] != '' ? '<a href="'.$object->value[1].'" '.$attributes.'>'.$object->value[0].'</a>' : $object->value[0];
						}
					}

				}

			}
			$rows[$i]->value=$value;
		}

		return $rows;
	}

	function getItemAttachments($itemID){

		$db = & JFactory::getDBO ();
		$query="SELECT * FROM #__k2_attachments WHERE itemID=".(int)$itemID;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}

	function getItemComments($itemID ,$limitstart, $limit){

		$params = & JComponentHelper::getParams('com_k2');
		$order=$params->get('commentsOrdering','DESC');
		$ordering = ($order=='DESC')?'DESC':'ASC';
		$db = & JFactory::getDBO ();
		$query="SELECT * FROM #__k2_comments WHERE published=1 AND itemID=".(int)$itemID." ORDER BY commentDate {$ordering}";
		$db->setQuery($query ,$limitstart, $limit);
		$rows = $db->loadObjectList();
		return $rows;
	}

	function countItemComments($itemID){

		$db = & JFactory::getDBO ();
		$query="SELECT COUNT(*) FROM #__k2_comments WHERE published=1 AND itemID=".(int)$itemID;
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;

	}

	function checkin(){

		$mainframe = &JFactory::getApplication();
		$id = JRequest::getInt('cid');
		$row = & JTable::getInstance('K2Item', 'Table');
		$row->load($id);
		$row->checkin();
		$mainframe->close();
	}

	function getPreviousItem($id,$catid,$ordering){

		$user =& JFactory::getUser();
		$aid = (int) $user->aid;
		$id = (int) $id;
		$catid = (int) $catid;
		$ordering = (int) $ordering;
		$db = & JFactory::getDBO ();

		$jnow =& JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();

		if ($ordering=="0") {
			$query="SELECT * FROM #__k2_items WHERE id < {$id} AND catid={$catid} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND access<={$aid} AND trash=0 ORDER BY ordering DESC";
		}
		else {
			$query="SELECT * FROM #__k2_items WHERE id != {$id} AND catid={$catid} AND ordering < {$ordering} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND access<={$aid} AND trash=0 ORDER BY ordering DESC";
		}

		$db->setQuery($query,0,1);
		$row = $db->loadObject();
		return $row;
	}

	function getNextItem($id,$catid,$ordering){

		$user =& JFactory::getUser();
		$aid = (int) $user->aid;
		$id = (int) $id;
		$catid = (int) $catid;
		$ordering = (int) $ordering;
		$db = & JFactory::getDBO ();

		$jnow =& JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();

		if ($ordering=="0") {
			$query="SELECT * FROM #__k2_items WHERE id > {$id} AND catid={$catid} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND access<={$aid} AND trash=0 ORDER BY ordering ASC";
		}
		else {
			$query="SELECT * FROM #__k2_items WHERE id != {$id} AND catid={$catid} AND ordering > {$ordering} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND access<={$aid} AND trash=0 ORDER BY ordering ASC";
		}
		$db->setQuery($query,0,1);
		$row = $db->loadObject();
		return $row;
	}

	function getUserProfile($id=NULL) {

		$db = & JFactory::getDBO();$db = & JFactory::getDBO();
		if (is_null($id)) $id = JRequest::getInt('id');
		$query="SELECT id, gender, description, image, url, `group`, plugins FROM #__k2_users WHERE userID={$id}";
		$db->setQuery($query);
		$row = $db->loadObject();
		return $row;
	}

}
