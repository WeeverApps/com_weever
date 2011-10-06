<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.0.0.1
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

$db = & JFactory::getDBO();
$status = new JObject();
$status->plugins = array();
$status->templates = array();

$lang = &JFactory::getLanguage();
$lang->load("com_weever");

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
			$message = "<span style='color:red'".JText::_("WEEVER_FAILED")."</span>";
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
			$message = "<span style='color:red'>".JText::_("WEEVER_FAILED")."</span>";
		?>
		<p><?php echo JText::_("WEEVER_UNINSTALLING_TEMPLATE"); ?><?php echo $tname.": <b>".$message."</b>"; ?></p>
		<?php

	}
}