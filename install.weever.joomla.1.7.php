<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
*	Version: 	0.9.3
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

jimport("joomla.installer.installer");

class com_WeeverInstallerScript
{

	public function install($parent)
	{
	
		$manifest = $parent->get("manifest");
		$parent = $parent->getParent();
		$source = $parent->getPath("source");
		
		$lang = &JFactory::getLanguage();
		$lang->load("com_weever");
		
		$installer = new JInstaller();
		
		foreach($manifest->plugins->plugin as $plugin) 
		{
			$attributes = $plugin->attributes();
			// 'folder' for install. No idea why this works.
			$plg = $source . DS . $attributes['folder'].DS.$attributes['plugin'];
			$result = $installer->install($plg);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			?>
			<p><?php echo JText::_("WEEVER_INSTALLING_PLUGIN"); ?><?php echo $attributes['folder']."/".$attributes['plugin'].": <b>".$message."</b>"; ?></p>
			<?php	

			$this->enableExtension($attributes['plugin'], 'plugin');
			echo " <p><i>".JText::_("WEEVER_ENABLED_PLUGIN").$attributes['plugin']."</i></p>";
		}
		
		foreach($manifest->templates->template as $template) 
		{
			$attributes = $template->attributes();
			$tmpl = $source . DS . 'templates'. DS . $attributes['template'];
			$result = $installer->install($tmpl);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			?>
			<p><?php echo JText::_("WEEVER_INSTALLING_TEMPLATE"); ?><?php echo $attributes['template'].": <b>".$message."</b>"; ?></p>
			<?php	
		
		}
		
		
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_live.png");
		
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."icon_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."icon_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."icon_live.png");
			
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_live.png");
			
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_live.png");
			
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_live.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."titlebar_logo_live.png");
		
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_low.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_low_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_load_low.png");
			
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_low.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_low_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."tablet_landscape_load_low.png");
			
		if(!file_exists(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_low.png"))
			copy(JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_low_.png", JPATH_ROOT.DS."media".DS."com_weever".DS."phone_load_low.png");
			
		
		if(!function_exists("stream_context_create"))
			echo "<div style='color:#700; font-weight:bold'>".JText::_("WEEVER_ERROR_STREAM_CONTEXT_CREATE")."</div>";
			
		if(!function_exists("fopen"))
			echo "<div style='color:#700; font-weight:bold'>".JText::_("WEEVER_ERROR_STREAM_CONTEXT_CREATE")."</div>";
		
		if(!function_exists("stream_get_contents"))
			echo "<div style='color:#700; font-weight:bold'>".JText::_("WEEVER_ERROR_STREAM_CONTEXT_CREATE")."</div>";
		
		if(ini_get('allow_url_fopen') != 1)
			echo "<div style='color:#700; font-weight:bold'>".JText::_("WEEVER_ERROR_URL_FOPEN")."</div>";
		
		?>
		<p><?php echo JText::_("WEEVER_INSTALL_WELCOME"); ?></p>
		
		<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
				
			<div>
			
			<fieldset class='adminForm'>
			<legend><?php echo JText::_("WEEVER_INSTALL_SITE_KEY"); ?></legend>
			
			<p><i><?php echo JText::_("WEEVER_UPGRADE_NOTICE"); ?></i></p>
		
			<table class="admintable">
			
		
			
				<tr>
				<td><input type="text" name="site_key" maxlength="42" style="width:250px;" placeholder="Paste your Site Key here" value="" /><input type="submit" value="<?php echo JText::_("WEEVER_INSTALL_SUBMIT_KEY"); ?>" /> <?php echo JText::_("WEEVER_ALLOW_FEW_SECONDS"); ?></td>
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
	
   function enableExtension($ext, $type)
   {
	   
	   	$db = JFactory::getDbo();
	   	$tableExtensions = $db->nameQuote("#__extensions");
	   	$columnElement   = $db->nameQuote("element");
	   	$columnType      = $db->nameQuote("type");
	   	$columnEnabled   = $db->nameQuote("enabled");
	   	
	   	// Enable plugins
	   	$db->setQuery(
	   	"UPDATE
	   	".$tableExtensions."
	   	SET
	   	".$columnEnabled."='1'
	   	WHERE
	   	".$columnElement."='".$ext."'
	   	AND
	   	".$columnType."='".$type."'"
	   	);
	   	
	   	$db->query();
   
   }
   
   function getExtensionId($type, $name, $group='')
   {

	   	$db =& JFactory::getDBO();

   		if($type=='plugin')
   			$db->setQuery("SELECT extension_id FROM #__extensions WHERE `type`='".$type."' AND `folder`='".$group."' AND `element`='".$name."'");
   			
   		else
   			$db->setQuery("SELECT extension_id FROM #__extensions WHERE `type`='".$type."' AND `element`='".$name."'");
   			
   		return $db->loadResult();


   }
   
	
   function uninstall($parent) 
   {


   		$manifest = $parent->get("manifest");
   		$parent = $parent->getParent();
   		$source = $parent->getPath("source");
   		
   		$lang = &JFactory::getLanguage();
   		$lang->load("com_weever");
   		
   		$uninstaller = new JInstaller();
   		
   		foreach($manifest->plugins->plugin as $plugin) 
   		{
   			$attributes = $plugin->attributes();
   			// 'group' for uninstall. 
   			$id = $this->getExtensionId('plugin', $attributes['plugin'], $attributes['group']);
   			$uninstaller->uninstall('plugin',$id,0);   			
   		}
   		
   		foreach($manifest->templates->template as $template) 
   		{
   			$attributes = $template->attributes();
   			$id = $this->getExtensionId('template', $attributes['template']);
   			$uninstaller->uninstall('template',$id);
   		}
   		

   }

   function update($parent) 
   {

 		$manifest = $parent->get("manifest");
 		$parent = $parent->getParent();
 		$source = $parent->getPath("source");
 		
 		$lang = &JFactory::getLanguage();
 		$lang->load("com_weever");
 		
 		$uninstaller = new JInstaller();
 		
 		// remove legacy plugins
 		// 0.9.2+
 		
  		$id = $this->getExtensionId('plugin', 'cartographer', 'system');
 		
 		if($id)
 			$result = $uninstaller->uninstall('plugin',$id,0);   	
 			
 		if($result)
 			$message = "<span style='color:green'>".JText::_("WEEVER_UNINSTALLED")."</span>";
 		else
 			$message = "<span style='color:grey'>".JText::_("WEEVER_NOT_PRESENT")."</span>";
 			
 		echo "<p>".JText::_("WEEVER_UNINSTALLING_PLUGIN")."system/cartographer: <b>".$message."</b></p>";
 		
 		
 			
 		$id = $this->getExtensionId('plugin', 'cartographerk2', 'system');
 		
 		if($id)
 			$result = $uninstaller->uninstall('plugin',$id,0);  
 			
 		if($result)
 			$message = "<span style='color:green'>".JText::_("WEEVER_UNINSTALLED")."</span>";
 		else
 			$message = "<span style='color:grey'>".JText::_("WEEVER_NOT_PRESENT")."</span>";
 			
 		echo "<p>".JText::_("WEEVER_UNINSTALLING_PLUGIN")."system/cartographer_k2: <b>".$message."</b></p>";
 		
 		
 			
 		$id = $this->getExtensionId('template', 'weever_cartographerdetails');
 		
 		if($id)
 			$result = $uninstaller->uninstall('template',$id,0);  
 			
 		if($result)
 			$message = "<span style='color:green'>".JText::_("WEEVER_UNINSTALLED")."</span>";
 		else
 			$message = "<span style='color:grey'>".JText::_("WEEVER_NOT_PRESENT")."</span>";
 			
 		echo "<p>".JText::_("WEEVER_UNINSTALLING_TEMPLATE")."templates/weever_cartographerdetails: <b>".$message."</b></p>";
 		
 		// end legacy removals
		
 				
		$installer = new JInstaller();
		
		foreach($manifest->plugins->plugin as $plugin) 
		{
			$attributes = $plugin->attributes();
			// 'folder' for install. No idea why this works.
			$plg = $source . DS . $attributes['folder'].DS.$attributes['plugin'];
			$result = $installer->install($plg);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			?>
			<p><?php echo JText::_("WEEVER_UPDATING_PLUGIN"); ?><?php echo $attributes['folder']."/".$attributes['plugin'].": <b>".$message."</b>"; ?></p>
			<?php	

			$this->enableExtension($attributes['plugin'], 'plugin');
			echo " <p><i>".JText::_("WEEVER_ENABLED_PLUGIN").$attributes['plugin']."</i></p>";
		}
		
		foreach($manifest->templates->template as $template) 
		{
			$attributes = $template->attributes();
			$tmpl = $source . DS . 'templates'. DS . $attributes['template'];
			$result = $installer->install($tmpl);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			?>
			<p><?php echo JText::_("WEEVER_UPDATING_TEMPLATE"); ?><?php echo $attributes['template'].": <b>".$message."</b>"; ?></p>
			<?php	

		}
		
		
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

			$response = file_get_contents('http://weeverapp.com/index.php?app=ajax&version=1.0&cms=joomla&m=upgrade&site_key='.$key->setting);	
			?>
			<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
			<?php 
			echo $response;
			echo JHTML::_('form.token');
			?>		 
			</form>
			<?php
		}
		

 		
   }


   function preflight($type, $parent) 
   {

		//echo '<p>' . JText::_('COM_WEEVER_PREFLIGHT_' . $type . '_TEXT') . '</p>';
   }


   function postflight($type, $parent) 
   {
		//echo '<p>' . JText::_('COM_WEEVER_POSTFLIGHT_' . $type . '_TEXT') . '</p>';

   }

}