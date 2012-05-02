<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.7
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

jimport('joomla.application.component.controller');
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper'.'.php');

class WeeverController extends JController
{

	public function phpinfo()
	{
	
		phpinfo();
		jexit();
	}

	
	public function upload()
	{
		
		require_once (JPATH_COMPONENT.DS.'classes'.DS.'fileuploader'.'.php');
	
		$allowedExtensions = array("png","jpg","jpeg","gif","svg");

		$sizeLimit = 1536000;
		
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		
		$result = $uploader->handleUpload(JPATH_ROOT . DS . 'images' . DS .'com_weever'. DS);
		
		if(isset($result['success']))
		{
		
			$result['url'] = 'http://'.comWeeverHelper::getSiteDomain().'/images/com_weever/'.$result['filename'];
		
			$result['weever_response'] = comWeeverHelper::pushImageToCloud($result['url']);
			
		}	

		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		jexit();
	
	}
	

	public function ajaxSaveTabName()
	{
	
		$result = comWeeverHelper::pushTabNameToCloud();
		
		echo $result;
		jexit();
	
	}
	
	
	public function ajaxSubtabDelete()
	{

		$id = JRequest::getVar('id');
		$result = comWeeverHelper::pushDeleteToCloud($id);
		
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}

		echo $result;
		
		jexit();				
		
	
	}
	
	
	public function ajaxTabPublish()
	{
	

		$status = JRequest::getVar('status');
		
		if($status == 1)		
			$publish = 0;
		else
			$publish = 1;
			
		$id = JRequest::getVar('id');
		$result = comWeeverHelper::pushPublishToCloud($id, $publish);
		
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}
		
		echo $result;
		jexit();		
	
	}
	

	public function ajaxSaveTabIcon()
	{
	
		$jsonResult = comWeeverHelper::pushTabIconToCloud();

		//comWeeverHelper::saveThemeJson($jsonResult);
	
		echo "Icon Saved";
		
		jexit();
	
	}
	
	public function ajaxSaveTabOrder()
	{
	
		$order = JRequest::getVar("order");
		
		$response = comWeeverHelper::sortTabs($order);
		
		echo $response;
		
		jexit();
	
	}
	
	public function ajaxSaveSubtabOrder()
	{
		
		$response = comWeeverHelper::pushSubtabReorderToCloud();

		echo $response;
		
		jexit();
	
	}
	
	public function ajaxToggleAppStatus()
	{
	
		$response = comWeeverHelper::toggleAppStatus();
		
		echo $response;
		
		jexit();
	
	}
	
	public function ajaxUpdateTabSettings()
	{
	
		$response = comWeeverHelper::updateTabSettings();
		
		echo $response;
		
		jexit();
	
	}
	
	public function ajaxSaveNewTab()
	{

		$rss = null;
		$tab_id = null;
		
		$type = JRequest::getWord('type', 'tab');
	
		if(  $type == "contact" || 
				$type == "blog" || $type == "directory" ||
				$type == "page" || 
				( $type == "map" && JRequest::getVar("tag") )  
			)
		{
		
			$type_method = "_build".$type."FeedURL";
	
			// ### check later
			if(JRequest::getVar('view' == "contact"))
			{
				comWeeverHelper::getContactInfo();		
			}		
			
			$rss = comWeeverHelper::$type_method();
			
			if($rss === false)
			{
				echo "Feed build failed!";
				jexit();
			}
						
		}
		

		JRequest::setVar('rss', $rss, 'post');
		JRequest::setVar('weever_server_response', comWeeverHelper::pushSettingsToCloud(), 'post');
		
		if(JRequest::getVar('weever_server_response') == "Site key missing or invalid.")
		{
			echo JRequest::getVar('weever_server_response');
			jexit();
		}

		
		echo JRequest::getVar('weever_server_response');
		
		jexit();		
	
	}
		

	public function remove()
	{
		
		
		JRequest::checkToken() or jexit('Invalid Token');
		$option = JRequest::getCmd('option');
		
		$cid = JRequest::getVar('cid', array(0));
		
		$result = comWeeverHelper::pushDeleteToCloud($cid);
	
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}		
		
		if($result)
			$this->setRedirect('index.php?option='.$option.'&view=list', JText::_('WEEVER_SERVER_RESPONSE').$result);	
		else
			$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');
		
	
	}
	
	public function staging()
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		
		$staging = $row->setting;
		
		if($staging)
			$msg = comWeeverHelper::disableStagingMode();
		else
			$msg = comWeeverHelper::enableStagingMode();
			
		$this->setRedirect('index.php?option=com_weever&view=account&task=account',$msg);
		return;
	
	}
	
	public function save()
	{
		
		$option = JRequest::getCmd('option');
		JRequest::checkToken() or jexit('Invalid Token');
	
		if(JRequest::getVar('view') == "config")
		{
			comWeeverHelper::saveConfig();
			$this->setRedirect('index.php?option=com_weever&view=config&task=config',JText::_('WEEVER_CONFIG_SAVED'));
			return;
		}
		
		if(JRequest::getVar('view') == "theme")
		{
			$msg = comWeeverHelper::saveTheme();			
			$this->setRedirect('index.php?option=com_weever&view=theme&task=theme',JText::_('WEEVER_THEME_SAVED').$msg);
			return;
		}
		
		if(JRequest::getVar('view') == "account")
		{
			if(JRequest::getVar('staging') == 1)
			{
				$row =& JTable::getInstance('WeeverConfig', 'Table');
				$row->load(7);
				$row->setting = 1;
				$row->store();			
			}
				
			comWeeverHelper::saveAccount();
			
			if(JRequest::getVar("install"))
				$this->setRedirect('index.php?option=com_weever&view=list',JText::_('WEEVER_ACCOUNT_SAVED'));
			else
				$this->setRedirect('index.php?option=com_weever&view=account&task=account',JText::_('WEEVER_ACCOUNT_SAVED'));
				
			return;
		}
		
		$tab_id = null;
		$hash = md5(microtime() . JRequest::getVar('name'));
		
		$type = JRequest::getWord('type', 'tab');
				
		$type_method = "_build".$type."FeedURL";
		
		// ### check later
		if(JRequest::getVar('view' == "contact"))
		{
			comWeeverHelper::getContactInfo();		
		}
		
		$rss = comWeeverHelper::$type_method();
		
		if($rss === false)
		{
			$this->setRedirect('index.php?option=com_weever&view=tab&task=add&layout='.JRequest::getVar('layout', 'blog'), JText::_('WEEVER_MUST_CHOOSE_OPTION_FROM_DROPDOWN'), 'error');
			return;
		}
		
		
		JRequest::setVar('rss', $rss, 'post');
		JRequest::setVar('hash', $hash, 'post');
		JRequest::setVar('weever_server_response', comWeeverHelper::pushSettingsToCloud(), 'post');
		
		if(JRequest::getVar('weever_server_response') == "Site key missing or invalid.")
		{
			$this->setRedirect('index.php?option='.$option.'&view=list', JText::_('WEEVER_SERVER_ERROR').JRequest::getVar('weever_server_response'), 'notice');	
			return;
		}
		
		$row =& JTable::getInstance('weever','Table');

		
		if(!$row->bind(JRequest::get('post')))
		{
			JError::raiseError(500, $row->getError());
		}
		
		$row->ordering = $row->ordering + 0.1; // for later reorder to sort well if it is in collision with another.
		
		if(!$row->store())
		{
			JError::raiseError(500, $row->getError());
		}
		
		comWeeverHelper::reorderTabs($type);
		comWeeverHelper::pushLocalIdToCloud($row->id, JRequest::getVar('hash'), JRequest::getVar('site_key'));
		
		if(JRequest::getVar('weever_server_response'))
		{
				
			if($this->getTask() == 'apply')
				$this->setRedirect('index.php?option='.$option.'&view=tab&task=edit'.'&cid[]='.$row->id,
					JText::_('WEEVER_SERVER_RESPONSE').JRequest::getVar('weever_server_response'));
			else		
				$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_SERVER_RESPONSE').JRequest::getVar('weever_server_response'));
				
			return;
		}
		else
		{
			$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');
			
			return;
		}
	
	}

	
	public function display()
	{
	
		$view = JRequest::getVar('view');
		
		if(!$view)
		{
			JRequest::setVar('view','list');
		}
		
		parent::display();
	
	}
	
	
	public function publish()
	{
	
		$option = JRequest::getCmd('option');

		$cid = JRequest::getVar('cid', array());
		if(!$cid)
		{
			$cid[] = JRequest::getVar('id', array());
		}
		
		$publish = 1;
		
		if($this->getTask() == 'unpublish')
			$publish = 0;
		
		$result = comWeeverHelper::pushPublishToCloud($cid, $publish);
		
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}
		
	
		if($result)
		{
			$this->setRedirect('index.php?option='.$option, JText::_('WEEVER_SERVER_RESPONSE').$result);	
			return;
		}
		else
		{
			$this->setRedirect('index.php?option='.$option, JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');
			return;
		}
	
	}


}
