<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.4
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

	const VERSION		= "0.9.4";
	const RELEASE_TYPE	= "dev";
	const RELEASE_NAME	= "Allan Park";
	const NAME			= "Weever Apps Administrator Component for Joomla!";
	const COPYRIGHT_YEAR= "(c) 2010-2011";
	const COPYRIGHT		= "Weever Apps Inc.";
	const COPYRIGHT_URL = "http://www.weeverapps.com/";
	const LICENSE		= "GPL v3.0";
	const LICENSE_URL	= "http://www.gnu.org/licenses/gpl-3.0.html";
	const RELEASE_DATE	= "September 2, 2011";
	const BUGS_EMAIL 	= "bugs@weever.ca";
	const SUPPORT_WEB	= "http://www.weeverapps.com/";
	const LIVE_SERVER	= "http://weeverapp.com/";
	const LIVE_STAGE	= "http://cephalopod.weeverapp.com/";

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
{
	$weeverIcon = "weever_toolbar_title_staging";
	$style = "#wx-app-status-button { display: none !important; }";
	$document->addStyleDeclaration($style);
}
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


jimport('joomla.application.component.controller');

require_once (JPATH_COMPONENT.DS.'controller.php');

$controller = new WeeverController();
$controller->registerTask('unpublish', 'publish');
$controller->registerTask('apply', 'save');
$controller->execute(JRequest::getWord('task'));
$controller->redirect();

// check here so the error doesn't generate when the app gets turned online.

$row->load(6);
$status = $row->setting;

// now has the button
/*if($status == 0 && !$staging)
	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_APP_OFFLINE'));*/

$row->load(3); $key = $row->setting;
$row->load(4); $keySiteDomain = $row->setting;

if(!$key)
{
	$style = "#wx-app-status-button { display: none !important; }";
	$document->addStyleDeclaration($style);
}

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

echo '<div style="text-align:center;clear:both; margin-top:24px;">'.comWeeverConst::NAME.' v'.comWeeverConst::VERSION.' '.comWeeverConst::RELEASE_TYPE.' <br />'.
	comWeeverConst::COPYRIGHT_YEAR.' <a target="_blank" href="'.comWeeverConst::COPYRIGHT_URL.'">'.comWeeverConst::COPYRIGHT.'</a><br />
	Released '.comWeeverConst::RELEASE_DATE.' under <a target="_blank" href="'.comWeeverConst::LICENSE_URL.'">'.comWeeverConst::LICENSE.'</a>. 
	<a target="_blank" href="http://weeverapps.zendesk.com/home">Contact Support</a></div>';