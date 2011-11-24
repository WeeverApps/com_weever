<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.3
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
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/account.js' );

$joomla = comWeeverHelper::joomlaVersion();

if(substr($joomla,0,3) != '1.5')  // ### non-1.5 only
	$jsJoomla = "Joomla.";
else 
	$jsJoomla = "";


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

<?php if($this->account->tier_number == 1) : ?>
	<div style="position:absolute; right:10px; top:136px; margin:0 1em;">
	<span style="float: right; font-size: 10px;"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION'); ?></span>
	<span style="float:right; line-height: 1.25em; font-size: 1em; text-align: right; margin:1px 1.5em 0 0;"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION_LEARN_MORE'); ?></span></div>

<?php elseif($this->account->tier_number == 2.1) : ?>
	<span style="font-size: 1.5em; position: absolute; right: 10px; line-height: 1.25em; min-width: 420px; text-align: left; margin: 0pt; top: 136px;"><a href="http://weeverapps.com/pricing" style="float: left; margin: 0pt 1em;" id="headerbutton"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BUTTON'); ?></a><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_CALL'); ?><br><span style="font-size: 0.75em; margin: 0pt;"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BYLINE'); ?></span></span>
	
<?php endif; ?>
	

<span id="wx-admin-topbar-left" class="wx-admin-topbar">
			<a href="http://weeverapps.com/pricing"><?php echo JText::_('WEEVER_PLANS_AND_PRICING'); ?></a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps"><?php echo JText::_('WEEVER_FOLLOW_TWITTER'); ?></a> &nbsp; | &nbsp; <a href="http://eepurl.com/fP-oD"><?php echo JText::_('WEEVER_NEWSLETTER'); ?></a>

</span>
    

<div id="wx-admin-topbar-right" class="wx-admin-topbar">

<span <?php echo $offlineStatusClass; ?> id="wx-app-status-button">
    
  <span <?php echo $onlineSpan; ?> id="wx-app-status-online">
	<span id="wx-status-current"><?php echo JText::_('WEEVER_APP_STATUS'); ?></span>
    <span id="wx-status-boldonline"><strong><?php echo JText::_('WEEVER_ONLINE'); ?></strong></span>
    <span id="wx-status-current"><?php echo JText::_('WEEVER_FOR_MOBILE_VISITORS'); ?></span>
	<span id="wx-status-takeoffline"><?php echo JText::_('WEEVER_TAKE_OFFLINE'); ?></span>
  </span>
    
  <span <?php echo $offlineSpan; ?> id="wx-app-status-offline">
    <span id="wx-status-current"><?php echo JText::_('WEEVER_APP_STATUS'); ?></span>
    <span id="wx-status-boldoffline"><strong><?php echo JText::_('WEEVER_OFFLINE'); ?></strong></span>
    <span id="wx-status-current"><?php echo JText::_('WEEVER_FOR_MOBILE_VISITORS'); ?></span>
	<span id="wx-status-turnonline"><?php echo JText::_('WEEVER_TURN_APP_ONLINE'); ?></span>
  </span>

</span>
</div>


<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>


<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
	

	<?php echo $pane->startPane('account'); ?>
	<?php echo $pane->startPanel(JText::_('WEEVER_ACCOUNT_INFORMATION'), 'basic-settings'); ?>
	
	<div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
	</div>   
	
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
			<button type="button" class="wx-button-submit" onclick="window.location.href='index.php?option=com_weever&amp;task=staging'"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_OFF'); ?></button>
            <p style="clear:both; margin:1.5em 1em 0 0;"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_OFF_NOTE'); ?></p></td>
			</tr>
		
		
		<?php else : ?>
		
			
			<tr><td class="key"><?php echo JText::_('WEEVER_TOGGLE_STAGING_MODE'); ?></td>
			<td>
			<button type="button" class="wx-button-submit" onclick="window.location.href='index.php?option=com_weever&amp;task=staging'"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_ON'); ?></button>
            <p style="clear:both; margin:1.5em 1em 0 0;"><?php echo JText::_('WEEVER_STAGING_MODE_TOGGLE_ON_NOTE'); ?></p></td>
			</tr>
			
		<?php endif; ?>
		
		<!--tr><td class="key"><?php echo JText::_('WEEVER_DELETE_STAGING_APP'); ?></td>
		<td>
		<button type="button" id="wx-button-submit" onclick="window.location.href='index.php?option=com_weever&amp;task=stagingdelete'"><?php echo JText::_('WEEVER_STAGING_DELETE_BUTTON'); ?></button>
			<p style="clear:both; margin:1.5em 1em 0 0;"><?php echo JText::_('WEEVER_STAGING_DELETE_NOTE'); ?></p></td>
		</tr-->
	
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