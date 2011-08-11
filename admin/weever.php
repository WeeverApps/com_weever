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

jimport('joomla.application.component.controller');
jimport('joomla.plugin.helper');

$version = new JVersion;
$joomla = $version->getShortVersion();

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper'.'.php');

if(substr($joomla,0,3) == '1.5')  // ### 1.5 only
{
	require_once (JPATH_COMPONENT.DS.'helpers'.DS.'jsjtext15'.'.php');
}

final class comWeeverConst
{

	const VERSION		= "0.9.2";
	const RELEASE_TYPE	= "dev";
	const RELEASE_NAME	= "Allan Park";
	const NAME			= "Weever Apps Administrator Component for Joomla!";
	const CMS_VERSION	= "1.5";
	const COPYRIGHT_YEAR= "(c) 2010-2011";
	const COPYRIGHT		= "Weever Apps Inc.";
	const COPYRIGHT_URL = "http://www.weeverapps.com/";
	const LICENSE		= "GPL v3.0";
	const LICENSE_URL	= "http://www.gnu.org/licenses/gpl-3.0.html";
	const RELEASE_DATE	= "August ?, 2011";
	const REVISION		= "53";
	const BUGS_EMAIL 	= "bugs@weever.ca";
	const SUPPORT_WEB	= "http://www.weeverapps.com/";
	const LIVE_SERVER	= "http://weeverapp.com/";
	const LIVE_STAGE	= "http://stage.weeverapp.com/";

}

$document =& JFactory::getDocument();
$cssFile = JURI::base(true).'/components/com_weever/assets/css/weever.css?v='.comWeeverConst::VERSION;
$document->addStyleSheet($cssFile, 'text/css', null, array());

if((ini_get('allow_url_fopen') != 1) && (!in_array('curl', get_loaded_extensions())) )
	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_ALLOW_URL_FOPEN_OFF'));	
	
if(!JPluginHelper::isEnabled('system', 'mobileesp'))
	JError::raiseNotice(100, JText::_('WEEVER_ERROR_PLUGIN_DISABLED'));
	
$row =& JTable::getInstance('WeeverConfig', 'Table');
$row->load(7); $staging = $row->setting;

if($staging)
	$weeverIcon = "weever_toolbar_title_staging";
else
	$weeverIcon = "weever_toolbar_title";


switch(JRequest::getWord('task'))
{
	case 'config':
	case 'theme':
	case 'account':
		
		
		JToolBarHelper::title( '&nbsp;', $weeverIcon);
		JToolBarHelper::save();

		
		break;

	case 'edit':
	case 'add':
		

		JToolBarHelper::title('&nbsp;', $weeverIcon);
		if(JRequest::getWord('layout',''))
		{
			
			JToolBarHelper::save();
			JToolBarHelper::apply();
			JToolBarHelper::cancel();
		}

		break;
		

	default:
		

		JToolBarHelper::title( '&nbsp;', $weeverIcon);
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList(JText::_('WEEVER_DELETE_TAB_CONFIRM'));

		
		break;
		
}





class WeeverController extends JController
{

	public function phpinfo()
	{
	
		phpinfo();
		jexit();
	}


	public function add()
	{
	
		JRequest::setVar('view', 'tab');
		$this->display();
	
	}
	
	
	public function edit()
	{
	
		JRequest::setVar('view', 'tab');
		$this->display();
	
	}

	public function ajaxSaveTabName()
	{
	

		
		$result = comWeeverHelper::pushTabNameToCloud();
		
		if($result == "Tab Changes Saved")
		{
			
			$row =& JTable::getInstance('weever','Table');
			
			$row->load(JRequest::getVar("id"));
			$row->name = JRequest::getVar("name");
			
			if(!$row->store())
			{
				JError::raiseError(500, $row->getError());
			}
		
		}
		
		echo $result;
		jexit();
	
	}
	
	
	public function ajaxSubtabDelete()
	{
	
		$row =& JTable::getInstance('Weever', 'Table');
			
		$id = JRequest::getVar('id');
		$result = comWeeverHelper::pushDeleteToCloud($id);
		
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}
		
		$row->delete($id);
		
		echo $result;
		jexit();				
		
	
	}
	
	
	public function ajaxTabPublish()
	{
	
		$row =& JTable::getInstance('Weever', 'Table');
		
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
		
		$row->load($id);
		$row->published = $publish;
		$row->store();
		
		echo $result;
		jexit();		
	
	}
	

	public function ajaxSaveTabIcon()
	{
	
		$jsonResult = comWeeverHelper::pushTabIconToCloud();

		comWeeverHelper::saveThemeJson($jsonResult);
	
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
		
		$id = JRequest::getVar("id");
		$dir = JRequest::getVar("dir");
		$type = JRequest::getVar("type");
		
		$response = comWeeverHelper::sortSubtabs($type, $id, $dir);
		
		echo $response;
		
		
		jexit();
	
	}
	
	public function ajaxSaveNewTab()
	{

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
			echo "Feed build failed!";
			jexit();
		}
		
		JRequest::setVar('rss', $rss, 'post');
		JRequest::setVar('hash', $hash, 'post');
		JRequest::setVar('weever_server_response', comWeeverHelper::pushSettingsToCloud(), 'post');
		
		if(JRequest::getVar('weever_server_response') == "Site key missing or invalid.")
		{
			echo JRequest::getVar('weever_server_response');
			jexit();
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
		
		//comWeeverHelper::reorderTabs($type);
		comWeeverHelper::pushLocalIdToCloud($row->id, JRequest::getVar('hash'), JRequest::getVar('site_key'));
		
		echo JRequest::getVar('weever_server_response');
		
		jexit();		
	
	}
		

	public function remove()
	{
		
		
		JRequest::checkToken() or jexit('Invalid Token');
		$option = JRequest::getCmd('option');
		
		$cid = JRequest::getVar('cid', array(0));
		$row =& JTable::getInstance('Weever', 'Table');
		
		$result = comWeeverHelper::pushDeleteToCloud($cid);
	
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}
		
		foreach((array)$cid as $id)
		{
			$id = (int) $id;
			
			if(!comWeeverHelper::checkIfTab($id))
			{
			
				if(!$row->delete($id))
				{
					JError::raiseError(500, $row->getError());
				}
		
			}
			else
			{
				JError::raiseNotice(100, JText::_('WEEVER_NOTICE_TABS_DELETED'));		
			}
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
			comWeeverHelper::saveTheme();
			$this->setRedirect('index.php?option=com_weever&view=theme&task=theme',JText::_('WEEVER_THEME_SAVED'));
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
		
		$row =& JTable::getInstance('Weever', 'Table');
		
		$publish = 1;
		
		if($this->getTask() == 'unpublish')
			$publish = 0;
		
		$result = comWeeverHelper::pushPublishToCloud($cid, $publish);
		
		if($result == "Site key missing or invalid.")
		{
			JError::raiseError(500, JText::_('WEEVER_SERVER_ERROR').$result);	
		}
		
		if(!$row->publish($cid, $publish))
		{
			JError::raiseError(500, $row->getError());		
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

$controller = new WeeverController();
$controller->registerTask('unpublish', 'publish');
$controller->registerTask('apply', 'save');
$controller->execute(JRequest::getWord('task'));
$controller->redirect();

// check here so the error doesn't generate when the app gets turned online.

$row->load(6);
$status = $row->setting;

if($status == 0 && !$staging)
	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_APP_OFFLINE'));

$row->load(3); $key = $row->setting;
$row->load(4); $keySiteDomain = $row->setting;

if($key)
{

	$siteDomain = comWeeverHelper::getSiteDomain();
	
	if($staging)
	{
		$weeverServer = comWeeverConst::LIVE_STAGE;
		$modetype = 'stage';
	}
	else
	{
		$weeverServer = comWeeverConst::LIVE_SERVER;
		$modetype = 'live';
	}

	echo '
	<div>
        <div style="background:#fffff0;" class="wx-qr-app">
        <img src="http://'.$siteDomain.'/media/com_weever/qr_app_'.$modetype.'.png"  class="wx-qr-imgprev" />

        <div class="wx-qr-textbox">

        <span class="wx-qr-app-text">'.JText::_('WEEVER_QR_TEST_CODE').'</span>

        <p>'.JText::_('WEEVER_QR_SCAN_PRIVATE').'<br/>
QR Link: '.JText::_('WEEVER_QR_DIRECT_ADDRESS').'<a href="'.$weeverServer.'app/'.$keySiteDomain.'">'.$weeverServer.'app/'.$keySiteDomain.'</a></p>

<p>'.JText::_('WEEVER_QR_ADDITIONAL_TEST').'</p>


</div></div>';
	
	if(!$staging)
		echo '<div style="background: #ECF4E6;" class="wx-qr-app">

                <img src="http://'.$siteDomain.'/media/com_weever/qr_site_'.$modetype.'.png"  class= "wx-qr-imgprev"  />

                <div class="wx-qr-textbox">

            <span class="wx-qr-app-text">'.JText::_('WEEVER_QR_PUBLIC_CODE').'</span>

              <p>'.JText::_('WEEVER_QR_PUBLIC_CODE_SHARE').' <a href="'.$siteDomain.'">http://'.$siteDomain.'</a></p>
<p>'.JText::_('WEEVER_QR_PUBLIC_CODE_SHARE_SUGGEST').'</p></div></div>';
	else
		echo '<div style="background:#ECF4E6;" class="wx-qr-app">'.JText::_('WEEVER_QR_STAGING_UNAVAILABLE').'</div>';
	
	echo '<div style="clear:both;"></div></div>';
		
}

echo '<div style="text-align:center;clear:both; margin-top:24px;">'.comWeeverConst::NAME.' version '.comWeeverConst::VERSION.' '.comWeeverConst::RELEASE_TYPE.' <br />'.
	comWeeverConst::COPYRIGHT_YEAR.' <a target="_blank" href="'.comWeeverConst::COPYRIGHT_URL.'">'.comWeeverConst::COPYRIGHT.'</a><br />
	Released '.comWeeverConst::RELEASE_DATE.' under <a target="_blank" href="'.comWeeverConst::LICENSE_URL.'">'.comWeeverConst::LICENSE.'</a>. 
	<a target="_blank" href="http://weeverapps.zendesk.com/home">Contact Support</a></div>';