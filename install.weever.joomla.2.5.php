<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
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

jimport("joomla.installer.installer");

class com_WeeverInstallerScript
{

	public		$release 	= "1.8";
	public		$src;
	public		$installer;

	public function install($parent)
	{
	
		$manifest 			= $parent->get("manifest");
		$parent 			= $parent->getParent();	
		$this->src 			= $parent->getPath("source");
		$this->installer 	= new JInstaller();
		$lang 				= &JFactory::getLanguage();
		
		$lang->load("com_weever");
		
		$document = &JFactory::getDocument();
		
		$this->installPackagedExtensions($manifest);
			
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
		
		?>
		
		<p><?php echo JText::_("WEEVER_INSTALL_WELCOME"); ?></p>
		
		<form action='index.php' enctype='multipart/form-data' method='post'>
				
			<div>
			
				<fieldset class='adminForm'>
				<legend><?php echo JText::_("WEEVER_INSTALL_SITE_KEY"); ?></legend>
	
					<table class="admintable">

						<tr>
							<td><?php echo JText::_("WEEVER_GET_A_KEY"); ?></td>
						</tr>
					
						<tr>
							<td><input type="text" name="site_key" maxlength="42" style="width:250px;" placeholder="Paste your Site Key here" value="" /><input type="submit" value="<?php echo JText::_("WEEVER_INSTALL_SUBMIT_KEY"); ?>" /> </td>
						</tr>	
					
						<tr>
							<td><input type="checkbox" name="staging" value="1" id="checkStaging" style="float: left;" /> <label for="checkStaging"><?php echo JText::_("WEEVER_INSTALL_STAGING_MODE"); ?></label></td>
						</tr>
				
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
	
	
	protected function installPackagedExtensions($manifest)
	{
		
		$output = "
				<div style='clear:both'>
				
						<img src='components/com_weever/assets/icons/icon-48-weever_toolbar_title.png' style='float:left;padding-right:2em' />
						<h1 style='padding-top:0.625em;padding-bottom:1em;'>Weever Apps for Joomla version ". $manifest->version ."</h1>
						
				</div>
				";
	
		if( isset($manifest->plugins) )
			$output .= $this->installPlugins($manifest);
			
		if( isset($manifest->templates) )
			$output .= $this->installTemplates($manifest);
			
		if( isset($manifest->components) )
			$output .= $this->installComponents($manifest);
			
		echo $output;
			
	}
	
	
	protected function installPlugins($manifest)
	{
	
		$output = "";
	
		foreach( $manifest->plugins->plugin as $plugin ) 
		{
			
			$attributes 	= $plugin->attributes();
			$plg 			= $this->src.DS.$attributes['folder'].DS.$attributes['plugin'];
			
			$result = $this->installer->install($plg);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			
			$output .= "<p>".JText::_("WEEVER_INSTALLING_PLUGIN").$attributes['folder'].DS.
							$attributes['plugin'].": <b>".$message."</b></p>";

			$result = $this->enablePlugin($attributes['plugin']);
			
			if($result)			
				$output .= "<p><i>".JText::_("WEEVER_ENABLED_PLUGIN").$attributes['name']."</i></p>";
			else 
				$output .= "<p style='color:red'><i>".JText::_("WEEVER_ENABLE_PLUGIN_ERROR").$attributes['plugin']."</i></p>";
				
		}
		
		return $output;

	}
	
		
	protected function installComponents($manifest)
	{
	
		$output = "";
	
		foreach( $manifest->components->component as $component ) 
		{
			
			$attributes 	= $component->attributes();
			$com 			= $this->src.DS.$attributes['folder'].DS.$attributes['component'];
			
			$result = $this->installer->install($com);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			
			$output .= "<p>".JText::_("WEEVER_INSTALLING_COMPONENT").
							$attributes['component'].": <b>".$message."</b></p>";
							
			$output .= "<p><i>".JText::_("WEEVER_INSTALLED").$attributes['name']."</i></p>";
				
		}
		
		return $output;

	}
	
	
	protected function installTemplates($manifest)
	{
	
		$output = "";
	
		foreach( $manifest->templates->template as $template ) 
		{
			
			$attributes 	= $template->attributes();
			$tmpl 			= $this->src.DS.'templates'.DS.$attributes['template'];
			
			// @ for 2.5.0 - 2.5.1 template install bug
			$result = @$this->installer->install($tmpl);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
			
			$output .= "<p>".JText::_("WEEVER_INSTALLING_TEMPLATE").'templates'.DS.
							$attributes['template'].": <b>".$message."</b></p>";
							
			$output .= "<p><i>".JText::_("WEEVER_INSTALLED").$attributes['name']."</i></p>";
				
		}
		
		return $output;

	}
		
	
	protected function enablePlugin($ext, $type = 'plugin')
	{
	   
	   	$db = &JFactory::getDBO();
	   	
	   	$query = "UPDATE #__extensions ".
	   			"SET 	".$db->nameQuote('enabled')	." = 1 ".
	   			"WHERE	".$db->nameQuote('element')	." = ".$db->quote($ext)." ".
	   			"AND	".$db->nameQuote('type')	." = ".$db->quote($type)." ";
	   	
	   	$db->setQuery($query);
	   	$result = $db->query();
	   	
	   	return $result;
	
	}
	
	
	protected function getExtensionId($type, $name, $group='')
	{
	
	   	$db = &JFactory::getDBO();
	
		if($type=='plugin')
		{
			
			$query = "SELECT extension_id ".
					"FROM 	#__extensions ".
					"WHERE 	".$db->quoteName('type')."		= ".$db->quote($type)	." ".
					"AND 	".$db->quoteName('folder')."	= ".$db->quote($group)	." ".
					"AND 	".$db->quoteName('element')."	= ".$db->quote($name)	." ";
					
			$db->setQuery($query);
			$db->query();
			
		}
		else
		{
			
			$query = "SELECT extension_id ".
					"FROM #__extensions ".
					"WHERE 	".$db->quoteName('type')."		= ".$db->quote($type)." ".
					"AND 	".$db->quoteName('element')."	= ".$db->quote($name)." ";
					
			$db->setQuery($query);
			$db->query();
		
		}
			
		$result = $db->loadResult();
		
		return $result;
	
	}
   
	
	public function uninstall($parent) 
	{
	
	
		$manifest = $parent->get("manifest");
		$parent = $parent->getParent();
		$source = $parent->getPath("source");
		
		$lang = &JFactory::getLanguage();
		$lang->load("com_weever");
		
		$uninstaller = new JInstaller();
		
		if( isset( $manifest->plugins ) ) 
		{
		
			foreach($manifest->plugins->plugin as $plugin) 
			{
				$attributes 	= $plugin->attributes();
				// 'group' required for uninstall. 
				$id 			= $this->getExtensionId('plugin', $attributes['plugin'], $attributes['group']);
				
				$uninstaller->uninstall('plugin',$id,0);   			
			}
			
		}
		
		if( isset( $manifest->templates ) ) 
		{
		
			foreach($manifest->templates->template as $template) 
			{
				$attributes = $template->attributes();
				$id = $this->getExtensionId('template', $attributes['template']);
				$uninstaller->uninstall('template',$id);
			}
			
		}
		
		if( isset( $manifest->components ) ) 
		{
		
			foreach($manifest->components->component as $component) 
			{
				$attributes = $component->attributes();
				$id = $this->getExtensionId('component', $attributes['component']);
				$uninstaller->uninstall('component',$id);
			}
			
		}
	
			
	
	}
	
	
	public function update($parent) 
	{
	
			$manifest 			= $parent->get("manifest");
			$parent 			= $parent->getParent();	
			$this->src 			= $parent->getPath("source");
		$this->installer 	= new JInstaller();
		$lang 				= &JFactory::getLanguage();
		
		$lang->load("com_weever");
	
		$this->installPackagedExtensions($manifest);
	
		if( !is_dir(JPATH_ROOT.DS."images".DS."com_weever") )
		{
			mkdir(JPATH_ROOT.DS."images".DS."com_weever");
					
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
			@$db->query();
			
		
			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(10, 'domain', ''); ";
			$db = &JFactory::getDBO();
			$db->setQuery($query);	
			@$db->query();
		
			$query = " INSERT IGNORE INTO `#__weever_config` VALUES(11, 'loadspinner', ''); ";
			$db = &JFactory::getDBO();
			$db->setQuery($query);
			@$db->query();
		
		}
		
		// check if there are server-side app updates to be made
		if($key->setting)
		{
	
			$key->setting = (string) $key->setting;
	
			$response = file_get_contents('http://weeverapp.com/index.php?app=ajax&version='.$this->release.'&cms=joomla&m=upgrade&site_key='.$key->setting);	
			
			?>
			
			<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
			
			<?php 
			echo $response;
			echo JHTML::_('form.token');
			?>		
			 
			</form>
			<?php
		}
		
		$query = "CREATE TABLE IF NOT EXISTS `#__weever_maps` (
		  `id` int(11) NOT NULL auto_increment,
		  `component_id` int(11) NOT NULL,
		  `component` varchar(24) NOT NULL,
		  `altitude` decimal(10,3) NOT NULL,
		  `address` mediumtext NOT NULL,
		  `label` varchar(16) NOT NULL,
		  `kml` tinytext NOT NULL,
		  `marker` tinytext NOT NULL,
		  `location` point NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		
		$db->setQuery($query);
		$db->query();
			
	}
	
	
   public function preflight($type, $parent) 
   {

		//echo '<p>' . JText::_('COM_WEEVER_PREFLIGHT_' . $type . '_TEXT') . '</p>';
   }


   public function postflight($type, $parent) 
   {
		//echo '<p>' . JText::_('COM_WEEVER_POSTFLIGHT_' . $type . '_TEXT') . '</p>';

   }

}