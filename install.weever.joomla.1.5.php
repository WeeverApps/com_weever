<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
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

jimport('joomla.installer.installer');

$lang = &JFactory::getLanguage();
$lang->load("com_weever");

$db = & JFactory::getDBO();

$query = "SELECT `id` FROM `#__plugins` WHERE element=".$db->Quote('mobileesp')." AND folder=".$db->Quote('system');
$db->setQuery($query);
$check = $db->loadResultArray();

if(count($check) > 0)
{

	$status = new JObject();
	$status->plugins = array();
	$status->templates = array();
	
	$plugins = &$this->manifest->getElementByPath('plugins');
	if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) 
	{
	
		foreach ($plugins->children() as $plugin) 
		{
			$pname = $plugin->attributes('plugin');
			$pgroup = $plugin->attributes('group');
			$query = "SELECT `id` FROM `#__plugins` WHERE element=".$db->Quote($pname)." AND folder=".$db->Quote($pgroup);
			$db->setQuery($query);
			$plugins = $db->loadResultArray();
			if(count($plugins)) 
			{
				foreach($plugins as $plugin) 
				{
					$installer = new JInstaller;
					$result = $installer->uninstall('plugin',$plugin, 0);
				}
			}
			
			$status->plugins[] = array('name'=>$pname,'group'=>$pgroup, 'result'=>$result);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_UNINSTALLED")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_NOT_PRESENT")."</span>";
			?>
			<p><?php echo JText::_("WEEVER_UNINSTALLING_PLUGIN"); ?><?php echo $pgroup."/".$pname.": <b>".$message."</b>"; ?></p>
			<?php
			
	
		}
	}
	
	$templates = &$this->manifest->getElementByPath('templates');
	if (is_a($templates, 'JSimpleXMLElement') && count($templates->children())) 
	{
	
		foreach ($templates->children() as $template) 
		{
			$tname = $template->attributes('template');
			$installer = new JInstaller;
			$result = $installer->uninstall('template',$tname, 0);
			$status->templates[] = array('name'=>$tname, 'result'=>$result);
			
			if($result)
				$message = "<span style='color:green'>".JText::_("WEEVER_UNINSTALLED")."</span>";
			else
				$message = "<span style='color:red'>".JText::_("WEEVER_NOT_PRESENT")."</span>";
			?>
			<p><?php echo JText::_("WEEVER_UNINSTALLING_TEMPLATE"); ?><?php echo $tname.": <b>".$message."</b>"; ?></p>
			<?php
	
		}
	}

//
}

$status = new JObject();
$status->plugins = array();
$status->templates = array();
$src = $this->parent->getPath('source');

$plugins = &$this->manifest->getElementByPath('plugins');
if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) {

	foreach ($plugins->children() as $plugin) {
		$pname = $plugin->attributes('plugin');
		$pgroup = $plugin->attributes('group');
		$path = $src.DS.'plugins'.DS.$pgroup.DS.$pname;
		$installer = new JInstaller;
		$result = $installer->install($path);
		$status->plugins[] = array('name'=>$pname,'group'=>$pgroup, 'result'=>$result);
		if($result)
			$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
		else
			$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
		?>
		<p><?php echo JText::_("WEEVER_INSTALLING_PLUGIN"); ?><?php echo $pgroup."/".$pname.": <b>".$message."</b>"; ?></p>
		<?php
		
		// enable installed plugins
		$query = "UPDATE #__plugins SET published=1 WHERE element=".$db->Quote($pname)." AND folder=".$db->Quote($pgroup);
		$db->setQuery($query);
		$db->query();
		echo "<p><i>".JText::_("WEEVER_ENABLED_PLUGIN").$pname."</i></p>";

	}
}

$templates = &$this->manifest->getElementByPath('templates');
if (is_a($templates, 'JSimpleXMLElement') && count($templates->children())) {

	foreach ($templates->children() as $template) {
		$tname = $template->attributes('template');
		$path = $src.DS.'templates';
		$installer = new JInstaller;
		$result = $installer->install($path);
		$status->templates[] = array('name'=>$tname, 'result'=>$result);
		if($result)
			$message = "<span style='color:green'>".JText::_("WEEVER_SUCCESS")."</span>";
		else
			$message = "<span style='color:red'>FAILED</span>";
		?>
		<p><?php echo JText::_("WEEVER_INSTALLING_TEMPLATE"); ?><?php echo $tname.": <b>".$message."</b>"; ?></p>
		<?php

	}
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
	

$query = " SELECT `setting` FROM #__weever_config WHERE `option`='site_key' ";
$db = &JFactory::getDBO();

$db->setQuery($query);
$key = @$db->loadObject();

// check if there are server-side app updates to be made
if($key)
{
	$response = file_get_contents(conf::SITE_PATH.'index.php?app=ajax&m=upgrade&site_key='.$key);	
	echo $response;
}

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


