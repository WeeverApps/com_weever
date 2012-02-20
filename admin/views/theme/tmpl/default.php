<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.5.1
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
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/fileuploader.js' );

if(comWeeverHelper::joomlaVersion() != '1.5')  // ### non-1.5 only
{
	$jsJoomla = "Joomla.";
}
else 
{
	$jsJoomla = "";
}

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

$themeDir = "http://weeverapp.com/media/themes/";

if( !strstr($this->devices, 'DetectTierWeeverTablets') && !strstr($this->devices, 'DetectIpad') && !strstr($this->devices, 'DetectAndroidTablet') )
	$noTablet = 1;
else 
	$noTablet = null;
	
if(!$this->theme->images->phone_load)
	$this->theme->images->phone_load = "../images/com_weever/phone_load_live.png";

if(!$this->theme->images->tablet_load)
	$this->theme->images->tablet_load = "../images/com_weever/tablet_load_live.png";
	
if(!$this->theme->images->icon)
	$this->theme->images->icon = "../images/com_weever/icon_live.png";

if(!$this->theme->images->tablet_landscape_load)
	$this->theme->images->tablet_landscape_load = "../images/com_weever/tablet_landscape_load_live.png";
	
if(!$this->theme->images->titlebar_logo)
	$this->theme->images->titlebar_logo = "../images/com_weever/titlebar_logo_live.png";
	
if(!$this->theme->template)
	$this->theme->template = "sencha";
	
if(!$this->theme->title)
	$this->theme->title = "Untitled";

if(comWeeverHelper::isWebKit())
	$dashWebKit = "-webkit";
else 
	$dashWebKit = "";


?>

<?php if($this->account->tier_number == 1) : ?>
	<div class="wx-promotion-basic<?php echo $dashWebKit; ?>">
	<span class="wx-promotion-basic-title"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION'); ?></span>
	<span class="wx-promotion-basic-link"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION_LEARN_MORE'); ?></span></div>

<?php elseif($this->account->tier_number == 2.1) : ?>
	<span class="wx-promotion-trial<?php echo $dashWebKit; ?>"><a href="http://weeverapps.com/pricing" class="wx-promotion-trial-button" id="headerbutton"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BUTTON'); ?></a><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_CALL'); ?><br><span class="wx-promotion-trial-byline"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BYLINE'); ?></span></span>
	
<?php endif; ?>


<span id="wx-admin-topbar-left" class="wx-admin-topbar">
			<a href="http://weeverapps.com/pricing"><?php echo JText::_('WEEVER_PLANS_AND_PRICING'); ?></a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps"><?php echo JText::_('WEEVER_FOLLOW_TWITTER'); ?></a> &nbsp; <!--| &nbsp; <a href="http://www.weeverapps.com/"><?php echo JText::_('WEEVER_NEWSLETTER'); ?></a-->

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

	
		<script>
		
			var weever = weever || {};

			weever.checkTabletImg = function(src) {
			
				var tabletImg = new Image();
				
				tabletImg.onload = function() {
					if(tabletImg.width != 1536 || tabletImg.height != 2008) {
						jQuery("#wx-image-size-tablet").show();
					}
				}
				
				tabletImg.src = src || "<?php echo $this->theme->images->tablet_load; ?>";

			}
			
			weever.checkTabletLandscapeImg = function(src) {
			
				var tabletLandscapeImg = new Image();
			
				tabletLandscapeImg.onload = function() {
					if(tabletLandscapeImg.width != 1496 || tabletLandscapeImg.height != 2048) {
						jQuery("#wx-image-size-tablet-landscape").show();
					}
				}
				
				tabletLandscapeImg.src = src || "<?php echo $this->theme->images->tablet_landscape_load; ?>";
			
			}
			
			weever.checkPhoneImg = function(src) {
			
				var phoneImg = new Image();
			
				phoneImg.onload = function() {
					if(phoneImg.width != 640 || phoneImg.height != 920) {
						jQuery("#wx-image-size-phone").show();
					}
				}
				
				phoneImg.src = src || "<?php echo $this->theme->images->phone_load; ?>";

			}		
			
			
			weever.checkIconImg = function(src) {
			
				var iconImg = new Image();
			
				iconImg.onload = function() {
					if(iconImg.width != 144 || iconImg.height != 144) {
						jQuery("#wx-image-size-icon").show();
					}
				}
				
				iconImg.src = src || "<?php echo $this->theme->images->icon; ?>";
			
			}	
			
			weever.checkTitlebarImg = function(src) {
			
				var titlebarImg = new Image();
			
				titlebarImg.onload = function() {
					if(titlebarImg.width != 600 || titlebarImg.height != 64) {
						jQuery("#wx-image-size-titlebar").show();
					}
				}
				
				titlebarImg.src = src || "<?php echo $this->theme->images->titlebar_logo; ?>";
								
			
			}
			
			
			weever.checkTabletImg();
			weever.checkTabletLandscapeImg();
			weever.checkPhoneImg();
			weever.checkIconImg();
			weever.checkTitlebarImg();
	
		
		</script>
    
    <div class=" wx-theme-float">
    
    	<fieldset class='adminForm wx-theme-fieldset'>
    	
    		<legend><?php echo JText::_('WEEVER_THEME_CHOOSE_THEME'); ?></legend>
    		
    				
    				<div class="wx-theme-titlebar-logo-container">
    				
    					<div id="wx-theme-titlebar-logo-options">
    					<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_IMAGE'); ?></div>
    					
    					<div class="wx-image-size-warning" id="wx-image-size-titlebar"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
    					
    					<?php if($this->theme->titlebarSource == "html") : ?>
    					
    					<div class="wx-notice" id="wx-titlebar-html-notice"><?php echo JText::_('WEEVER_TITLEBAR_HTML_NOTICE'); ?></div>
    					
    					<?php endif; ?>
    					
    					<div class="wx-theme-image-container wx-theme-image-container-titlebar"><a href='<?php echo $this->theme->images->titlebar_logo; ?>' id="wx-theme-titlebar-logo-link" class='popup' rel='{handler: "iframe", size:  { x: 600, y: 64}}'>
    					<img class="wx-theme-titlebar-image " id="wx-theme-titlebar-logo" src="<?php echo $this->theme->images->titlebar_logo; ?>" />
    					</a></div>
    					
    					<div id="wx-titlebar-upload"></div>
    					
    					
    					<div class="wx-theme-note wx-theme-note-titlebar"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_DESCRIPTION'); ?></div>
    			                
    					
    					<div class="wx-theme-note wx-theme-note-titlebar-2"><?php echo JText::_('WEEVER_TITLEBAR_TEXT_HELP'); ?></div>
    					</div>
    					
    					
    					<div class="wx-theme-caption" id="wx-theme-caption-titlebar-text" style="margin-top:1em;"><input id="wx-enable-titlebar-text" type="checkbox" value="1" name="titlebar_title_enabled" <?php echo ($this->theme->titlebarSource == 'text' ? "checked='checked'":""); ?> /> <?php echo JText::_('WEEVER_TITLEBAR_LOGO_TEXT'); ?></div>
    					
    					<div class="wx-theme-note wx-theme-note-titlebar" id="wx-theme-note-titlebar-text"><?php echo JText::_('WEEVER_TITLEBAR_TEXT_DESCRIPTION'); ?></div>
    					
    					<div class="wx-titlebar-text-container"><input type="text" id="wx-titlebar-text" name="titlebar_title" value="<?php echo htmlentities($this->theme->titlebar_title, ENT_QUOTES, "UTF-8"); ?>" /></div>
    					
    					<div id="wx-titlebar-text-save-reminder"><?php echo JText::_('WEEVER_TITLEBAR_TEXT_SAVE_REMINDER'); ?></div>
    					
    				</div>
    				
    				
    				<?php if($this->theme->titlebarSource == 'text') : ?>
    				
    					<script>
							
							jQuery(document).ready(function(){ 
							
							
							jQuery("#wx-theme-titlebar-logo-options").hide();
							jQuery("#wx-theme-titlebar-logo-preview").hide();
							jQuery("#wx-theme-note-titlebar-text").show();
							jQuery(".wx-titlebar-text-container").show();
							jQuery("#wx-theme-titlebar-text-preview").show();
							
							
							});
    					
    					</script>
    		
    				<?php endif; ?>
    		
    		<table class="admintable" id="wx-app-theme-container">
    	
    			
    			<tr>
    			<td>
    			
    			<div id="wx-theme-titlebar-logo-preview-container"><img id="wx-theme-titlebar-logo-preview" src="<?php echo $this->theme->images->titlebar_logo; ?>" /><div id="wx-theme-titlebar-text-preview"><?php echo $this->theme->titlebar_title; ?></div></div>
    			
    			<a id="wx-theme-screenshot-link" class="popup" href="<?php echo $themeDir.$this->theme->template.'.png'; ?>" rel='{handler: "iframe", size:  { x: 340, y: 500}}'><img src="<?php echo $themeDir.$this->theme->template.'.png'; ?>" style="height: 215px;margin-top:-15px !important;" id="wx-theme-screenshot" /></a>
    			
    			</td>
    			<td>
    			<select name="template" id="wx-theme-select" size="12">
    			<option disabled="disabled"><?php echo JText::_('WEEVER_AVAILABLE_THEMES'); ?></option>
    			
    			<?php foreach($this->theme->themes as $k=>$v) :?>
	    		
	    			<option value="<?php echo $v->identifier; ?>" <?php echo ($this->theme->template == $v->identifier ? "selected='selected'":""); ?> rel="<?php echo $themeDir.$v->identifier.'.png'; ?>"><?php echo $v->name; ?></option>
	    			
	    		<?php endforeach; ?>
	    		
    			</select>
    			</td>
    			</tr>
    			<tr><td colspan="2" id="wx-theme-help"><?php echo JText::_('WEEVER_THEME_HELP'); ?></td></tr>
    		
    		</table>
    	</fieldset>
    </div>
    

	<div class=" wx-theme-float-line-2" style="clear:both;">

			<fieldset id="wx-images-fieldset">
			
			<legend><?php echo JText::_('WEEVER_IMAGE_SETTINGS'); ?></legend>
			
			
			<div class="wx-theme-screen">
				

				<div class="wx-theme-caption"><?php echo JText::_('WEEVER_INSTALL_TEXT_AND_ICON'); ?></div>
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_ICON_HELP'); ?></div>
				
				<div class="wx-image-size-warning" id="wx-image-size-icon"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div> 
				
				        <div id="wx-icon-upload"></div>
				        
				       
				        
				<div class="wx-theme-image-container wx-theme-image-container-icon">
					<img class="wx-theme-icon-image" id="wx-theme-icon" src="<?php echo $this->theme->images->icon; ?>" />
				</div>
				<div id="wx-install-text-container"><input type="text" name="title" maxlength="10" id="wx-install-text" value="<?php echo htmlentities($this->theme->title, ENT_QUOTES, "UTF-8"); ?>" /></div>
				
				<div id="wx-install-text-save-reminder"><?php echo JText::_('WEEVER_INSTALL_TEXT_SAVE_REMINDER'); ?></div>

			
			</div>
			
			
			
			<div class="wx-theme-screen">
			
				
	
				<div class="wx-theme-caption"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN'); ?></div>
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN_DESCRIPTION'); ?></div>
				
				<div class="wx-image-size-warning" id="wx-image-size-phone"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
				        <div id="wx-phone-upload"></div>
				<div class="wx-theme-image-container wx-theme-image-container-phone"><a href='<?php echo $this->theme->images->phone_load; ?>' class='popup' id="wx-theme-phone-load-link" rel='{handler: "iframe", size:  { y: 460, x: 320}}'>
				<img class="wx-theme-image" id="wx-theme-phone-load" src="<?php echo $this->theme->images->phone_load; ?>" />
				</a></div>

			</div>
			
			
			<div class="wx-theme-screen <?php echo $noTablet ? 'wx-theme-disable' : ''; ?>">

				<?php echo $noTablet ? "<div class='wx-tablet-warning'>".JText::_('WEEVER_TABLET_DISABLED').'</div>' : '<div class="wx-theme-caption">'.JText::_('WEEVER_TABLET_LAUNCHSCREEN').'</div>'; ?>
				
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_TABLET_LAUNCHSCREEN_DESCRIPTION'); ?></div>
				
				
				<div class="wx-image-size-warning" id="wx-image-size-tablet"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
		                <div id="wx-tablet-upload"></div>
		                
				<div class="wx-theme-image-container wx-theme-image-container-tablet"><a href='<?php echo $this->theme->images->tablet_load; ?>' class='popup' id="wx-theme-tablet-load-link" rel='{handler: "iframe", size:  { y: 512, x: 374}}'>
				<img class="wx-theme-image" id="wx-theme-tablet-load" src="<?php echo $this->theme->images->tablet_load; ?>" />
				</a></div>

			
			</div>
			
			
			<div class="wx-theme-screen <?php echo $noTablet ? 'wx-theme-disable' : ''; ?>">

				
				<?php echo $noTablet ? "<div class='wx-tablet-warning'>".JText::_('WEEVER_TABLET_DISABLED').'</div>' : '<div class="wx-theme-caption">'.JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN').'</div>'; ?>
				
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN_DESCRIPTION'); ?></span><span class="wx-theme-description"></div>
				
				<div class="wx-image-size-warning" id="wx-image-size-tablet-landscape"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
		                <div id="wx-tablet-landscape-upload"></div>
		                
				<div class="wx-theme-image-container wx-theme-image-container-tablet-landscape"><a href='<?php echo $this->theme->images->tablet_landscape_load; ?>' class='popup' id="wx-theme-tablet-landscape-load-link" rel='{handler: "iframe", size: { y: 512, x: 374}}'>
				<img class="wx-theme-image" id="wx-theme-tablet-landscape-load" src="<?php echo $this->theme->images->tablet_landscape_load; ?>" />
				</a></div>

			
			</div>
			
			</fieldset>
	

	
	</div>
	
	<div style="clear:both;"></div>
		
	<script>      
	
		function themeUploadTemplate(text) {
			return '<div class="qq-uploader">' + 
		    	'<div class="qq-upload-drop-area '+text.dropClass+'"><span>'+text.dropUpload+'</span></div>' +
		        '<div class="qq-upload-button"><img src="components/com_weever/assets/icons/upload.png" class="qq-upload-icon" />'+text.uploadButton+'</div>' +
		        '<ul class="qq-upload-list"></ul>' + 
		     	'</div>';
		};
		
		function themeUploadIconTemplate(text) {
			return '<div class="qq-uploader">' + 
		    	'<div class="qq-upload-drop-area '+text.dropClass+'"><span>'+text.dropUpload+'</span></div>' +
		        '<div class="qq-upload-button qq-upload-icon-button"><img src="components/com_weever/assets/icons/upload.png" class="qq-upload-icon" />'+text.uploadButton+'</div>' +
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
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP_TABLET'); ?>',
	            	dropClass: 'qq-upload-drop-tablet'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-tablet-load").attr("src", url);
	            	jQuery("#wx-theme-tablet-load-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            	jQuery("#wx-image-size-tablet").hide();
	            	weever.checkTabletImg(url);
	            }
	        });   
	        var tabletLandscapeUploader = new qq.FileUploader({
	            element: document.getElementById('wx-tablet-landscape-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=tablet_landscape_load&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP_TABLET_LANDSCAPE'); ?>',
	            	dropClass: 'qq-upload-drop-tablet-landscape'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-tablet-landscape-load").attr("src", url);
	            	jQuery("#wx-theme-tablet-landscape-load-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            	jQuery("#wx-image-size-tablet-landscape").hide();
	            	weever.checkTabletLandscapeImg(url);
	            }
	        }); 
	        var phoneUploader = new qq.FileUploader({
	            element: document.getElementById('wx-phone-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=phone_load&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP_PHONE'); ?>',
	            	dropClass: 'qq-upload-drop-phone'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-phone-load").attr("src", url);
	            	jQuery("#wx-theme-phone-load-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            	jQuery("#wx-image-size-phone").hide();
	            	weever.checkPhoneImg(url);
	            }
	        });         
	        var iconUploader = new qq.FileUploader({
	            element: document.getElementById('wx-icon-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=icon&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadIconTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_ICON'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP_ICON'); ?>',
	            	dropClass: 'qq-upload-drop-icon'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-icon").attr("src", url);
	            	jQuery("#wx-theme-icon-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            	jQuery("#wx-image-size-icon").hide();
	            	weever.checkIconImg(url);
	            }
	        }); 
	        var titlebarUploader = new qq.FileUploader({
	            element: document.getElementById('wx-titlebar-upload'),
	            action: 'index.php?option=com_weever&task=upload&type=titlebar_logo&site_key=<?php echo $this->site_key; ?>',
	            template: themeUploadTemplate({
	            	uploadButton: '<?php echo JText::_('WEEVER_UPLOAD_NEW'); ?>',
	            	dropUpload: '<?php echo JText::_('WEEVER_DROP_TITLEBAR'); ?>',
	            	dropClass: 'qq-upload-drop-titlebar'
	            }),
	            fileTemplate: fileUploadTemplate(),
	            debug: true,
	            callback: function(url) {
	            	jQuery("#wx-theme-titlebar-logo").attr("src", url);
	            	jQuery("#wx-theme-titlebar-logo-preview").attr("src", url);
	            	jQuery("#wx-theme-titlebar-logo-link").attr("href", url);
	            	jQuery("#wx-upload-info").remove();
	            	jQuery("#wx-image-size-titlebar").hide();
	            	weever.checkTitlebarImg(url);
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
		
		<!--div style="margin-left:1em;"><input type="checkbox" class="wx-check" value="1" id="wx-template-overrides" name="useCssOverride" <?php echo ($this->theme->css->useCssOverride == '1' ? "checked='checked'":""); ?> /><label for="wx-template-overrides" class="wx-check-label"><?php echo JText::_('WEEVER_USE_CSS_TEMPLATE_OVERRIDES'); ?></label></div>
		<p><?php echo JText::_('WEEVER_USE_CSS_TEMPLATE_OVERRIDES_DESCRIPTION'); ?></p-->
		<table class="admintable">
			

		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_CSS_OVERRIDES_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CSS_OVERRIDES'); ?></td>
		<td>
		<textarea name="css" id="wx-css-overrides"><?php echo $this->theme->css->css; ?></textarea>
		</td>
		</tr>
		
		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_CSS_URL_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CSS_URL'); ?></td>
		<td>
		<input type="text" placeholder="http://" name="css_url" id="wx-css-url" value="<?php echo $this->theme->css->css_url; ?>" />
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
	<td><textarea name="titlebarHtml" rows="7" cols="50"><?php echo htmlspecialchars($this->theme->titlebarHtml); ?></textarea></td>	
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