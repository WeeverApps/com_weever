<?php
/*
*
*	Cartographer Details R3S Template for Joomla 1.5
*	(c) 2010-2011 Weever Inc. <http://www.weever.ca/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
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
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.environment.uri' );

// Get the document object.
$document =& JFactory::getDocument();
 
// Set the MIME type for JSON output.
$document->setMimeEncoding( 'application/json' );

header('Cache-Control: no-cache, must-revalidate');

$callback = JRequest::getVar('callback');

class jsonOutput {

	public $results;

}

class R3SHtmlContentDetailsMap {

	public 		$html;
	public 		$name;
	public 		$datetime		= array("published"=>"","modified"=>"");
	public 		$image			= array("mobile"=>"","full"=>"");
	public 		$tags			= array();
	public 		$url;
	public 		$uuid;
	public 		$author;
	public 		$publisher;
	public 		$generator		= "Cartographer Details R3S Template for Joomla 1.5";
	public 		$copyright;
	public 		$rating;
	public 		$r3sVersion		= "0.8";
	public 		$license;
	public 		$relationships;

}


$jsonHtml = new R3SHtmlContentDetailsMap;

$jsonHtml->html = $this->getBuffer('component');
$jsonHtml->name = $document->getTitle();

// Mask external links so we leave only internal ones to scre...er... play with.
$jsonHtml->html = str_replace("href=\"http://", "hrefmask=\"weever://", $jsonHtml->html);

// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
$jsonHtml->html = str_replace("target=\"_blank\"", "", $jsonHtml->html);
$jsonHtml->html = str_replace("href=\"", "target=\"_blank\" href=\"".JURI::root(), $jsonHtml->html);
$jsonHtml->html = str_replace("src=\"/", "src=\"".JURI::root(), $jsonHtml->html);
$jsonHtml->html = str_replace("src=\"images", "src=\"".JURI::root()."images", $jsonHtml->html);
$jsonHtml->html = str_replace("a class=\"modal\" href=\"http://", "a class=\"modal\" href=\"#",$jsonHtml->html);
$jsonHtml->html = str_replace("a class=\"modal\" hrefmask=\"weever://", "a class=\"modal\" hrefmask=\"#http://",$jsonHtml->html);
//$jsonHtml->html = str_replace("http://".JURI::root()."/media/k2/items/cache/".md5('Image'.JRequest::getVar('id'))."_XL.jpg",$jsonHtml->html);


// Restore external links, ensure target="_blank" applies
$jsonHtml->html = str_replace("hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);

// Fix for teh youtubes
$jsonHtml->html = str_replace("<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
									"<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html);

$jsonOutput = new jsonOutput;

$jsonOutput->results[] = $jsonHtml;

$output = json_encode($jsonOutput);

echo $callback."(".$output.")";
