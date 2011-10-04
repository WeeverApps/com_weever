<?php
/*
*
*	Weever Cartographer R3S Output Template for Joomla
*	(c) 2010-2011 Weever Inc. <http://www.weever.ca/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
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
*
*/


class R3SHtmlContentDetailsMap {

	public 		$html;
	public 		$name;
	public 		$datetime		= array("published"=>"","modified"=>"");
	public 		$image			= array("mobile"=>"","full"=>"");
	public 		$tags			= array();
	public		$language;
	public 		$url;
	public 		$uuid;
	public 		$author;
	public 		$publisher;
	public 		$generator		= "Weever Cartographer R3S Template for Joomla";
	public 		$copyright;
	public 		$rating;
	public 		$r3sVersion		= "0.8";
	public 		$license;
	public 		$relationships;

}

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
	public 		$language;
	public 		$copyright;
	public 		$license;
	public 		$generator		= "Weever Cartographer R3S Template for Joomla";
	public 		$publisher;
	public 		$rating;
	public 		$url;
	public 		$description;
	public 		$name;
	public 		$r3sVersion		= "0.8";
	public 		$relationships;
	public 		$items;

}

class jsonOutput {

	public $results;

}