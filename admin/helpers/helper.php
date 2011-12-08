<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.3.1
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
jimport('joomla.plugin.helper');

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'theme'.'.php');

class comWeeverHelper
{

	public static function joomlaVersion() 
	{
	
		$version = new JVersion;
		$joomla = $version->getShortVersion();
		
		return $joomla;
	
	}
	
	
	public static function componentExists($component)
	{
		
		return JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.$component);
		
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
	

	public static function getJsStrings()
	{

		$joomla = comWeeverHelper::joomlaVersion();
		
		if(substr($joomla,0,3) == '1.5')
		{
			
			jsJText::script('WEEVER_JS_ENTER_NEW_APP_ICON_NAME');
			jsJText::script('WEEVER_JS_APP_UPDATED');
			jsJText::script('WEEVER_JS_PLEASE_WAIT');
			jsJText::script('WEEVER_JS_SAVING_CHANGES');
			jsJText::script('WEEVER_JS_SERVER_ERROR');
			jsJText::script('WEEVER_JS_ENTER_NEW_APP_ITEM');
			jsJText::script('WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO');
			jsJText::script('WEEVER_JS_QUESTION_MARK');
			jsJText::script('WEEVER_JS_CHANGING_NAV_ICONS');
			jsJText::script('WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS');
			jsJText::script('WEEVER_JS_CHANGING_NAV_PASTE_CODE');
			jsJText::script('WEEVER_CONFIG_ENABLED');
			jsJText::script('WEEVER_CONFIG_DISABLED');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_ANIMATIONS');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_TOGGLE');
			jsJText::script('WEEVER_JS_PANEL_HEADERS_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_HEADERS');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_ANIMATIONS');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOGGLE');
			jsJText::script('WEEVER_JS_ABOUTAPP_HEADERS_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_HEADERS');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_LONG');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_SHORT');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_DEFAULT');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_LONG');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_SHORT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_DEFAULT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_LONG');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_SHORT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_DEFAULT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_LONG');
			jsJText::script('WEEVER_JS_MAP_SETTINGS');
			jsJText::script('WEEVER_JS_MAP_START_LATITUDE_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_START_LATITUDE');
			jsJText::script('WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_START_LONGITUDE');
			jsJText::script('WEEVER_JS_MAP_START_ZOOM_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_START_ZOOM');
			jsJText::script('WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_DEFAULT_MARKER');
			
			jsJText::load();
		
		}
		else
		{
		
			JText::script('WEEVER_JS_ENTER_NEW_APP_ICON_NAME');
			JText::script('WEEVER_JS_APP_UPDATED');
			JText::script('WEEVER_JS_PLEASE_WAIT');
			JText::script('WEEVER_JS_SAVING_CHANGES');
			JText::script('WEEVER_JS_SERVER_ERROR');
			JText::script('WEEVER_JS_ENTER_NEW_APP_ITEM');
			JText::script('WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO');
			JText::script('WEEVER_JS_QUESTION_MARK');
			JText::script('WEEVER_JS_CHANGING_NAV_ICONS');
			JText::script('WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS');
			JText::script('WEEVER_JS_CHANGING_NAV_PASTE_CODE');
			JText::script('WEEVER_CONFIG_ENABLED');
			JText::script('WEEVER_CONFIG_DISABLED');
			JText::script('WEEVER_JS_PANEL_TRANSITION_ANIMATIONS');
			JText::script('WEEVER_JS_PANEL_TRANSITION_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_TRANSITION_TOGGLE');
			JText::script('WEEVER_JS_PANEL_HEADERS_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_HEADERS');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_ANIMATIONS');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOGGLE');
			JText::script('WEEVER_JS_ABOUTAPP_HEADERS_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_HEADERS');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_LONG');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_TIMEOUT');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_SHORT');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_DEFAULT');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_LONG');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_SHORT');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_DEFAULT');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_LONG');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_SHORT');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_DEFAULT');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_LONG');
			JText::script('WEEVER_JS_MAP_SETTINGS');
			JText::script('WEEVER_JS_MAP_START_LATITUDE_TOOLTIP');
			JText::script('WEEVER_JS_MAP_START_LATITUDE');
			JText::script('WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP');
			JText::script('WEEVER_JS_MAP_START_LONGITUDE');
			JText::script('WEEVER_JS_MAP_START_ZOOM_TOOLTIP');
			JText::script('WEEVER_JS_MAP_START_ZOOM');
			JText::script('WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP');
			JText::script('WEEVER_JS_MAP_DEFAULT_MARKER');
		
		}

	
	}
		
	

	public static function saveTheme()
	{
			
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(2);
		$row->setting = JRequest::getVar($row->option);		
		$row->store();
		
		$row->load(1);
		$row->setting = JRequest::getVar($row->option);		
		$row->store();
		
		$themeObj = new comWeeverThemeStylesObj;
		
		$themeObj->titlebarHtml = JRequest::getVar("titlebarHtml", "", "post","string",JREQUEST_ALLOWHTML);
		$themeObj->css = JRequest::getVar("css");
		$titlebarTextEnabled = JRequest::getVar("titlebar_title_enabled");
		$themeObj->template = JRequest::getVar("template");
		$themeObj->useCssOverride = JRequest::getVar("useCssOverride");

		
		if(trim($themeObj->titlebarHtml))
			$themeObj->titlebarSource = "html";
		else if($titlebarTextEnabled == 1)
			$themeObj->titlebarSource = "text";
		else
			$themeObj->titlebarSource = "image";
			
		$launch = new launch_screen;
		$launch->animation = JRequest::getVar("animation");
		$launch->duration = JRequest::getVar("duration");
		$launch->timeout = JRequest::getVar("timeout");
		$launch->install_prompt = JRequest::getVar("install_prompt");
		
		$jsonLaunch = json_encode($launch);

		$jsonTheme = json_encode($themeObj);

		$response = comWeeverHelper::pushThemeToCloud($jsonTheme, $jsonLaunch);		
		
	}
	
	
	
	public static function parseVersion($str)
	{
		
		$version = array(0,0,0,0);
	
		$ver = explode( ".", $str );
	
		foreach((array)$ver as $k=>$v)
		{
			
			if(!$v)
				$v = 0;
				
			$version[$k] = $v;
		}
		
		return $version;
	
	}
	
	
	public static function updateTabSettings()
	{
	
		$type = JRequest::getVar("type");
		
		switch($type)
		{
		
			case "map":
			
				$var = new map_settings;
				$var->start = new map_start;
				
				$submittedVars = explode(",",JRequest::getVar("var"));
				
				$var->start->latitude = $submittedVars[0];
				$var->start->longitude = $submittedVars[1];
				$var->start->zoom = $submittedVars[2];
				$var->marker = $submittedVars[3];
				
				$var_json = json_encode($var);
			
				break;
				
			case "panel": 
			case "aboutapp":
			
				$var = new panel_settings;
				$var->animation = new animation;
				
				$submittedVars = explode(",",JRequest::getVar("var"));
				
				
				$var->animation->type = $submittedVars[0];
				$var->animation->duration = $submittedVars[1];
				$var->animation->timeout = $submittedVars[2];
				$var->content_header = $submittedVars[3];
			
				$var_json = json_encode($var);
			
				break;
		
		}
		
		$response = comWeeverHelper::pushTabSettingsToCloud($var_json);
	
		return $response;
	
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
			if(JRequest::getVar('DetectTierWeeverTablets',0))
				$devices .= ",DetectTierWeeverTablets";		
				
			$devices = ltrim($devices,",");
				
			JRequest::setVar('devices',$devices);		
		}
		
			 
		for($i = 1; $i <= 12; $i++)
		{
		
			if($i == 2 || $i == 1 || $i == 6)
				continue;
		
			$row->load($i); 
			
			if($i == 11)
				$row->setting = JRequest::getVar($row->option,"", "post","string",JREQUEST_ALLOWHTML);
			else 
				$row->setting = JRequest::getVar($row->option);
			
			$row->store();
		
		}
		
		$response = comWeeverHelper::pushConfigToCloud();
		
		return $msg;
	
	}
	
	public static function toggleAppStatus()
	{

		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(6);
		
		if($row->setting)
			$row->setting = 0;
		else 
			$row->setting = 1;
			
		$response = comWeeverHelper::pushAppStatusToCloud($row->setting);
		
		if($response == "App Offline" || $response == "App Online")
			$row->store();
		else 
			$response = "Server Error: ".$response;
			
		return $response;
	
	}
	
	
	public static function tabSync($stage=null)
	{
	
		$tab_obj = comWeeverHelper::getJsonTabSync();
		
		$query = " SELECT `setting` FROM #__weever_config WHERE `option`='site_key' ";
		$db = &JFactory::getDBO();
		
		$db->setQuery($query);
		$key = $db->loadObject();
		
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
		

	
	}
	


	public static function sortTabs($order)
	{

		$orderArray = explode(",",$order);
		$reorderType = array();
		
		foreach((array)$orderArray as $k=>$v)
		{
			$v = str_replace("TabID","",$v);	
			$reorder[] = $v;
		}
	
		$reordering = json_encode($reorder);
		
		JRequest::setVar('reordering', $reordering);	
		
		$response = comWeeverHelper::pushReorderToCloud();
		
		return $response;	
	
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
				'generator' => comWeeverConst::NAME,
				'cms' => 'joomla'
				)
			);
			
		
		$json = comWeeverHelper::sendToWeeverServer($postdata);

		if($json == "Site key missing or invalid.")
		{
			 JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));
			 return false;
		}
		
		$j_array = json_decode($json);
		
		$latestVersion = comWeeverHelper::parseVersion($j_array->joomla_latest);
		$currentVersion = comWeeverHelper::parseVersion(comWeeverConst::VERSION);
		
		if( $latestVersion[0] > $currentVersion[0] ||
			($latestVersion[0] == $currentVersion[0] && $latestVersion[1] > $currentVersion[1]) ||
			($latestVersion[0] == $currentVersion[0] && $latestVersion[1] == $currentVersion[1] && $latestVersion[2] > $currentVersion[2]) ||
			($latestVersion[0] == $currentVersion[0] && $latestVersion[1] == $currentVersion[1] && $latestVersion[2] == $currentVersion[2] && $latestVersion[3] > $currentVersion[3]) )
		{
		
			JRequest::setVar("upgrade",$j_array->joomla_download);
			JRequest::setVar("upgradeVersion",$j_array->joomla_latest);
		
		}
		
		return $j_array->results;	
	
	}
	
	
	public static function getJsonThemeSync($all = null)
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
				'm' => "theme_sync",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME,
				'cms' => 'joomla'
				)
			);
			
		
		$json = comWeeverHelper::sendToWeeverServer($postdata);

		if($json == "Site key missing or invalid.")
		{
			 JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));
			 return false;
		}
		
		$j_array = json_decode($json);
		
		if($all)
			return $j_array;
		else 
			return $j_array->results;	
	
	}



	public static function getJsonAccountSync()
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
				'm' => "account_sync",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME,
				'cms' => 'joomla'
				)
			);
			
		
		$json = comWeeverHelper::sendToWeeverServer($postdata);

		if($json == "Site key missing or invalid.")
		{
			 JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));
			 return false;
		}
		
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
		
		$ch = curl_init($url);
		
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$context);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

		$response = curl_exec($ch);
		$error = curl_error($ch);

		curl_close($ch);
        
        if ($error != "")
        {
            $result = $error;
            return $result;
        }
       
        $result = $response;
		
		return $result;

	}
	
	public static function sendToWeeverServer($postdata)
	{

		
		if(in_array('curl', get_loaded_extensions()))
		{
			$context = $postdata;
			$response = comWeeverHelper::sendToWeeverServerCurl($context);
		}
		elseif(ini_get('allow_url_fopen') == 1)
		{
			$context = comWeeverHelper::buildPostDataContext($postdata);
			$response = comWeeverHelper::sendToWeeverServerFOpen($context);
		}
		else 
		{
			$response = JText::_('WEEVER_ERROR_NO_CURL_OR_FOPEN');
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
	
	public static function pushSubtabReorderToCloud()
	{

		$postdata = http_build_query(
			array( 	
				'id' => JRequest::getVar('id'),
				'reordering' => 'subtab',
				'type' => JRequest::getVar('type'),
				'dir' => JRequest::getVar('dir'),
				'app' => 'ajax',
				'site_key' => JRequest::getVar('site_key'),
				'm' => "update_order",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return  comWeeverHelper::sendToWeeverServer($postdata);

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
				'generator' => comWeeverConst::NAME,
				'cms' => 'joomla'
				)
			);
		
		return  comWeeverHelper::sendToWeeverServer($postdata);

	}
	

	public static function pushTabSettingsToCloud($var)
	{
	
		$postdata = http_build_query(
			array( 	
				'var' => $var,
				'site_key' => JRequest::getVar('site_key'),
				'id' => JRequest::getVar('id'),
				'type' => JRequest::getVar('type'),
				'app' => 'ajax',
				'm' => "update_tab_settings",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);

	}
	
	
	public static function pushImageToCloud($url)
	{
	
		$postdata = http_build_query(
			array( 	
				'url' => $url,
				'site_key' => JRequest::getVar('site_key'),
				'type' => JRequest::getVar('type'),
				'app' => 'ajax',
				'm' => "edit_image",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);

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
	
	public static function pushThemeToCloud($jsonTheme, $jsonLaunch)
	{
	
		$postdata = http_build_query(
			array( 	
				'theme' => $jsonTheme,
				'launch' => $jsonLaunch,
				'site_key' => JRequest::getVar('site_key'),
				'app' => 'ajax',
				'titlebar_title' => JRequest::getVar('titlebar_title'),
				'title' => JRequest::getVar('title'),
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
				'domain' => JRequest::getVar('domain'),
				'loadspinner' => JRequest::getVar('loadspinner',"", "post","string",JREQUEST_ALLOWHTML),
				'google_analytics' => JRequest::getVar('google_analytics'),
				'app' => 'ajax',
				'cms' => 'joomla',
				'm' => "edit_config",
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME
				)
			);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	
	
	public static function pushAppStatusToCloud($status)
	{
	
		$postdata = http_build_query(
			array( 	
				'app_enabled' => $status,
				'site_key' => JRequest::getVar('site_key'),
				'app' => 'ajax',
				'cms' => 'joomla',
				'm' => "app_status",
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
				'var' => JRequest::getVar('var',"", "post","string",JREQUEST_ALLOWRAW),
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
				'cloud_tab_id' => $cid,
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME,
				'cms' => 'joomla'
				)
			);
			
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	
		
	public static function pushDeleteToCloud($id)
	{
	
		$postdata = http_build_query(
			array(
				'cloud_tab_id' => $id,
				'app' => 'ajax',
				'm' => 'delete_tab',
				'site_key' => JRequest::getVar('site_key'),
				'version' => comWeeverConst::VERSION,
				'generator' => comWeeverConst::NAME,
				'cms' => 'joomla'
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
	
	public static function _buildMapFeedURL() 
	{
	
		$tag = JRequest::getVar('tag');
	
		if($tag != "undefined")
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildDirectoryFeedURL() 
	{
	
		$tag = JRequest::getVar('tag');
	
		if($tag != "undefined")
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
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
			
			$joomla = comWeeverHelper::joomlaVersion();
			
			if(substr($joomla,0,3) == '1.5')
				$json->image = "images/stories/".$contact->image;
			else 
				$json->image = $contact->image;
				
			$json->misc = $contact->misc;
			
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
	public	$image;
	public 	$misc;

}

class map_settings
{

	public $start;
	public $marker;

}

class map_start
{

	public $latitude;
	public $longitude;
	public $zoom;

}

class panel_settings
{

	public $animation;
	public $content_header;

}

class animation
{

	public $type;
	public $duration;
	
}

class launch_screen
{

	public $animation;
	public $duration;
	public $install_prompt;
	public $timeout;

}
