<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
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
*/


defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'theme'.'.php');
jimport('joomla.plugin.helper');

class comWeeverHelper
{

	public static function joomlaVersion() 
	{
	
		$version = new JVersion;
		$joomla = $version->getShortVersion();
		
		return $joomla;
	
	}


	public static function isJson($string)
	{
		return !empty($string) && is_string($string) && preg_match('/^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/',$string);
	}

	public static function getSiteDomain()
	{
	
		$siteDomain = JURI::base();
		$siteDomain = str_replace("http://","",$siteDomain);
		$siteDomain = str_replace("administrator/","",$siteDomain);
		$siteDomain = rtrim($siteDomain, "/");
		
		return $siteDomain;
	
	}
	

	public static function saveTheme()
	{
	
		$max = ini_get('upload_max_filesize');

		if(JRequest::getVar('icon_live', null, 'files', 'array'))
			$msg = comWeeverHelper::fileUpload('icon_live',$max,'icon_live.png');
			
		if(JRequest::getVar('phone_load_live', null, 'files', 'array'))
			$msg = comWeeverHelper::fileUpload('phone_load_live',$max,'phone_load_live.png');
			
		if(JRequest::getVar('tablet_load_live', null, 'files', 'array'))
			$msg = comWeeverHelper::fileUpload('tablet_load_live',$max, 'tablet_load_live.png');
			
		if(JRequest::getVar('tablet_landscape_load_live', null, 'files', 'array'))
			$msg = comWeeverHelper::fileUpload('tablet_landscape_load_live',$max, 'tablet_landscape_load_live.png');
				
		if(JRequest::getVar('titlebar_logo_live', null, 'files', 'array'))
			$msg = comWeeverHelper::fileUpload('titlebar_logo_live',$max, 'titlebar_logo_live.png');
			
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(2);
		$row->setting = JRequest::getVar($row->option);		
		$row->store();
		
		$row->load(100);
		$themeObj = json_decode($row->setting);
		
		if(!$themeObj)
			$themeObj = new comWeeverThemeStylesObj;

		foreach($themeObj as $k=>$v)
		{
		
			if($k == "titlebarHtml")
				$themeObj->$k = JRequest::getVar($k, "", "post","string",JREQUEST_ALLOWHTML);
			else
			{
				if(!strstr($k, "Icon"))
					$themeObj->$k = JRequest::getVar($k);
			}
		
		}

		$jsonTheme = json_encode($themeObj);

		$response = comWeeverHelper::pushThemeToCloud($jsonTheme);

		$db = &JFactory::getDBO();		
		
		$query = "		UPDATE	#__weever_config".
				"		SET		setting = ".$db->Quote($jsonTheme)." ".
				"		WHERE	`option` = ".$db->Quote("theme_params")." ";
		
		$db->setQuery($query);
		$result = $db->loadObject();

		return $msg;					
		
	}
	
	public static function saveThemeJson($json)
	{
				
		$db = &JFactory::getDBO();		
		
		$query = "		UPDATE	#__weever_config".
				"		SET		setting = ".$db->Quote($json)." ".
				"		WHERE	`option` = ".$db->Quote("theme_params")." ";
		
		$db->setQuery($query);
		$result = @$db->loadObject();
	
	}
	
	public static function enableStagingMode()
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		$row->setting = 1;
		$row->store();
		
		comWeeverHelper::tabSync(1);
		
		$msg = JText::_('WEEVER_STAGING_MODE_ACTIVE');

		return $msg;
		
	}
	
	public static function disableStagingMode()
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		$row->setting = 0;
		$row->store();
		
		comWeeverHelper::tabSync();
		
		$msg = JText::_('WEEVER_LIVE_MODE_ACTIVE');

		return $msg;	
	}
	
	public static function saveAccount()
	{
	
		$site_key = JRequest::getVar('site_key','');
		
		$db = &JFactory::getDBO();		

		$query = "		UPDATE	#__weever_config".
				"		SET		`setting` = ".$db->Quote($site_key)." ".
				"		WHERE	`option` = ".$db->Quote("site_key")." ";
		
		$db->setQuery($query);
		$db->loadObject();
		
		comWeeverHelper::tabSync();

		return $msg;
	}
	

	public static function saveConfig()
	{
		
		$row =& JTable::getInstance('WeeverConfig', 'Table');

		if(JRequest::getVar('granular_devices',0))
		{
			if(JRequest::getVar('DetectIphoneOrIpod',0))
				$devices .= "DetectIphoneOrIpod,";
			if(JRequest::getVar('DetectAndroid',0))
				$devices .= "DetectAndroid,";
			if(JRequest::getVar('DetectBlackBerryTouch',0))
				$devices .= "DetectBlackBerryTouch,";
			if(JRequest::getVar('DetectWebOSTablet',0))
				$devices .= "DetectWebOSTablet,";
			if(JRequest::getVar('DetectIpad',0))
				$devices .= "DetectIpad,";
			if(JRequest::getVar('DetectBlackBerryTablet',0))
				$devices .= "DetectBlackBerryTablet,";
			if(JRequest::getVar('DetectAndroidTablet',0))
				$devices .= "DetectAndroidTablet,";
			if(JRequest::getVar('DetectGoogleTV',0))
				$devices .= "DetectGoogleTV,";
			if(JRequest::getVar('DetectAppleTVTwo',0))
				$devices .= "DetectAppleTVTwo,";
				
			$devices = rtrim($devices,",");

			JRequest::setVar('devices',$devices);	
		}
		else
		{
			if(JRequest::getVar('DetectTierWeeverSmartphones',0))
				$devices .= "DetectTierWeeverSmartphones";
			if(JRequest::getVar('DetectTierTablet',0))
				$devices .= ",DetectTierTablet";		
				
			$devices = ltrim($devices,",");
				
			JRequest::setVar('devices',$devices);		
		}
		
			 
		for($i = 1; $i <= 8; $i++)
		{
		
			if($i == 2)
				continue;
		
			$row->load($i);

			$row->setting = JRequest::getVar($row->option);
			
			$row->store();
		
		}
		
		$response = comWeeverHelper::pushConfigToCloud();
		
		return $msg;
	
	}
	
	public static function fileUpload($var, $max, $filename, $msg = null)
	{
		
		jimport('joomla.filesystem.file');

        $file = JRequest::getVar($var, null, 'files', 'array'); 
 
        if($file['tmp_name'])
        { 
        
            if($file['size'] > $max) $msg = JText::_('WEEVER_ONLY_FILES_UNDER').' '.$max;

            $src = $file['tmp_name'];
            $dest = JPATH_SITE . DS .  'media' . DS . 'com_weever' . DS. $filename;
            
            list($width, $height, $type, $attr) = getimagesize($file['tmp_name']);
            
            $iterations = 0;


            if ($file['type'] && $file['type'] == "image/png") 
            { 
     			
	            if($var == 'icon_live' && ($width != 144 || $height != 144))
	            {
	            	return JError::raiseWarning(500,JText::_('WEEVER_ERROR_ICON_DIMENSIONS'));
	            }
	            
	            if($var == 'icon_live')
	            {
	            	  comWeeverHelper::makeLowResPng($file['tmp_name'], 72, 72, 'icon');
	            }
	
				if($var == 'phone_load_live' && (($width != 640 || $height != 920) && ($width != 920 || $height != 640)))
				{
					return JError::raiseWarning(500,JText::_('WEEVER_ERROR_PHONE_DIMENSIONS'));
				}
				
				if($var == 'phone_load_live')
				{
					if($width == 640)
						comWeeverHelper::makeLowResPng($file['tmp_name'], 320, 460, 'phone_load');
					else
						comWeeverHelper::makeLowResPng($file['tmp_name'], 460, 320, 'phone_load');
						
				}
				
				if($var == 'tablet_load_live' && ($width != 1536 || $height != 2008))
				{
					return JError::raiseWarning(500, JText::_('WEEVER_ERROR_TABLET_DIMENSIONS'));
				}
				
				if($var == 'tablet_load_live')
				{					  
					  comWeeverHelper::makeLowResPng($file['tmp_name'], 768, 1004, 'tablet_load');		  	
				}
				
				if($var == 'tablet_lansdscape_load_live' && ($width != 1496|| $height != 2048))
				{
					return JError::raiseWarning(500, JText::_('WEEVER_ERROR_LANDSCAPE_TABLET_DIMENSIONS'));
				}
				
				if($var == 'tablet_landscape_load_live')
				{
					  comWeeverHelper::makeLowResPng($file['tmp_name'], 748, 1024, 'tablet_landscape_load');	             					  	
				}

				if($var == 'titlebar_logo_live' && ($width != 600 || $height != 64))
				{
					return JError::raiseWarning(500, JText::_('WEEVER_ERROR_TITLEBAR_DIMENSIONS'));
				}

	            if (JFile::upload($src, $dest)) 
	            {
	                $msg = JText::_('WEEVER_FILE_SAVE_AS').' '.$dest;
	            } 
	            else 
	            {
	                return JError::raiseWarning(500, JText::_('WEEVER_ERROR_IN_UPLOAD'));
	            }
            } 
            else if ($file['type'])
            {
            	return JError::raiseWarning(500, JText::_('WEEVER_WRONG_IMAGE_FORMAT'));	
            }


        }
        
        return $msg;
	}


	function makeLowResPng($originalImage,$toWidth,$toHeight,$newFilename)
	{
	
		
	    list($width, $height) = getimagesize($originalImage);
	    $xscale=$width/$toWidth;
	    $yscale=$height/$toHeight;
	
	    if ($yscale>$xscale){
	        $new_width = round($width * (1/$yscale));
	        $new_height = round($height * (1/$yscale));
	    }
	    else {
	        $new_width = round($width * (1/$xscale));
	        $new_height = round($height * (1/$xscale));
	    }
	   
	    $imageTmp     = imagecreatefrompng($originalImage);

	    imagejpeg($imageTmp, JPATH_SITE . DS .  'media' . DS . 'com_weever' . DS. $newFilename.'_live.jpg', 95);

	    $imageResized = imagecreatetruecolor($new_width, $new_height);
	    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
		imagepng($imageResized, JPATH_SITE . DS .  'media' . DS . 'com_weever' . DS. $newFilename.'_low.png');
		imagejpeg($imageResized, JPATH_SITE . DS .  'media' . DS . 'com_weever' . DS. $newFilename.'_low.jpg');
		
	    return $imageResized;
	  
	} 

	public static function tabSync($stage=null)
	{
	
		$tab_obj = comWeeverHelper::getJsonTabSync();
		
		$query = " SELECT `setting` FROM #__weever_config WHERE `option`='site_key' ";
		$db = &JFactory::getDBO();
		
		$db->setQuery($query);
		$key = $db->loadObject();
		
		comWeeverHelper::emptyTabRecords();
		
		foreach((object)$tab_obj->tabs as $k => $v)
		{
			
			# need to rebind each time or only last record gets recorded.
			$row =& JTable::getInstance('weever','Table');
			
			if(!$row->bind($v))
			{
				JError::raiseError(500, 'Didn t "bind" too terribly well. ');
			}
			
			if(!$row->store())
			{
				JError::raiseError(500, '"Store" didn t go so well. ');
			}
			
			comWeeverHelper::pushLocalIdToCloud($row->id, $row->hash, $key->setting);

		}
		
		
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		for($i = 1; $i <= 8; $i++)
		{
		
			$row->load($i);
		
			switch($row->option)
			{
				
				
				case "site_key":
				
					break;
				
				default:
				
					$row->setting = $tab_obj->config->{$row->option};
					$row->store();
					
					break;
			}

		}
		
		$query = "		UPDATE	#__weever_config".
				"		SET		setting = ".$db->Quote($tab_obj->config->theme_params)." ".
				"		WHERE	`option` = ".$db->Quote("theme_params")." ";
		
		$db->setQuery($query);
		$result = $db->loadObject();
		
		comWeeverHelper::generateQRCode();

	
	}
	
	public static function generateQRCode()
	{
	
		$siteDomain = comWeeverHelper::getSiteDomain();	
		
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7); $staging = $row->setting;
		$row->load(4); $keySiteDomain = $row->setting;
		
		if(!$keySiteDomain)
			$keySiteDomain = $siteDomain;
		
		if($staging)
		{
			$type = 'stage';
			$queryExtra = '&staging=1';
		}
		else
		{
			$type = 'live';
			$queryExtra = '';
		}
			
		$url = "http://qr.weever.ca/?site=".$siteDomain;

		if(!copy($url, JPATH_SITE . DS .  'media' . DS . 'com_weever' . DS. 'qr_site_'.$type.'.png'))
			JError::raiseWarning(500, 'QR Code build error. QR Code was not generated.');	
		
		$url = "http://qr.weever.ca/?site=".$keySiteDomain."&preview=1&beta=1".$queryExtra;

		if(!copy($url, JPATH_SITE . DS .  'media' . DS . 'com_weever' . DS. 'qr_app_'.$type.'.png'))
			JError::raiseWarning(500, 'QR Code build error. QR Code was not generated.');
			
	
	}
	

	public static function sortTabs($order)
	{

		$orderArray = explode(",",$order);
		$reorderType = array();
		
		foreach((array)$orderArray as $k=>$v)
		{
			$v = str_replace("TabID","",$v);	
			$reorderType[$v] = $k;	
		}
	
		$db = &JFactory::getDBO();	

	    $query = " 		SELECT 	ordering, id, component ".
	    		"		FROM	#__weever_tabs ".
	    		"		WHERE	type = 'tab' ORDER BY ordering ASC ";
		
		$db->setQuery($query);
		$orders = $db->loadObjectList();
		
		$kk = 0;
		$reorder = array();

		foreach((array)$orders as $k=>$v)
		{

			$reorder[ $reorderType[$v->component] ] = $v->id;	
		
		}
		
		foreach((array)$reorder as $k=>$v)
		{

			$query = "	UPDATE #__weever_tabs ".
					"	SET ordering = ".$db->Quote($k)." ".
					"	WHERE	id = ".$db->Quote($v)." ";


					
			$db->setQuery($query);
			@$db->loadObject();
		
		}
		
		$reordering = json_encode($reorder);
		
		JRequest::setVar('reordering', $reordering);	
		
		$response = comWeeverHelper::pushReorderToCloud();
		
		return $response;	
	
	}

	
	public static function sortSubtabs($type, $id, $dir)
	{
	
		$db = &JFactory::getDBO();	

	    $query = " 		SELECT 	ordering, id ".
	    		"		FROM	#__weever_tabs ".
	    		"		WHERE	type = ".$db->Quote($type)." ORDER BY ordering ASC ";


		
		$db->setQuery($query);
		$orders = $db->loadObjectList();
		$reorder = array();
		
		$kk = 0;
		$nextReorder = null;
		$lastId = null;

		foreach((array)$orders as $k=>$v)
		{
			
			$kk++;
			
			if($nextReorder)
			{
			
				$reorder[$kk - 1] = $v->id;
				$reorder[$kk] = $nextReorder;
				
				$nextReorder = null;
			
			}
			
			if($v->id == $id && $dir == "up" && $kk != 1)
			{
			
				$reorder[$kk] = $reorder[$kk - 1];
				$reorder[$kk - 1] = $v->id;
			
			}
			
			if($v->id == $id && $dir == "down")
			{
			
				$nextReorder = $v->id;
			
			}

			if(!$reorder[$kk] && !$nextReorder)
			{
				$reorder[$kk] = $v->id;
			}
			
			$lastId = $v->id;
		
		}
		
		if($nextReorder)
		{
			$reorder[$kk] = $v->id;		
		}
		
		$kk = 0;
		
		foreach((array)$reorder as $k=>$v)
		{

			$query = "	UPDATE #__weever_tabs ".
					"	SET ordering = ".$db->Quote($k)." ".
					"	WHERE	id = ".$db->Quote($v)." ";


					
			$db->setQuery($query);
			@$db->loadObject();
		
		}
		
		$reordering = json_encode($reorder);
		
		JRequest::setVar('reordering', $reordering);	
		
		$response = comWeeverHelper::pushReorderToCloud();
		
		return $response;	
	
	}
	
	
	//deprecated?
	public static function reorderTabs($type)
	{
	
		$db = &JFactory::getDBO();	

	    $query = " 		SELECT 	ordering, id ".
	    		"		FROM	#__weever_tabs ".
	    		"		WHERE	type = ".$db->Quote($type)." ORDER BY ordering ASC ";


		
		$db->setQuery($query);
		$orders = $db->loadObjectList();
		$reorder = array();

		foreach((array)$orders as $k=>$v)
		{

			$kk = $k+1;
			$query = "	UPDATE #__weever_tabs ".
					"	SET ordering = ".$db->Quote($kk)." ".
					"	WHERE	id = ".$db->Quote($v->id)." ";

					
			$db->setQuery($query);
			$result = $db->loadObject();

			$reorder[$kk] = $v->id;
		
		}
		
		$reordering = json_encode($reorder);
		echo $reordering;
		
		JRequest::setVar('reordering', $reordering);	
		
		comWeeverHelper::pushReorderToCloud();
				
	}
	


	public static function getJsonTabSync()
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		$staging = $row->setting;
		
		if($staging)
		{
			$weeverServer = comWeeverConst::LIVE_STAGE;
			$stageUrl = comWeeverHelper::getSiteDomain();
		}
		else
		{
			$weeverServer = comWeeverConst::LIVE_SERVER;
			$stageUrl = '';
		}
			
		$url = $weeverServer;
		$row->load(3);
		$key = $row->setting;
		
		$postdata = http_build_query(
			array( 	
				'stage' => $stageUrl,
				'app' => 'json',
				'site_key' => $key,
				'm' => "tab_sync",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		$json = comWeeverHelper::sendToWeeverServer($postdata);

		if($json == "Site key missing or invalid.")
			 JError::raiseError(500, JText::_('WEEVER_ERROR_BAD_SITE_KEY'));
		
		$j_array = json_decode($json);
		
		return $j_array->results;	
	
	}
	

	

	public static function sendToWeeverServerCurl($context)
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7); $staging = $row->setting;
		
		if($staging)
			$weeverServer = comWeeverConst::LIVE_STAGE;
		else
			$weeverServer = comWeeverConst::LIVE_SERVER;
			
		$url = $weeverServer."index.php";
		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$context);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

		$result = curl_exec($ch);

		curl_close($ch);
		
		return $result;

	}
	
	public static function sendToWeeverServer($postdata)
	{

		if(ini_get('allow_url_fopen') != 1) 
		{
		
			if  (in_array('curl', get_loaded_extensions()))
			{
				$context = $postdata;
				$response = comWeeverHelper::sendToWeeverServerCurl($context);
			}
		}
		else
		{
			$context = comWeeverHelper::buildPostDataContext($postdata);
			$response = comWeeverHelper::sendToWeeverServerFOpen($context);

		}

		return $response;
	
	}
	
	public static function sendToWeeverServerFOpen($context)
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
	    $row->load(7); $staging = $row->setting;
		
		if($staging)
			$weeverServer = comWeeverConst::LIVE_STAGE;
		else
			$weeverServer = comWeeverConst::LIVE_SERVER;
			
		$url = $weeverServer."index.php";
		
		$response = file_get_contents($url, false, $context);
		
		return $response;
	
	}
	
	
	public static function buildPostDataContext($postdata)
	{
	
		$opts = array(
					'http'=>array(
					
						'method'=>"POST",
						'header'=>"User-Agent: ".comWeeverConst::NAME." version: ".comWeeverConst::VERSION."\r\n".
						         "Content-length: " . strlen($postdata)."\r\n".
						         "Content-type: application/x-www-form-urlencoded\r\n",
						'content' => $postdata
					
						)
					);
	
		return stream_context_create($opts);
	
	}
	
	

	public static function pushReorderToCloud()
	{

		$postdata = http_build_query(
			array( 	
				'reordering' => JRequest::getVar('reordering'),
				'app' => 'ajax',
				'site_key' => JRequest::getVar('site_key'),
				'm' => "update_order",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return  comWeeverHelper::sendToWeeverServer($postdata);

	}
	
	public static function pushTabNameToCloud()
	{
	
		$postdata = http_build_query(
			array( 	
				'name' => JRequest::getVar('name'),
				'site_key' => JRequest::getVar('site_key'),
				'id' => JRequest::getVar('id'),
				'app' => 'ajax',
				'm' => "edit_tab_name",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);

	}
	
	
	public static function pushTabIconToCloud()
	{

		$postdata = http_build_query(
			array( 	
				'icon' => JRequest::getVar('icon'),
				'site_key' => JRequest::getVar('site_key'),
				'type' => JRequest::getVar('type'),
				'app' => 'ajax',
				'm' => "edit_tab_icon",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	}
	
	public static function pushThemeToCloud($jsonTheme)
	{
	
		$postdata = http_build_query(
			array( 	
				'theme' => $jsonTheme,
				'site_key' => JRequest::getVar('site_key'),
				'app' => 'ajax',
				'title' => JRequest::getVar('titlebar_title'),
				'm' => "edit_theme",
				'cms' => 'joomla',
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);

	}
						

	public static function pushConfigToCloud()
	{
	
		$postdata = http_build_query(
			array( 	
				'title' => JRequest::getVar('title'),
				'devices' => JRequest::getVar('devices'),
				'ecosystem' => JRequest::getVar('ecosystem'),
				'app_enabled' => JRequest::getVar('app_enabled'),
				'site_key' => JRequest::getVar('site_key'),
				'app' => 'ajax',
				'cms' => 'joomla',
				'm' => "edit_config",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	
	

	public static function pushSettingsToCloud()
	{
		
		$postdata = http_build_query(
			array( 	
				'name' => JRequest::getVar('name'),
				'hash' => JRequest::getVar('hash'),
				'component' => JRequest::getVar('component'),
				'published' => JRequest::getVar('published'),
				'component_id' => JRequest::getVar('component_id'),
				'ordering' => JRequest::getVar('ordering'),
				'id' => JRequest::getVar('id'),
				'rss_update' => JRequest::getVar('rss_update'),
				'icon' => JRequest::getVar('icon'),
				'rss' => JRequest::getVar('rss'),
				'type' => JRequest::getVar('type'),
				'component_behaviour' => JRequest::getVar('component_behaviour'),
				'var' => JRequest::getVar('var'),
				'parent_tab_id' => JRequest::getVar('parent_tab_id'),
				'site_key' => JRequest::getVar('site_key'),
				'cms_feed' => JRequest::getVar('cms_feed'),
				'app' => 'ajax',
				'm' => JRequest::getVar('weever_action') . "_tab",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
		
	}
	
	public static function pushPublishToCloud($cid, $publish)
	{
	
	
		$postdata = http_build_query(
			array(
				'published' => $publish,
				'app' =>'ajax',
				'm' => 'publish_tab',
				'site_key' => JRequest::getVar('site_key'),
				'local_tab_id' => $cid,
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
			
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	
		
	public static function pushDeleteToCloud($id)
	{
	
		$postdata = http_build_query(
			array(
				'local_tab_id' => $id,
				'app' => 'ajax',
				'm' => 'delete_tab',
				'site_key' => JRequest::getVar('site_key'),
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
		
	public static function pushLocalIdToCloud($id, $hash, $site_key)
	{
	
		$postdata = http_build_query(
			array(
				'local_tab_id' => $id,
				'hash' => $hash,
				'app' => 'ajax',
				'm' => 'tab_local_id',
				'site_key' => $site_key,
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	
	
	public static function checkIfTab($id)
	{
	
		$query = " 	SELECT id ".
				"	FROM	#__weever_tabs ".
				"	WHERE	id = '".$id."' ".
				"	AND		type = 'tab' ";
				
		$db = &JFactory::getDBO();
		
		$db->setQuery($query);
		$result = $db->loadObject();
		
		if($result->id)
			return TRUE;
		else
			return FALSE;
	
	}
	

	public static function emptyTabRecords()
	{
	
		$start = null;
		$limit = null;
		$where = null;
		$order = null;
	
		$query = self::buildQuery
		(
			"TRUNCATE TABLE #__weever_tabs ",
			$start, $limit, $where, $order
		);
		
		$db = &JFactory::getDBO();
		
		$db->setQuery($query);
		$db->loadObjectList();
	
	}


	public static function buildQuery($query, $start, $limit, $where, $order)
	{
	
		$query_lim = "";
		
		if($where)
			$query .= " WHERE ".$where;

		if($order)
			$query .= " ORDER BY ".$order." ";

		if($limit)
			$query_lim = " LIMIT ".$limit. " ";

		if($start && $limit)
			$query_lim = " LIMIT ".$start.", ".$limit." ";

			
		$query .= $query_lim;

		return $query;
		
	}
	
	
	public static function _buildBlogFeedURL() 
	{
	
		$tag = JRequest::getVar('tag');
	
		if($tag != "undefined")
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	public static function _buildPageFeedURL() 
	{
	
		$service = JRequest::getVar('cms_feed');			
		
		if($var = JRequest::getVar("tags"))	
		{
			$var = str_replace(",,","[[comma]]",$var);
			$var = explode( ",", $var );
			$var = json_encode($var);
			JRequest::setVar("var", $var);
		}
			
		return true;
		
	}
	public static function _buildComponentFeedURL() 
	{
	
		$service = JRequest::getVar('cms_feed');
			
		return true;
		
	}
	
	public static function _buildMapFeedURL() {}
	public static function _buildTabFeedURL() {}

	public static function _buildContactFeedURL() 
	{
	
		$service = JRequest::getVar('component_id');

		if(JRequest::getVar('weever_action') == 'add')
		{
			$type = JRequest::getVar('component_behaviour');
			
			$query = 	
				"SELECT #__contact_details.* ".
				"FROM #__contact_details ".
				"WHERE #__contact_details.id = '".JRequest::getVar('component_id')."' ";
			
			$db = &JFactory::getDBO();
			
			$db->setQuery($query);
			$contact = $db->loadObject();
			
			$json = new contact_json;
			
			$json->telephone = $contact->telephone;
			$json->email_to = $contact->email_to;
			$json->address = $contact->address;
			$json->town = $contact->suburb;
			$json->state = $contact->state;
			$json->country = $contact->country;
			$json->googlemaps = JRequest::getVar('googlemaps', 0);
			
			// destringify our options
			
			if($json->googlemaps == "0")
				$json->googlemaps = 0;
				
			$json->emailform = JRequest::getVar('emailform', 0);
			
			if($json->emailform == "0")
				$json->emailform = 0;
			
			$json = json_encode($json);
			
			JRequest::setVar('var', $json);
			
		}
		
		return null;		
	
	}
	
	
	public static function _buildSocialFeedURL() 
	{
	
		$service = JRequest::getVar('component');
		
		// replace with sanitization script later
		if($service == "identi.ca")
			$service = "identica";
			
		if($service == "identi.causer")
			$service = "identicauser";
			
		if($service == "twitterhashtag")
		{
			$service = "twitter";
			JRequest::setVar('component', 'twitter');
		}
			
		if($service == "twittequery")
		{
			$service = "twitter";
			JRequest::setVar('component', 'twitter');
		}
			
		$service_method = "_build".$service."FeedURL";
		
		$url = comWeeverHelper::$service_method();
		
		return $url;

	}
	
	public static function _buildTwitterUserFeedURL()
	{
		
		return "http://api.twitter.com/1/statuses/user_timeline.json";
	
	}
	
	public static function _buildIdenticaUserFeedURL()
	{
		
		return "http://identi.ca/api/statuses/user_timeline.json";
	
	}
	
	public static function _buildTwitterFeedURL()
	{
	
		return "http://search.twitter.com/search.json";
	
	}
	
	public static function _buildIdenticaFeedURL()
	{
	
		return "http://identi.ca/api/search.json";
	
	}
	
	public static function _buildFacebookFeedURL()
	{
	
		$idCode = JRequest::getVar('component_behaviour');
		
		if(strstr($idCode, "facebook.com"))
		{
			$pos = strrpos($idCode, "/");
			$idCode = substr($idCode, $pos+1);
		}
		
		$url = "http://graph.facebook.com/".$idCode."/feed";
		
		return $url;
	}
	
	public static function _buildPhotoFeedURL() 
	{
	
		$service = JRequest::getVar('component');
			
		$service_method = "_build".$service."FeedURL";
		
		$url = comWeeverHelper::$service_method();
		
		return $url;
	
	}
	
	public static function _buildFlickrFeedURL()
	{
		// doing this server-side;	
	}
	
	public static function _buildFoursquareFeedURL()
	{
	
		$idCode = JRequest::getVar('component_behaviour');
		
		if(strstr($idCode, "foursquare.com"))
		{
			$pos = strrpos($idCode, "/");
			$idCode = substr($idCode, $pos+1);
		}		
	
		$url = "https://api.foursquare.com/v2/venues/".$idCode."/photos";
		
		return $url;
		
	}
	
	
	public static function _buildVideoFeedURL() 
	{
	
		$service = JRequest::getVar('component');
			
		$service_method = "_build".$service."FeedURL";
		
		$url = comWeeverHelper::$service_method();
		
		return $url;
	
	}
	
	public static function _buildYoutubeFeedURL()
	{
	
		$url = "http://gdata.youtube.com/feeds/api/users/".comWeeverHelper::_parseYoutubeChannelURL(JRequest::getVar('component_behaviour'))."/uploads?&v=2&max-results=50&alt=jsonc";
		return $url;
	
	}
	
	public static function _buildVimeoFeedURL()
	{
	
		$url = "http://vimeo.com/api/v2/channel/".comWeeverHelper::_parseVimeoChannelURL(JRequest::getVar('component_behaviour'))."/videos.json";
		return $url;
	
	}
	
	public static function _parseVimeoChannelURL($url)
	{
	
		$channel = str_replace('http://www.vimeo.com/channels/','',$url);
		$channel = str_replace('http://vimeo.com/channels/','',$channel);
		
		$channel = str_replace('www.vimeo.com/channels/','',$channel);
		$channel = str_replace('vimeo.com/channels/','',$channel);
		
		$channel = str_replace('/','',$channel);
		
		$channel = preg_replace('/\?.*/', '', $channel);
		
		return $channel;
	
	}

	public static function _parseYoutubeChannelURL($url)
	{
	
		$channel = str_replace('http://www.youtube.com/user/','',$url);
		$channel = str_replace('http://youtube.com/user/','',$channel);
		$channel = str_replace('http://www.youtube.com/','',$channel);
		$channel = str_replace('http://youtube.com/','',$channel);
		
		$channel = str_replace('https://www.youtube.com/user/','',$channel);
		$channel = str_replace('https://youtube.com/user/','',$channel);
		$channel = str_replace('https://www.youtube.com/','',$channel);
		$channel = str_replace('https://youtube.com/','',$channel);
		
		$channel = str_replace('www.youtube.com/user/','',$channel);
		$channel = str_replace('youtube.com/user/','',$channel);
		$channel = str_replace('www.youtube.com/','',$channel);
		$channel = str_replace('youtube.com/','',$channel);
		
		$channel = str_replace('/','',$channel);
		
		$channel = preg_replace('/\?.*/', '', $channel);
		
		
		return $channel;
	
	}

}


class contact_json
{

	public 	$telephone;
	public 	$email_to;	
	public 	$name;
	public 	$address;
	public 	$town;
	public 	$state;
	public 	$country;
	public  $emailform;
	public 	$googlemaps;

}
