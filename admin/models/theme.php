<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.5
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

class WeeverModelTheme extends JModel
{

	public 	$json = null;
	public  $account;

	public function __construct()
	{
       
       parent::__construct();
       
       $this->getJsonThemeSync();
       
	}
	
	public function getAppData()
	{
		
		return $this->json;
	
	}
	
	
	public function getAccountData()
	{
		
		return $this->account;
	
	}
	
	
	public function getJsonThemeSync()
	{
	
		if( comWeeverHelper::getStageStatus() )
		{
			$weeverServer = comWeeverConst::LIVE_STAGE;
			$stageUrl = comWeeverHelper::getSiteDomain();
		}
		else
		{
			$weeverServer = comWeeverConst::LIVE_SERVER;
			$stageUrl = '';
		}
		
		$postdata = comWeeverHelper::buildWeeverHttpQuery(
			array( 	
				'stage' => $stageUrl,
				'app' => 'json',
				'site_key' => comWeeverHelper::getKey(),
				'm' => "theme_sync"				
				)
		);
			
		$json = comWeeverHelper::sendToWeeverServer($postdata);

		if($json == "Site key missing or invalid.")
		{
			 JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));
			 return false;
		}
		
		$result = json_decode($json);
		
		$this->account = $result->account;
		$this->json = $result->results;

	
	}

	
}