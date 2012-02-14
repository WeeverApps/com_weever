<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.6.1
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

jimport('joomla.installer.installer');

$detailsTemplate = null; $cartographerId = null; $cartographerK2Id = null; $mobileespId = null;

$lang = &JFactory::getLanguage();
$lang->load("com_weever");

$db = & JFactory::getDBO();

$query = "SELECT `id` FROM `#__plugins` WHERE element=".$db->Quote('mobileesp')." AND folder=".$db->Quote('system');
$db->setQuery($query);
$check = $db->loadResultArray();

if(count($check) > 0)
{	

	$pluginInstallText = JText::_("WEEVER_UPDATING_PLUGIN");
	$templateInstallText = JText::_("WEEVER_UPDATING_TEMPLATE");
	
}
else 
{

	$pluginInstallText = JText::_("WEEVER_INSTALLING_PLUGIN");
	$templateInstallText = JText::_("WEEVER_INSTALLING_TEMPLATE");

}


// INSTALL mobileESP plugin

$installer = new JInstaller;
$src = $this->parent->getPath('source');
$path = $src.DS.'plugins'.DS.'system'.DS.'mobileesp';
$result = $installer->install($path);

if($result)
	$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
else
	$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
	
echo "<p>".$pluginInstallText."system/mobileesp: <b>".$message."</b></p>";


$query = "UPDATE #__plugins SET published='1' WHERE element='mobileesp' AND folder='system'";
$db->setQuery($query);
$db->query();
echo "<p><i>".JText::_("WEEVER_ENABLED_PLUGIN")."MobileESP</i></p>";


// DETECT K2
// then INSTALL weevermapsk2 plugin

if( JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2') )
{

	$src = $this->parent->getPath('source');
	$path = $src.DS.'plugins'.DS.'k2'.DS.'weevermapsk2';
	$result = $installer->install($path);
	
	if($result)
		$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
	else
		$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
		
	echo "<p>".$pluginInstallText."k2/weevermapsk2: <b>".$message."</b></p>";
	
	
	$query = "UPDATE #__plugins SET published='1' WHERE element='weevermapsk2' AND folder='k2'";
	$db->setQuery($query);
	$db->query();
	echo "<p><i>".JText::_("WEEVER_ENABLED_PLUGIN")."Weever Maps Geocoder for K2</i></p>";

}

// INSTALL weever_cartographer R3S template

$path = $src.DS.'templates';
$result = $installer->install($path);

if($result)
	$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
else
	$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
	
echo "<p>".$templateInstallText."templates/weever_cartographer: <b>".$message."</b></p>";




if( !is_dir(JPATH_ROOT.DS."images".DS."com_weever") )
{
	mkdir(JPATH_ROOT.DS."images".DS."com_weever");
	
	if( !file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_live.png") ) {
	
		if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."phone_load_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."phone_load_live.png");
		
		if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."icon_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."icon_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."icon_live.png");
			
		if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_load_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_load_live.png");
			
		if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_landscape_load_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_landscape_load_live.png");
			
		if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."titlebar_logo_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_.png", JPATH_ROOT.DS."images".DS."com_weever".DS."titlebar_logo_live.png");
			
	}
}

if(!function_exists("stream_context_create") && !function_exists("fopen") && !function_exists("stream_get_contents") && ini_get('allow_url_fopen') != 1)
	echo "<div style='color:#700; font-weight:bold'>".JText::_("WEEVER_ERROR_STREAM_CONTEXT_CREATE")."</div>";
	

$query = " SELECT `setting` FROM #__weever_config WHERE `option`='site_key' ";
$db = &JFactory::getDBO();

$db->setQuery($query);
$key = @$db->loadObject();

$query = " SELECT `setting` FROM #__weever_config WHERE `option`='loadspinner' ";

$db = &JFactory::getDBO();

$db->setQuery($query);
$code = @$db->loadObject();

if(!isset($code->setting))
{

	$query = " INSERT IGNORE INTO `#__weever_config` VALUES(9, 'google_analytics', ''); ";
	$db = &JFactory::getDBO();
	$db->setQuery($query);
	@$db->loadObject();
	

	$query = " INSERT IGNORE INTO `#__weever_config` VALUES(10, 'domain', ''); ";
	$db = &JFactory::getDBO();
	$db->setQuery($query);	
	@$db->loadObject();

	$query = " INSERT IGNORE INTO `#__weever_config` VALUES(11, 'loadspinner', ''); ";
	$db = &JFactory::getDBO();
	$db->setQuery($query);
	@$db->loadObject();


}


// check if there are server-side app updates to be made
if($key->setting)
{
	$response = file_get_contents('http://weeverapp.com/index.php?app=ajax&m=upgrade&version=1.6.1&cms=joomla&site_key='.$key->setting);	
	?>
	<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
	<?php 
	echo $response;
	echo JHTML::_('form.token');
	?>		 
	</form>
	<?php
	
	// if an upgrade
	
		
	if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."phone_load_live.png") && file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_live.png"))
		copy(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_live.png", JPATH_ROOT.DS."images".DS."com_weever".DS."phone_load_live.png");
	
	if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."icon_live.png") && file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."icon_live.png"))
		copy(JPATH_ROOT.DS."media".DS."com_weever".DS."icon_live.png", JPATH_ROOT.DS."images".DS."com_weever".DS."icon_live.png");
		
	if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_load_live.png") && file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_live.png"))
		copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_live.png", JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_load_live.png");
		
	if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_landscape_load_live.png") && file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_live.png"))
		copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_live.png", JPATH_ROOT.DS."images".DS."com_weever".DS."tablet_landscape_load_live.png");
		
	if(!file_exists(JPATH_ROOT.DS."images".DS."com_weever".DS."titlebar_logo_live.png") && file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_live.png"))
		copy(JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_live.png", JPATH_ROOT.DS."images".DS."com_weever".DS."titlebar_logo_live.png");

}
else 
{
?>
<p><?php echo JText::_("WEEVER_INSTALL_WELCOME"); ?></p>

<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
		
	<div>
	
	<fieldset class='adminForm'>
	<legend><?php echo JText::_("WEEVER_INSTALL_SITE_KEY"); ?></legend>
	
	<p><i><?php echo JText::_("WEEVER_UPGRADE_NOTICE"); ?></i></p>

	<table class="admintable">
	
		
		<tr>
		<td><a href="http://weeverapps.com/free" target="_blank" id="headerbutton"><?php JText::_("WEEVER_GET_A_KEY"); ?></a></td>
		</tr>

	
		<tr>
		<td><input type="text" name="site_key" maxlength="42" style="width:250px;" placeholder="<?php JText::_("WEEVER_PASTE_WEEVER_SITE_KEY_HERE"); ?>" value="" /><input type="submit" value="<?php echo JText::_("WEEVER_INSTALL_SUBMIT_KEY"); ?>" /><p><?php echo JText::_("WEEVER_ALLOW_FEW_SECONDS"); ?></p></td>
		</tr>	
	
		<tr>
		<td><input type="checkbox" name="staging" value="1" id="checkStaging" /> <label for="checkStaging"><?php echo JText::_("WEEVER_INSTALL_STAGING_MODE"); ?></label></td></tr>
	

	</table>
	
	</fieldset>
	</div>
	
	<input type="hidden" name="option" value="com_weever" />
	<input type="hidden" name="view" value="account" />
	<input type="hidden" name="task" value="save" />
	<input type="hidden" name="install" value="1" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>

<?php 
} 

