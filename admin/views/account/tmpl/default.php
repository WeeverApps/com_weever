<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.1.2
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

$document = &JFactory::getDocument();

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery.js' );
$document->addCustomTag ('<script type="text/javascript">jQuery.noConflict();</script>');

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-ui.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-impromptu.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/weever.js' );

$cssFile = JURI::base(true).'/components/com_weever/assets/css/ui-lightness/jquery-ui.css';
	$document->addStyleSheet($cssFile, 'text/css', null, array());

$cssFile = JURI::base(true).'/components/com_weever/assets/css/jquery-impromptu.css';
	$document->addStyleSheet($cssFile, 'text/css', null, array());
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/account.js' );

$pane = &JPane::getInstance('tabs');

$plugin_html_enabled = "";
$plugin_html_disabled = "";

if(!$this->site_key)
{

	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));

}

$onlineSpan = "";
$offlineSpan = "";

if($this->appEnabled)
{
	$offlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "";
}
else 
{
	$onlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
}

?>


<div id="wx-app-status-button" <?php echo $offlineStatusClass; ?>><img id="wx-app-status-img" src="../media/com_weever/icon_live.png?nocache=<?php echo microtime(); ?>" />
	
	<span id="wx-app-status-online" <?php echo $onlineSpan; ?>><strong><?php echo JText::_('WEEVER_ONLINE'); ?></strong><br /><span style="color:#666; font-size:0.65em;"><?php echo JText::_('WEEVER_ONLINE_INFO'); ?></span></span>
	
	<span id="wx-app-status-offline" <?php echo $offlineSpan; ?>><strong><?php echo JText::_('WEEVER_OFFLINE'); ?></strong><br /><span style="color:#666; font-size:0.65em;"><?php echo JText::_('WEEVER_OFFLINE_INFO'); ?></span></span>

</div>

<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>


<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
	

	<?php echo $pane->startPane('account'); ?>
	<?php echo $pane->startPanel(JText::_('WEEVER_ACCOUNT_INFORMATION'), 'basic-settings'); ?>
	
	<div>
	
	<fieldset class='adminForm'>
	<legend><?php echo JText::_('WEEVER_ACCOUNT_IDENTIFICATION'); ?></legend>

	<table class="admintable">
	

	
	<tr><td class="key"><?php echo JText::_('WEEVER_SITE_KEY'); ?></td>
	<td><input type="text" name="site_key" maxlength="42" style="width:250px;" value="<?php echo $this->site_key; ?>" /></td>
	</tr>
	
	<tr><td class="key"><?php echo JText::_('WEEVER_PRIMARY_DOMAIN'); ?></td>
	<td><?php echo JText::_("WEEVER_THIS_KEY_IS_LINKED_TO_THE_DOMAIN"); ?><b><?php echo $this->account->site; ?></b>.</td>
	</tr>
	
	<tr><td class="key"><?php echo JText::_('WEEVER_ACCOUNT_TIER'); ?></td>
	<td><b><?php echo $this->account->tier; ?></b></td>
	</tr>
	
	<tr><td class="key"><?php echo JText::_('WEEVER_ACCOUNT_EXPIRY'); ?></td>
	<td><?php echo $this->account->expiry; ?>.</td>
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
	
		
		
		<?php if($this->stagingMode) : ?>
		
	
			
			<tr><td class="key"><?php echo JText::_('WEEVER_TOGGLE_STAGING_MODE'); ?></td>
			<td>
			<button type="button" onclick="window.location.href='index.php?option=com_weever&amp;task=staging'"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_OFF'); ?></button><p><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_OFF_NOTE'); ?></p></td>
			</tr>
		
		
		<?php else : ?>
		
			
			<tr><td class="key"><?php echo JText::_('WEEVER_TOGGLE_STAGING_MODE'); ?></td>
			<td>
			<button type="button" onclick="window.location.href='index.php?option=com_weever&amp;task=staging'"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_ON'); ?></button><p><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_ON_NOTE'); ?></p></td>
			</tr>
			
		<?php endif; ?>
		
		<tr><td class="key"><?php echo JText::_('WEEVER_DELETE_STAGING_APP'); ?></td>
		<td>
		<button type="button" onclick="window.location.href='index.php?option=com_weever&amp;task=stagingdelete'"><?php echo JText::_('WEEVER_STAGING_DELETE_BUTTON'); ?></button>
			<p><?php echo JText::_('WEEVER_STAGING_DELETE_NOTE'); ?></p></td>
		</tr>
	
	<?php endif; ?>


	</table>
	
	</fieldset>
	</div>
	
	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->endPane(); ?>


	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" id="wx-site-key" value="<?php echo $this->site_key; ?>" />
	<input type="hidden" name="view" value="account" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>