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
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/fileuploader.js' );

$joomla = comWeeverHelper::joomlaVersion();

if(substr($joomla,0,3) != '1.5')  // ### non-1.5 only
	$jsJoomla = "Joomla.";
else 
	$jsJoomla = "";

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
	
	<?php echo $pane->startPane('theme'); ?>
	<?php echo $pane->startPanel(JText::_('WEEVER_BASIC_SETTINGS'), 'basic-settings'); ?>
        
    <div class="wx-submitcontainer">
            <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
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
		<div class="wx-theme-note"><?php echo JText::_('WEEVER_TABLET_LAUNCHSCREEN_NOTE'); ?><br /><br /><span class="wx-theme-description">This image appears on iPads and Tablets held upright.</span></div>
                <div id="wx-tablet-upload"></div>
		<div class="wx-theme-image-container"><a href='<?php echo $this->theme->images->tablet_load; ?>' class='popup' id="wx-theme-tablet-load-link" rel='{handler: "iframe", size:  { y: 512, x: 374}}'>
		<img class="wx-theme-image" id="wx-theme-tablet-load" src="<?php echo $this->theme->images->tablet_load; ?>" />
		</a></div>
		</div>
		
		</div>
		
		
		<div class="wx-theme-screen">
		
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN'); ?></div>
		<div class="wx-theme-note"><?php echo JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN_NOTE'); ?><br /><br /><span class="wx-theme-description">This image appears on iPads and Tablets held sideways.</span></div>
                <div id="wx-tablet-landscape-upload"></div>
		<div class="wx-theme-image-container"><a href='<?php echo $this->theme->images->tablet_landscape_load; ?>' class='popup' id="wx-theme-tablet-landscape-load-link" rel='{handler: "iframe", size:  { y: 512, x: 374}}'>
		<img class="wx-theme-image" id="wx-theme-tablet-landscape-load" src="<?php echo $this->theme->images->tablet_landscape_load; ?>" />
		</a></div>
		</div>
		
		</div>
		
		
		<div class="wx-theme-screen">
		
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN'); ?></div>
		<div class="wx-theme-note"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN_NOTE'); ?><br /><br /><span class="wx-theme-description">This image appears on smartphones.</span></div>
                <div id="wx-phone-upload"></div>
		<div class="wx-theme-image-container"><a href='<?php echo $this->theme->images->phone_load; ?>' class='popup' id="wx-theme-phone-load-link" rel='{handler: "iframe", size:  { y: 460, x: 320}}'>
		<img class="wx-theme-image" id="wx-theme-phone-load" src="<?php echo $this->theme->images->phone_load; ?>" />
		</a></div>
		</div>
		
		</div>
		
		
		
		<div class="wx-theme-screen">
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_ICON'); ?></div>
		<div class="wx-theme-note"><?php echo JText::_('WEEVER_ICON_NOTE'); ?><br /><br /><span class="wx-theme-description">This icon is used when a visitor saves your app to their device home screen.</span></div>
                <div id="wx-icon-upload"></div>
		<div class="wx-theme-image-container"><a href='<?php echo $this->theme->images->icon; ?>' class='popup' id="wx-theme-icon-link" rel='{handler: "iframe", size:  { x: 144, y: 144}}'>
		<img class="wx-theme-image" id="wx-theme-icon" src="<?php echo $this->theme->images->icon; ?>" />
		</a></div>
		</div>
		
		</div>
		
		
		<div class="wx-theme-screen">
		
		<div>
		<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_IMAGE'); ?></div>
		<div class="wx-theme-note"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_NOTE'); ?><br /><br /><span class="wx-theme-description">Your logo, which will be placed at the top of your app. (Optional)</span></div>
                <div id="wx-titlebar-upload"></div>
		<div class="wx-theme-image-container"><a href='<?php echo $this->theme->images->titlebar_logo; ?>' id="wx-theme-titlebar-logo-link" class='popup' rel='{handler: "iframe", size:  { x: 600, y: 64}}'>
		<img class="wx-theme-image" id="wx-theme-titlebar-logo" src="<?php echo $this->theme->images->titlebar_logo; ?>" />
		</a></div>
		</div>
		
		</div>
	
		
		
		</fieldset>
		</div>
		
	<script>      
	
		function themeUploadTemplate(text) {
			return '<div class="qq-uploader">' + 
		    	'<div class="qq-upload-drop-area"><span>'+text.dropUpload+'</span></div>' +
		        '<div class="qq-upload-button"><img src="components/com_weever/assets/icons/upload.png" style="width:1.125em;height:1.125em;padding-right: 0.625em;vertical-align:-1px;" />'+text.uploadButton+'</div>' +
		        '<ul class="qq-upload-list"></ul>' + 
		     	'</div>';
		};
		
		function fileUploadTemplate() {
			return '<li id="wx-upload-info">' +
		        '<div class="qq-upload-file"></div>' +
		        '<div class="qq-upload-spinner"></div>' +
		        '<div class="qq-upload-size"></div>' +
		        '<button class="qq-upload-cancel"><a href="#"><?php echo JText::_('WEEVER_UPLOAD_CANCEL'); ?></a></button>' +
		        '<div class="qq-upload-failed-text"><?php echo JText::_('WEEVER_UPLOAD_FAILED'); ?></div>' +
		    '</li>';
		}; 
	  
	    function createUploader() {            
	        var tabletUploader = new qq.FileUploader({
	            element: document.getElementById('wx-tablet-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=tablet_load&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP'); ?>'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-tablet-load").attr("src", url);
	            	jQuery("#wx-theme-tablet-load-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            }
	        });   
	        var tabletLandscapeUploader = new qq.FileUploader({
	            element: document.getElementById('wx-tablet-landscape-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=tablet_landscape_load&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP'); ?>'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-tablet-landscape-load").attr("src", url);
	            	jQuery("#wx-theme-tablet-landscape-load-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            }
	        }); 
	        var phoneUploader = new qq.FileUploader({
	            element: document.getElementById('wx-phone-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=phone_load&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP'); ?>'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-phone-load").attr("src", url);
	            	jQuery("#wx-theme-phone-load-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            }
	        });         
	        var iconUploader = new qq.FileUploader({
	            element: document.getElementById('wx-icon-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=icon&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP'); ?>'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-icon").attr("src", url);
	            	jQuery("#wx-theme-icon-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            }
	        }); 
	        var titlebarUploader = new qq.FileUploader({
	            element: document.getElementById('wx-titlebar-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=titlebar_logo&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP'); ?>'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-titlebar-logo").attr("src", url);
	            	jQuery("#wx-theme-titlebar-logo-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            }
	        }); 
	    }

	    window.onload = createUploader;     
	</script>  
	
	<?php echo $pane->endPanel(); ?>
	<?php echo $pane->startPanel(JText::_("WEEVER_ADVANCED_LAUNCHSCREEN_SETTINGS"), 'advanced-launch-settings'); ?>
	
	
	<div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
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
	        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wx-button-submit wx-button-save"><img src="components/com_weever/assets/icons/check.png" style="width:1em;height:1em;padding-right: 0.625em;" /><?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
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
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>