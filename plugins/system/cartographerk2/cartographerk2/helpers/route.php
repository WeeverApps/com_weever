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
 * @version		$Id: route.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.helper');

class K2HelperRoute
{

	function getItemRoute($id, $catid = 0) {

		$needles = array (
		'item'=>(int)$id,
		'itemlist'=>(int)$catid,
		);
		$link = 'index.php?option=com_k2&view=item&id='.$id;

		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		return $link;
	}

	function getCategoryRoute($catid)	{

		$needles = array (
		'itemlist'=>(int)$catid
		);

		$link = 'index.php?option=com_k2&view=itemlist&task=category&id='.$catid;

		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		return $link;
	}

	function getUserRoute($userID) {

		$needles = array (
		'user'=>(int)$userID
		);

		$user = &JFactory::getUser($userID);


        mb_internal_encoding("UTF-8");
		mb_regex_encoding("UTF-8");
        $alias = trim(mb_strtolower($user->name));
        $alias = str_replace('-', ' ', $alias);
        $alias = mb_ereg_replace('[[:space:]]+', ' ', $alias);
        $alias = trim(str_replace(' ', '', $alias));
        $alias = str_replace('.', '', $alias);


        $stripthese = ',|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|â€ž|â€¹|â€™|â€˜|â€œ|â€�|â€¢|â€º|Â«|Â´|Â»|Â°|«|»|…';
        $strips = explode('|', $stripthese);
        foreach ($strips as $strip) {
            $alias = str_replace($strip, '', $alias);
        }


        $params = &JComponentHelper::getParams('com_k2');
        $SEFReplacements = array();
        $items = explode(',', $params->get('SEFReplacements', NULL));
        foreach ($items as $item) {
            if (! empty($item)) {
                @list($src, $dst) = explode('|', trim($item));
                $SEFReplacements[trim($src)] = trim($dst);
            }
        }


        foreach ($SEFReplacements as $key=>$value) {
            $alias = str_replace($key, $value, $alias);
        }

        $alias = trim($alias, '-.');

        if (trim(str_replace('-', '', $alias)) == '') {
            $datenow = &JFactory::getDate();
            $alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
        }



		$link = 'index.php?option=com_k2&view=itemlist&task=user&id='.$userID.':'.$alias;

		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		;

		return $link;
	}

	function getTagRoute($tag) {

		$needles = array (
		'tag'=>$tag
		);

		$link = 'index.php?option=com_k2&view=itemlist&task=tag&tag='.urlencode($tag);

		if ($item = K2HelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		}
		;

		return $link;
	}

	function _findItem($needles)	{

		$component = & JComponentHelper::getComponent('com_k2');

		$menus = & JApplication::getMenu('site', array ());
		$items = $menus->getItems('componentid', $component->id);

		$match = null;

		foreach ($needles as $needle=>$id)
		{
			if (count($items)){
				foreach ($items as $item)
				{
					if ($needle=='user'){
						if ((@$item->query['task'] == $needle) && (@$item->query['id'] == $id)) {
							$match = $item;
							break;
						}

					}
					else if ($needle=='tag'){
						if ((@$item->query['task'] == $needle) && (@$item->query['tag'] == $id)) {
							$match = $item;
							break;
						}
					}
					else {

						if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id)) {
							$match = $item;
							break;
						}

						$menuparams = new JParameter( $item->params );
						$catids=$menuparams->get('categories');

						if(is_array($catids)){
							foreach ($catids as $catid)	{
								if ((@$item->query['view'] == $needle) && (@(int)$catid == $id)){
									$match = $item;
									break;
								}
							}
						}
						/*else{

							if ( (@$item->query['view'] == $needle) && (!isset($item->query['task'])) && (@$item->query['view'] == 'itemlist') ) {
								$match = $item;
							}

						}*/

					}

				}
			}

			if ( isset ($match)) {
				break;
			}
		}

		return $match;
	}

}
