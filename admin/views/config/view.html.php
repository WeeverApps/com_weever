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

jimport('joomla.application.component.view');
jimport('joomla.plugin.helper');

class WeeverViewConfig extends JView
{

	public function display($tpl = null)
	{
	
		$layout = JRequest::getWord('layout');
		$component = JComponentHelper::getComponent( 'com_weever' );

		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(6);
		$this->assign('appEnabled', $row->setting);

		for($i = 1; $i <= 10; $i++)
		{
		
			$row->load($i);
			
			switch($row->option)
			{
			
				case "devices":
				
					$this->assign('granular','');
					$this->assign('DetectIphoneOrIpod','');
					$this->assign('DetectAndroid','');
					$this->assign('DetectBlackBerryTouch','');
					$this->assign('DetectTouchPad','');
					$this->assign('DetectIpad','');
					$this->assign('DetectBlackBerryTablet','');
					$this->assign('DetectAndroidTablet','');
					$this->assign('DetectGoogleTV','');
					$this->assign('DetectAppleTVTwo','');
					$this->assign('DetectTierTablet','');
					$this->assign('DetectTierWeeverSmartphones','');
				
					$devices = explode(",",$row->setting);
					
					foreach((array)$devices as $v)
					{
						if($v)
						{
							$this->assign($v,'selected="selected"');
							if($v == "DetectIphoneOrIpod" ||
									$v == "DetectAndroid" ||
									$v == "DetectBlackBerryTouch" ||
									$v == "DetectTouchPad" ||
									$v == "DetectIpad" ||
									$v == "DetectBlackBerryTablet" ||
									$v == "DetectAndroidTablet" ||
									$v == "DetectGoogleTV" ||
									$v == "DetectAppleTVTwo")
							{
								$this->assign('granular','checked="checked"');
							}
						}
					}
				
					break;
					
				case "app_enabled":			
				
					$this->assign('plugin_html_enabled', '');
					$this->assign('plugin_html_disabled', '');
				
					if($row->setting == "1")
						$this->assign('plugin_html_enabled', 'checked="checked"');
					else
						$this->assign('plugin_html_disabled', 'checked="checked"');
				
					break;
					
				default:
				
					$this->assign($row->option,$row->setting);
					
					break;
			
			}
			
		
		}
		
		comWeeverHelper::getJsStrings();
		
		JSubMenuHelper::addEntry(JText::_('WEEVER_TAB_ITEMS'), 'index.php?option=com_weever', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_THEMING'), 'index.php?option=com_weever&view=theme&task=theme', false);
		JSubMenuHelper::addEntry(JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', true);
		JSubMenuHelper::addEntry(JText::_('WEEVER_ACCOUNT'), 'index.php?option=com_weever&view=account&task=account', false);

		
		parent::display($tpl);
	
	}



}