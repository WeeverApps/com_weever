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

$option = JRequest::getCmd('option');
JHTML::_('behavior.mootools');
jimport('joomla.html.pane');

$pane = &JPane::getInstance('tabs');


if(!$this->primary_domain)
{
	$siteDomain = JURI::base();
	$siteDomain = str_replace("http://www.","",$siteDomain);
	$siteDomain = str_replace("http://","",$siteDomain);
	$siteDomain = str_replace("/administrator/","",$siteDomain);
	$this->primary_domain = $siteDomain;
}

$plugin_html_enabled = "";
$plugin_html_disabled = "";


if(!$this->site_key)
{

	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));

}

?>

<div id="wx-app-status-button"><img id="wx-app-status-img" src="../media/com_weever/icon_live.png?nocache=<?php echo microtime(); ?>" /><br /> Take App <span id="wx-app-status-online">Online</span>/<span id="wx-app-status-offline">Offline</span></div>

<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
	

	<?php echo $pane->startPane('theme'); ?>
	<?php echo $pane->startPanel(JText::_('WEEVER_ACCOUNT_INFORMATION'), 'basic-settings'); ?>
	
	<div>
	
	<fieldset class='adminForm'>
	<legend><?php echo JText::_('WEEVER_ACCOUNT_IDENTIFICATION'); ?></legend>

	<table class="admintable">
	

	
	<tr><td class="key"><?php echo JText::_('WEEVER_SITE_KEY'); ?></td>
	<td><input type="text" name="site_key" maxlength="42" style="width:250px;" value="<?php echo $this->site_key; ?>" /></td>
	</tr>
	
	<tr><td class="key"><?php echo JText::_('WEEVER_PRIMARY_DOMAIN'); ?></td>
	<td><?php echo JText::_("WEEVER_THIS_KEY_IS_LINKED_TO_THE_DOMAIN"); ?><b><?php echo $this->primary_domain; ?></b>.</td>
	</tr>
	
	</table>
	
	</fieldset>
	</div>
	<?php if($this->site_key) : ?>
	
	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->startPanel(JText::_("WEEVER_STAGING_MODE_P_ADVANCED_P"), 'advanced-settings'); ?>
	
	<div>
	
	<fieldset class="adminForm">
	<legend><?php echo JText::_('WEEVER_TOGGLE_STAGING_MODE'); ?></legend>
	<table class="admintable">

	
	
	<?php if($this->staging_mode) : ?>
	

	
	<tr><td class="key"><?php echo JText::_('WEEVER_TOGGLE_STAGING_MODE'); ?></td>
	<td>
	<button type="button" onclick="window.location.href='index.php?option=com_weever&amp;task=staging'"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_OFF'); ?></button><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_OFF_NOTE'); ?></td>
	</tr>
	
	
	<?php else : ?>
	
	
	<tr><td class="key"><?php echo JText::_('WEEVER_TOGGLE_STAGING_MODE'); ?></td>
	<td>
	<button type="button" onclick="window.location.href='index.php?option=com_weever&amp;task=staging'"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_ON'); ?></button><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_ON_NOTE'); ?></td>
	</tr>
	<?php endif; ?>
	
	<?php endif; ?>


	</table>
	
	</fieldset>
	</div>
	
	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->endPane(); ?>


	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="view" value="account" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>