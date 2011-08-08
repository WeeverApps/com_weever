<?php
/**
 * @version 1.0 $Id: default.php 958 2009-02-02 17:23:05Z julienv $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once(JPATH_BASE.DS.'templates'.DS.'weever_cartographerdetails'.DS.'simpledom'.DS.'simpledom.php');
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
	public 		$generator		= "Cartographer-Content for Joomla 1.5 v0.8";
	public 		$publisher;
	public 		$rating;
	public 		$url;
	public 		$description;
	public 		$name;
	public 		$r3sVersion		= "0.8";
	public 		$relationships;
	public 		$items;

}

$mainframe = &JFactory::getApplication();

$feed = new R3SChannelMap;

$feed->count = count($this->rows);
$feed->thisPage = 1;
$feed->lastPage = null;
$feed->sort = "normal";
$feed->url = JURI::root()."index.php?".$_SERVER['QUERY_STRING'];
$feed->description = ""; //nothing yet
$feed->name = $this->pagetitle;
$feed->items = array();

$feed->url = str_replace("?template=weever_cartographerdetails","",$feed->url);
$feed->url = str_replace("template=weever_cartographerdetails","",$feed->url);


foreach ($this->rows as $v)
{

	/*$html = SimpleHTMLDomHelper::str_get_html($v->locimage);

	foreach(@$html->find('img') as $vv)
	{
		if($vv->src)
			$v->locimage = JURI::root().$vv->src;
	}
*/
	if(!$v->locimage)
		$v->locimage = JURI::root()."media/com_weever/icon_live.png";
	
	$feedItem = new R3SItemMap;
	
	$feedItem->type = "htmlContent";
	$feedItem->description = $v->locdescription;
	$feedItem->name = $v->venue;
	$feedItem->datetime["published"] = null;
	$feedItem->datetime["modified"] = null; // add later
	$feedItem->image["mobile"] = JURI::root().'images/eventlist/venues/'.$v->locimage;
	$feedItem->image["full"] = JURI::root().'images/eventlist/venues/'.$v->locimage;
	$feedItem->url = JURI::root()."index.php?option=com_eventlist&view=venueevents&id=".$v->id."&template=weever_cartographerdetails";
	$feedItem->author = null;
	$feedItem->publisher = $mainframe->getCfg('sitename');
	
	$feed->items[] = $feedItem;


}	

$document =& JFactory::getDocument();
$document->setMimeEncoding( 'application/json' );

header('Cache-Control: no-cache, must-revalidate');

$callback = JRequest::getVar('callback');		

$json = json_encode($feed);

if($callback)
	$json = $callback . "(". $json .")";


// die() young
print_r($json);
jexit();