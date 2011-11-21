<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.2.2
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

$plugin_html_enabled = "";
$plugin_html_disabled = "";
JHTML::_('behavior.mootools');
JHTML::_('behavior.modal', 'a.popup');
JHTML::_('behavior.tooltip');
jimport('joomla.html.pane');

$document = &JFactory::getDocument();

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery.js' );
$document->addCustomTag ('<script type="text/javascript">jQuery.noConflict();</script>');

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-ui.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-impromptu.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/weever.js' );


	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/theme.js' );

$pane = &JPane::getInstance('tabs');


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
	<div style="position:absolute; right:64px; top:136px; margin:0 1em;">
	<span style="float: right; font-size: 10px;">• Mobile GPS Maps!<br>• Rebrand &amp; Resell<br>• Custom Domains</span>
	<span style="float:right; line-height: 1.25em; font-size: 1em; text-align: right; margin:1px 1.5em 0 0;">Weever Apps Pro &amp; Premium<br><a id="headerbutton" href="http://weeverapps.com/pricing">Learn more</a></span></div>

<?php elseif($this->account->tier_number == 2.1) : ?>
	<span style="font-size: 1.5em; position: absolute; right: 64px; line-height: 1.25em; min-width: 348px; text-align: left; margin: 0pt; top: 136px;"><a href="http://weeverapps.com/pricing" style="float: left; margin: 0pt 1em;" id="headerbutton">Sign Up</a>Enjoying Your Free Trial?<br><span style="font-size: 0.5em; margin: 0pt;">We add powerful new features each month.</span></span>
	
<?php endif; ?>


<span id="wx-admin-topbar-left" class="wx-admin-topbar">
			<a href="http://weeverapps.com/pricing">Plans &amp; Pricing</a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps">Follow us on Twitter</a> &nbsp; | &nbsp; <a href="http://eepurl.com/fP-oD">Newsletter</a>

</span>
    

<div id="wx-admin-topbar-right" class="wx-admin-topbar">

<span <?php echo $offlineStatusClass; ?> id="wx-app-status-button">
    
  <span <?php echo $onlineSpan; ?> id="wx-app-status-online">
	<span id="wx-status-current">Status &mdash; App is</span>
    <span id="wx-status-boldonline"><strong>online</strong></span>
    <span id="wx-status-current">for mobile visitors &mdash;</span>
	<span id="wx-status-takeoffline">Take App Offline</span>
  </span>
    
  <span <?php echo $offlineSpan; ?> id="wx-app-status-offline">
    <span id="wx-status-current">Status &mdash; App is</span>
    <span id="wx-status-boldoffline"><strong>offline</strong></span>
    <span id="wx-status-current">for mobile visitors &mdash;</span>
	<span id="wx-status-turnonline">Turn App Online</span>
  </span>

</span>
</div>


<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>

<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>	
	
	<?php echo $pane->startPane('theme'); ?>
	<?php echo $pane->startPanel(JText::_('WEEVER_BASIC_SETTINGS'), 'basic-settings'); ?>
        
    <div class="wx-submitcontainer">
            <a href="#" onclick="javascript:submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
    </div>    
        		
	
	<fieldset class='adminForm'>
	<legend><?php echo JText::_('WEEVER_THEME_BASIC_SETTINGS'); ?></legend>
	
	<table class="admintable">

	
	<tr>
	<td class="key hasTip" title="<?php echo JText::_('WEEVER_TEMPLATE_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_TEMPLATE_NAME'); ?></td>
	<td>
	<select name="template" class="wx-220-select">
	<option value="sencha" <?php echo ($this->theme->template == 'sencha' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LIGHT_TEMPLATE'); ?></option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td class="key hasTip" title="<?php echo JText::_('WEEVER_TITLEBAR_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_TITLEBAR_SOURCE'); ?></td>
	<td>
	<select name="titlebarSource" class="wx-220-select">
	<option value="text" <?php echo ($this->theme->titlebarSource == 'text' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LOGO_TEXT'); ?> ("<?php echo strip_tags($this->theme->titlebar_title); ?>")</option>
	<option value="image" <?php echo ($this->theme->titlebarSource == 'image' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LOGO_IMAGE'); ?></option>
	<option value="html" <?php echo ($this->theme->titlebarSource == 'html' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_CUSTOM_HTML'); ?></option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td class="key hasTip" title="<?php echo JText::_("WEEVER_TITLEBAR_TITLE_TOOLTIP"); ?>"><?php echo JText::_('WEEVER_TITLEBAR_TITLE'); ?></td>
	<td><input type="text" name="titlebar_title" maxlength="35" style="width:250px;" value="<?php echo htmlentities($this->theme->titlebar_title, ENT_QUOTES, "UTF-8"); ?>" /></td>	
	</tr>
	
	
	<tr><td class="key hasTip" title="<?php echo JText::_("WEEVER_WEB_APP_NAME_TOOLTIP"); ?>"><?php echo JText::_('WEEVER_WEB_APP_NAME'); ?></td>
	<td><input type="text" name="title" maxlength="10" style="width:90px;" value="<?php echo htmlentities($this->theme->title, ENT_QUOTES, "UTF-8"); ?>" /></td>
	</tr>
	
	
	</table>
	
	</fieldset>

	
	<div>
		<fieldset class='adminForm'>
		<legend><?php echo JText::_('WEEVER_IMAGE_SETTINGS'); ?></legend>
		<br/>
		<div class="wx-theme-screen">
		
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TABLET_LAUNCHSCREEN'); ?></div>
                <input type="file" class="wx-theme-input" name="tablet_load_live" size="13" />
		<a href='../media/com_weever/tablet_load_live.png?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 920}}'>
		<img class="wx-theme-image" src="../media/com_weever/tablet_load_live.png?nocache=<?php echo microtime(); ?>" />
		</a>
		</div>
		
		</div>
		
		
		<div class="wx-theme-screen">
		
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN'); ?></div>
                <input type="file" class="wx-theme-input" name="tablet_landscape_load_live" size="13" />
		<a href='../media/com_weever/tablet_landscape_load_live.png?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 920}}'>
		<img class="wx-theme-image" src="../media/com_weever/tablet_landscape_load_live.png?nocache=<?php echo microtime(); ?>" />
		</a>
		</div>
		
		</div>
		
		
		<div class="wx-theme-screen">
		
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN'); ?></div>
                <input type="file" class="wx-theme-input" name="phone_load_live" size="13" />
		<a href='../media/com_weever/phone_load_live.png?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 640}}'>
		<img class="wx-theme-image" src="../media/com_weever/phone_load_live.png?nocache=<?php echo microtime(); ?>" />
		</a>
		</div>
		
		</div>
		
		
		
		<div class="wx-theme-screen">
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_ICON'); ?></div>
                <input type="file" class="wx-theme-input" name="icon_live" size="13" />
		<a href='../media/com_weever/icon_live.png?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 144, y: 144}}'>
		<img class="wx-theme-image" src="../media/com_weever/icon_live.png?nocache=<?php echo microtime(); ?>" />
		</a>
		</div>
		
		</div>
		
		
		<div class="wx-theme-screen">
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_IMAGE'); ?></div>
                <input type="file" class="wx-theme-input" name="titlebar_logo_live" size="13" />
		<a href='../media/com_weever/titlebar_logo_live.png?nocache=<?php echo microtime(); ?>' class='popup' rel='{handler: "iframe", size:  { x: 600, y: 64}}'>
		<img class="wx-theme-image" src="../media/com_weever/titlebar_logo_live.png?nocache=<?php echo microtime(); ?>" />
		</a>
		</div>
		
		</div>
	
		
		
		</fieldset>
		</div>
	
	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->startPanel(JText::_("WEEVER_ADVANCED_LAUNCHSCREEN_SETTINGS"), 'advanced-launch-settings'); ?>
	
	
	<div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
	</div>    
	    		
	
	<div>
	
		<fieldset class='adminForm'>
		<legend><?php echo JText::_('WEEVER_LAUNCHSCREEN_SETTINGS'); ?></legend>
		
		<table class="admintable">
		
		<tr>
		<td class="key hasTip" title="<?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION'); ?></td>
		<td>
		<select name="animation" class="wx-220-select">
		<option value="fade" <?php echo ($this->theme->animation->type == 'fade' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_FADE'); ?></option>
		<option value="pop" <?php echo ($this->theme->animation->type == 'pop' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_POP'); ?></option>
		<option value="slide-left" <?php echo ($this->theme->animation->type == 'slide-left' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_RIGHT'); ?></option>
		<option value="slide-right" <?php echo ($this->theme->animation->type == 'slide-right' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_LEFT'); ?></option>
		<option value="slide-up" <?php echo ($this->theme->animation->type == 'slide-up' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_DOWN'); ?></option>
		<option value="slide-down" <?php echo ($this->theme->animation->type == 'slide-down' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_UP'); ?></option>
		<option value="none" <?php echo ($this->theme->animation->type == 'none' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_NONE'); ?></option>
		</select>
		</td>
		</tr>
	
		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT'); ?></td>
		<td>
		<select name="timeout" class="wx-220-select">
		<option value="1"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_NONE'); ?></option>
		<option value="325" <?php echo ($this->theme->animation->timeout == 325 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_SHORTER'); ?></option>
		<option value="650" <?php echo ($this->theme->animation->timeout == 650 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_NORMAL'); ?></option>
		<option value="995" <?php echo ($this->theme->animation->timeout == 995 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_LONGER'); ?></option>
		</select>
		</td>
		</tr>
		
		
		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION'); ?></td>
		<td>
		<select name="duration" class="wx-220-select">
		<option value="350"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_VERY_SHORT'); ?></option>
		<option value="850" <?php echo ($this->theme->animation->duration == 850 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_SHORTER'); ?></option>
		<option value="1350" <?php echo ($this->theme->animation->duration == 1350 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_NORMAL'); ?></option>
		<option value="1650" <?php echo ($this->theme->animation->duration == 1650 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_LONGER'); ?></option>
		</select>
		</td>
		</tr>		
		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_IOS_INSTALL_PROMPT_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_IOS_INSTALL_PROMPT'); ?></td>
		<td>
		<select name="install_prompt">
		<option value="0"><?php echo JText::_('NO'); ?></option>
		<option value="1" <?php echo ($this->theme->animation->install_prompt ? "selected='selected'":""); ?>><?php echo JText::_('YES'); ?></option>
		</select>
		</td>
		</tr>
		
		
		</table>
		
		
		</fieldset>
	
	
	</div>

	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->startPanel(JText::_("WEEVER_ADVANCED_THEME_SETTINGS"), 'advanced-settings'); ?>
	
	<div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
	</div>    
	    		

<div>
				
	
		<fieldset class='adminForm'><legend><?php echo JText::_('WEEVER_CSS_TEMPLATE_OVERRIDES'); ?></legend>
		
		<div style="margin-left:1em;"><input type="checkbox" class="wx-check" value="1" id="wx-template-overrides" name="useCssOverride" <?php echo ($this->theme->css->useCssOverride == '1' ? "checked='checked'":""); ?> /><label for="wx-template-overrides" class="wx-check-label"><?php echo JText::_('WEEVER_USE_CSS_TEMPLATE_OVERRIDES'); ?></label></div>
		<p><?php echo JText::_('WEEVER_USE_CSS_TEMPLATE_OVERRIDES_DESCRIPTION'); ?></p>
		<table class="admintable">
			

		
		<tr><td class="key"><?php echo JText::_('WEEVER_CSS_OVERRIDES'); ?></td>
		<td>
		<textarea name="css"><?php echo $this->theme->css->css; ?></textarea>
		</td>
		</tr>
	
	
		</table>
		
		</fieldset>
	
		
		
	<fieldset class='adminForm'>
	<legend><?php echo JText::_('WEEVER_TITLEBAR_CUSTOM_HTML'); ?></legend>
	
	<p><?php echo JText::_('WEEVER_TITLEBAR_CUSTOM_HTML_DESCRIPTION'); ?></p>
	<table class="admintable">
	
	<tr>
	<td class="key"><?php echo JText::_('WEEVER_TITLEBAR_CUSTOM_HTML_TEXTAREA_DESCRIPTION'); ?></td>
	<td><textarea name="titlebarHtml" rows="7" cols="50"><? echo htmlspecialchars($this->theme->titlebarHtml); ?></textarea></td>	
	</tr>
	
	</table>
	
	
	</fieldset>
	

	</div>
	
	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->endPane(); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $this->site_key; ?>" />
	<input type="hidden" name="view" value="theme" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>