/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.1
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

jQuery(document).ready(function(){ 


	jQuery('#wx-select-social').change(function() {
		
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-social-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-social').attr('name', 'component');
		jQuery('.wx-social-help').hide();
		jQuery('.wx-social-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		if(jQuery(this).val() == "twitteruser") 
		{
			jQuery('#wx-add-social-twitter-user-help').show();
			jQuery('label#wx-twitter-user').show();
			jQuery('input#wx-social-value').val('@');
			jQuery('input#wx-social-title').val('Twitter');
			jQuery('input#wx-social-value').attr('placeholder', '');
		}
		
		if(jQuery(this).val() == "twitterhashtag") 
		{
			jQuery('#wx-add-social-twitter-hashtag-help').show();
			jQuery('label#wx-twitter-hashtag').show();
			jQuery('input#wx-social-value').val('#');
			jQuery('input#wx-social-title').val('Twitter');
			jQuery('input#wx-social-value').attr('placeholder', '');
		}
		
		if(jQuery(this).val() == "twitterquery") 
		{
			jQuery('#wx-add-social-twitter-query-help').show();
			jQuery('label#wx-twitter-query').show();
			jQuery('input#wx-social-value').val('');
			jQuery('input#wx-social-title').val('Twitter');
			jQuery('input#wx-social-value').attr('placeholder', '');
		}
		
		if(jQuery(this).val() == "identi.ca") 
		{
			jQuery('#wx-add-social-identica-query-help').show();
			jQuery('label#wx-identica-query').show();
			jQuery('input#wx-social-value').val('');
			jQuery('input#wx-social-value').attr('placeholder', '');
			jQuery('input#wx-social-title').val('Identi.ca');
		}
		
		if(jQuery(this).val() == "facebook") 
		{
			jQuery('#wx-add-social-facebook-help').show();
			jQuery('label#wx-facebook-url').show();
			jQuery('input#wx-social-value').val('');
			jQuery('input#wx-social-value').attr('placeholder', 'http://');
			jQuery('input#wx-social-title').val('Facebook');
		}
		
		jQuery('.wx-social-reveal').show();
		
	});
	
	jQuery('#wx-select-calendar').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-calendar-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-calendar').attr('name', 'component');
		jQuery('.wx-calendar-help').hide();
		jQuery('.wx-calendar-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery('.wx-calendar-reveal').show();
		
		if(jQuery(this).val() == "google.calendar") 
		{
			jQuery('label#wx-google-calendar-email-label').show();
			jQuery('label#wx-facebook-calendar-url-label').hide();
			jQuery('div.wx-facebook-calendar-reveal').hide();
			jQuery('div.wx-google-calendar-reveal').show();
			jQuery('input#wx-google-calendar-email').val('');
			jQuery('input#wx-google-calendar-email').attr('placeholder', 'yourname@email.com');
			jQuery('input#wx-calendar-title').val('Google Calendar');
		}
		
		if(jQuery(this).val() == "facebook.events") 
		{
			jQuery('label#wx-facebook-calendar-url-label').show();
			jQuery('label#wx-google-calendar-email-label').hide();
			jQuery('div.wx-google-calendar-reveal').hide();
			jQuery('div.wx-facebook-calendar-reveal').show();
			jQuery('input#wx-facebook-calendar-url').val('');
			jQuery('input#wx-facebook-calendar-url').attr('placeholder', 'http://');
			jQuery('input#wx-calendar-title').val('Facebook Events');
		}
		
	});
	
	
	
	jQuery('#wx-select-form').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-form-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-form').attr('name', 'component');
		jQuery('.wx-form-help').hide();
		jQuery('.wx-form-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery('.wx-form-reveal').show();
		
		if(jQuery(this).val() == "wufoo") 
		{
			jQuery('input#wx-form-url').attr('placeholder', 'http://');
			jQuery('input#wx-form-api-key').attr('placeholder', 'WXYZ-1234-ABCD-9876');
		}
		
	});
	
	
	
	jQuery('#wx-select-photo').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-photo-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-photo').attr('name', 'component');
		jQuery('.wx-photo-help').hide();
		jQuery('.wx-photo-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		if(jQuery(this).val() == "flickr") 
		{
			jQuery('#wx-add-photo-flickr-help').show();
			jQuery('label#wx-flickr-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://');
			jQuery('input#wx-photo-title').val('Flickr Latest');
		}
		
		if(jQuery(this).val() == "flickr.photosets") 
		{
			jQuery('label#wx-flickr-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://');
			jQuery('input#wx-photo-title').val('Flickr');
		}
		
		if(jQuery(this).val() == "foursquare") 
		{
			jQuery('#wx-add-photo-foursquare-help').show();
			jQuery('label#wx-foursquare-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://');
			jQuery('input#wx-photo-title').val('Foursquare');
		}
		
		if(jQuery(this).val() == "google.picasa") 
		{
			jQuery('label#wx-google-picasa-email').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'https://picasa… OR you@gmail.com');
			jQuery('input#wx-photo-title').val('Picasa');
		}
		
		if(jQuery(this).val() == "facebook.photos")
		{
			jQuery('label#wx-facebook-photos-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://facebook.com/yourprofile');
			jQuery('input#wx-photo-title').val('Facebook');		
		}
		
		jQuery('.wx-photo-reveal').show();
		
	});
	
	
	jQuery('#wx-select-video').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-video-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-video').attr('name', 'component');
		jQuery('.wx-video-help').hide();
		jQuery('.wx-video-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');

		if(jQuery(this).val() == "youtube") 
		{
			jQuery('#wx-add-video-youtube-help').show();
			jQuery('label#wx-youtube-url').show();
			jQuery('input#wx-video-url').val('');
			jQuery('input#wx-video-url').attr('placeholder', 'http://');
			jQuery('input#wx-video-title').val('YouTube');
		}
		
		if(jQuery(this).val() == "vimeo") 
		{
			jQuery('#wx-add-video-vimeo-help').show();
			jQuery('label#wx-vimeo-url').show();
			jQuery('input#wx-video-url').val('');
			jQuery('input#wx-video-url').attr('placeholder', 'http://');
			jQuery('input#wx-video-title').val('Vimeo');
		}
		
		
		jQuery('.wx-video-reveal').show();
		
	});
	
	jQuery('#wx-select-page').change(function() {

		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-page-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-page-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		//jQuery('select.wx-cms-feed-select option[value="0"]').removeAttr('disabled');
		
		if(jQuery(this).val() == "menu") 
		{
			jQuery('#wx-add-page-menu-item').show();
			jQuery('#wx-add-page-menu-item-select').attr('name', 'cms_feed');
			jQuery('#wx-add-page-menu-item-help').show();
			jQuery('#wx-add-page-category-joomla').hide();
			jQuery('#wx-add-page-category-joomla-select').attr('name', 'unnamed');
			jQuery('#wx-add-page-category-k2').hide();
			jQuery('#wx-add-page-category-k2-select').attr('name', 'unnamed');
			jQuery('#wx-add-page-tags-k2').hide();
			jQuery('#wx-add-page-tags-k2-select').attr('name', 'unnamed');
		}
		
		if(jQuery(this).val() == "page-cat") 
		{
			jQuery('#wx-add-page-menu-item').hide();
			jQuery('#wx-add-page-menu-item-select').attr('name', 'noname');
			jQuery('#wx-add-page-category-joomla').show();
			jQuery('#wx-add-page-category-joomla-select').attr('name', 'cms_feed');
			jQuery('#wx-add-page-category-joomla-help').show();
			jQuery('#wx-add-page-category-k2').hide();
			jQuery('#wx-add-page-category-k2-select').attr('name', 'unnamed');
			jQuery('#wx-add-page-tags-k2').hide();
			jQuery('#wx-add-page-tags-k2-select').attr('name', 'unnamed');
		}
		
		if(jQuery(this).val() == "page-cat-k2") 
		{
			jQuery('#wx-add-page-menu-item').hide();
			jQuery('#wx-add-page-menu-item-select').attr('name', 'noname');
			jQuery('#wx-add-page-category-joomla').hide();
			jQuery('#wx-add-page-category-joomla-select').attr('name', 'noname');
			jQuery('#wx-add-page-category-k2').show();
			jQuery('#wx-add-page-category-k2-select').attr('name', 'cms_feed');
			jQuery('#wx-add-page-category-k2-help').show();
			jQuery('#wx-add-page-tags-k2').hide();
			jQuery('#wx-add-page-tags-k2-select').attr('name', 'unnamed');
		}
		
		
		jQuery('.wx-page-reveal').show();
		
	});
	
	jQuery('#wx-select-panel').change(function() {

		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-panel-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-panel-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery("#id_id.wx-aboutapp-input").attr("id", "id_id-aboutapp");
		jQuery("#id_name.wx-aboutapp-input").attr("id", "id_name-aboutapp");
		jQuery("#id_id.wx-map-input").attr("id", "id_id-map");
		jQuery("#id_name.wx-map-input").attr("id", "id_name-map");
		jQuery("#id_id-panel").attr("id", "id_id");
		jQuery("#id_name-panel").attr("id", "id_name");
		
		//jQuery('select.wx-cms-feed-select option[value="0"]').removeAttr('disabled');
		
		if(jQuery(this).val() == "k2") 
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-panel-k2-item').show();
			jQuery('#wx-add-panel-content-joomla').hide();
		}
		
		if(jQuery(this).val() == "content") 
		{
			jQuery('#wx-add-panel-k2-item').hide();
			jQuery('#wx-add-panel-content-joomla').show();
			jQuery('#id_id').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "settings")
		{
		
			jQuery('#wx-add-panel-k2-item').hide();
			jQuery('#wx-add-panel-content-joomla').hide();
			
			jQuery(this).val('0');
		
			var panelAnimate = jQuery("input#wx-panel-animate").val(),
				panelAnimateDuration = jQuery("input#wx-panel-animate-duration").val(),
				panelHeaders = jQuery("input#wx-panel-headers").val(),
				timeout = jQuery("input#wx-panel-timeout").val(),
				siteKey = jQuery("input#wx-site-key").val(),
				tabId = jQuery("input#wx-panel-tab-id").val();
			
			if(panelAnimate == "fade") {
				var selected = 'selected="selected"';
			} else {
				var selected = null;	
			}
			
			if(panelHeaders == "true") {
				var selectedHeader = 'selected="selected"';
			} else {
				var selectedHeader = null;	
			}
			
			switch(panelAnimateDuration) {
			
				case "1450": 
					var defaultDuration = 'selected="selected"';
					break;
				case "1925":
					var longDuration = 'selected="selected"';
					break;
				case "725":
					var shortDuration = 'selected="selected"';
					break;
				default:	
					var defaultDuration = 'selected="selected"';
					break;
			}	
			
			switch(timeout) {
			
				case "4500": 
					var shortTimeout = 'selected="selected"';
					break;
				case "7250":
					var defaultTimeout = 'selected="selected"';
					break;
				case "10000":
					var longTimeout = 'selected="selected"';
					break;
				default:	
					var defaultTimeout = 'selected="selected"';
					break;
			}	
			
			var txt = 	'<table class="admintable">'+
						'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_ANIMATIONS')+'</h3>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_TOGGLE')+'</td>'+
						'<td><select name="wx-input-panel-animate"><option value="none">'+
						Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
						'<option value="fade" '+selected+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+'</option></select>'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION')+'</td>'+
						'<td><select name="wx-input-panel-animate-duration"><option value="725" '+shortDuration+'>'+
						Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT')+'</option>'+
						'<option value="1450" '+defaultDuration+'>'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT')+
						'</option>'+
						'<option value="1925" '+longDuration+'>'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_LONG')+
						'</option></select>'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT')+'</td>'+
						'<td><select name="wx-input-panel-timeout"><option value="4500" '+shortTimeout+'>'+
						Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_SHORT')+'</option>'+
						'<option value="7250" '+defaultTimeout+'>'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_DEFAULT')+
						'</option>'+
						'<option value="10000" '+longTimeout+'>'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_LONG')+
						'</option></select>'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_HEADERS_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_PANEL_HEADERS')+'</td>'+
						'<td><select name="wx-input-panel-headers"><option value="false">'+
						Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
						'<option value="true" '+selectedHeader+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+
						'</option></select>'+
						'</td></tr></table>';
						
			var clickedElem = jQuery(this);
						
			myCallbackForm = function(v,m,f) {
			
				if(v != undefined && v == true)
				{ 
				
					var animate = encodeURIComponent(f["wx-input-panel-animate"]),
						animateDuration = encodeURIComponent(f["wx-input-panel-animate-duration"]),
						timeout = encodeURIComponent(f["wx-input-panel-timeout"]),
						headers = encodeURIComponent(f["wx-input-panel-headers"]);
					
					jQuery.ajax({
					   type: "POST",
					   url: "index.php",
					   data: "option=com_weever&task=ajaxUpdateTabSettings&type=panel&var="+animate+","+animateDuration+","+timeout+","+headers+"&id="+tabId+'&site_key='+siteKey,
					   success: function(msg){
					     jQuery('#wx-modal-loading-text').html(msg);
					     
					     if(msg == "Tab Settings Saved")
					     {
					     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
					     	document.location.href = "index.php?option=com_weever#panelTab";
					     	document.location.reload(true);
					     }
					     else
					     {
					     	jQuery('#wx-modal-secondary-text').html('');
					     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					     	document.location.href = "index.php?option=com_weever#panelTab";
					     	document.location.reload(true);
					     }
	
					   }
					 });
				
				}
			}	
			
			submitCheck = function(v,m,f){
				
				an = m.children('#alertName');
			
				if(f.alertName == "" && v == true){
					an.css("border","solid #ff0000 1px");
					return false;
				}
				
				return true;
			
			}		
			
			var aniSettings = jQuery.prompt(txt, {
					callback: myCallbackForm, 
					submit: submitCheck,
					overlayspeed: "fast",
					buttons: {  Cancel: false, Submit: true },
					focus: 1
					});
					
			jQuery('input#alertName').select();

		
		}

		
		jQuery('.wx-panel-reveal').show();
		
	});


	jQuery('#wx-select-map').change(function() {

		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-map-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-panel-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery("#id_id.wx-aboutapp-input").attr("id", "id_id-aboutapp");
		jQuery("#id_name.wx-aboutapp-input").attr("id", "id_name-aboutapp");
		jQuery("#id_id.wx-panel-input").attr("id", "id_id-panel");
		jQuery("#id_name.wx-panel-input").attr("id", "id_name-panel");
		jQuery("#id_id-map").attr("id", "id_id");
		jQuery("#id_name-map").attr("id", "id_name");
		
		//jQuery('select.wx-cms-feed-select option[value="0"]').removeAttr('disabled');
		
		if(jQuery(this).val() == "k2") 
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-map-k2-item').show();
			jQuery('#wx-add-map-k2-category-item').hide();
			jQuery('#wx-add-map-k2-category-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-map-k2-tag').hide();
			jQuery('#wx-add-map-k2-tag-input').attr('name', 'unnamed');

		}
		
		if(jQuery(this).val() == "k2-cat") 
		{
			jQuery('#wx-add-map-k2-item').hide();
			jQuery('#wx-add-map-k2-category-item').show();
			jQuery('#wx-add-map-k2-category-item-select').attr('name', 'cms_feed');
			jQuery('#wx-add-map-k2-tag').hide();
			jQuery('#wx-add-map-k2-tag-input').attr('name', 'unnamed');
		}
		
		if(jQuery(this).val() == "k2-tags") 
		{
			jQuery('#wx-add-map-k2-item').hide();
			jQuery('#wx-add-map-k2-category-item').hide();
			jQuery('#wx-add-map-k2-category-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-map-k2-tag').show();
			jQuery('#wx-add-map-k2-tag-input').attr('name', 'tag');
		}
		
		if(jQuery(this).val() == "settings")
		{
		
			jQuery('#wx-add-map-k2-item').hide();
			jQuery('#wx-add-map-k2-category-item').hide();
			jQuery('#wx-add-map-k2-tag').hide();
		
			jQuery(this).val('0');
			
			var startLat = jQuery("input#wx-map-start-latitude").val(),
				startLong = jQuery("input#wx-map-start-longitude").val(),
				startZoom = jQuery("input#wx-map-start-zoom").val(),
				marker = jQuery("input#wx-map-marker").val(),
				siteKey = jQuery("input#wx-site-key").val(),
				tabId = jQuery("input#wx-map-tab-id").val();
			
			var txt = 	'<table class="admintable">'+
						'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_MAP_SETTINGS')+'</h3>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_LATITUDE_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_MAP_START_LATITUDE')+'</td>'+
						'<td><input type="text" name="wx-input-map-start-lat" value="'+startLat+'" />'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_MAP_START_LONGITUDE')+'</td>'+
						'<td><input type="text" name="wx-input-map-start-long" value="'+startLong+'" />'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM')+'</td>'+
						'<td><input type="text" name="wx-input-map-start-zoom" value="'+startZoom+'" />'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_MAP_DEFAULT_MARKER')+'</td>'+
						'<td><img src="'+marker+'" /><br /><input type="text" name="wx-input-map-marker" value="'+marker+'" />'+
						'</td></tr></table><div>NOTE: If markers must be PNG image sprites that are 128 pixels by 74 pixels. '+
						'The image on the left is the normal state, the one on the right is the selected state; each is 64x74 pixels '+
						'placed beside each other in the same transparent PNG image file.</div>';
						
			var clickedElem = jQuery(this);
						
			myCallbackForm = function(v,m,f) {
			
				if(v != undefined && v == true)
				{ 
				
					var startLat = encodeURIComponent(f["wx-input-map-start-lat"]),
						startLong = encodeURIComponent(f["wx-input-map-start-long"]),
						startZoom = encodeURIComponent(f["wx-input-map-start-zoom"]),
						marker = encodeURIComponent(f["wx-input-map-marker"]);
					
					jQuery.ajax({
					   type: "POST",
					   url: "index.php",
					   data: "option=com_weever&task=ajaxUpdateTabSettings&type=map&var="+startLat+","+startLong+","+startZoom+","+marker+"&id="+tabId+'&site_key='+siteKey,
					   success: function(msg){
					     jQuery('#wx-modal-loading-text').html(msg);
					     
					     if(msg == "Tab Settings Saved")
					     {
					     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
					     	document.location.href = "index.php?option=com_weever#mapTab";
					     	document.location.reload(true);
					     }
					     else
					     {
					     	jQuery('#wx-modal-secondary-text').html('');
					     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					     	document.location.href = "index.php?option=com_weever#mapTab";
					     	document.location.reload(true);
					     }
	
					   }
					 });
				
				}
			}	
			
			submitCheck = function(v,m,f){
				
				an = m.children('#alertName');
			
				if(f.alertName == "" && v == true){
					an.css("border","solid #ff0000 1px");
					return false;
				}
				
				return true;
			
			}		
			
			var mapSettings = jQuery.prompt(txt, {
					callback: myCallbackForm, 
					submit: submitCheck,
					overlayspeed: "fast",
					width: 500,
					buttons: {  Cancel: false, Submit: true },
					focus: 1
					});


		}
		
		jQuery('.wx-map-reveal').show();
		
	});
	
	
	

	jQuery('#wx-select-aboutapp').change(function() {

		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-aboutapp-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-aboutapp-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery("#id_id.wx-panel-input").attr("id", "id_id-panel");
		jQuery("#id_name.wx-panel-input").attr("id", "id_name-panel");
		jQuery("#id_id.wx-map-input").attr("id", "id_id-map");
		jQuery("#id_name.wx-map-input").attr("id", "id_name-map");
		jQuery("#id_id-aboutapp").attr("id", "id_id");
		jQuery("#id_name-aboutapp").attr("id", "id_name");
		//jQuery('select.wx-cms-feed-select option[value="0"]').removeAttr('disabled');
		
		if(jQuery(this).val() == "k2") 
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-aboutapp-k2-item').show();
			jQuery('#wx-add-aboutapp-content-joomla').hide();
		}
		
		if(jQuery(this).val() == "content") 
		{
			jQuery('#wx-add-aboutapp-k2-item').hide();
			jQuery('#wx-add-aboutapp-content-joomla').show();
			jQuery('#id_id').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "settings")
		{
			
			jQuery('#wx-add-aboutapp-k2-item').hide();
			jQuery('#wx-add-aboutapp-k2-item').hide();
			
			jQuery(this).val('0');
				
			var panelAnimate = jQuery("input#wx-aboutapp-animate").val(),
				panelHeaders = jQuery("input#wx-aboutapp-headers").val(),
				panelAnimateDuration = jQuery("input#wx-aboutapp-animate-duration").val(),
				timeout = jQuery("input#wx-aboutapp-timeout").val(),
				siteKey = jQuery("input#wx-site-key").val(),
				tabId = jQuery("input#wx-aboutapp-tab-id").val();
			
			if(panelAnimate == "fade") {
				var selected = 'selected="selected"';
			} else {
				var selected = null;	
			}
			
			if(panelHeaders == "true") {
				var selectedHeader = 'selected="selected"';
			} else {
				var selectedHeader = null;	
			}
					
			switch(panelAnimateDuration) {
			
				case "1450": 
					var defaultDuration = 'selected="selected"';
					break;
				case "1925":
					var longDuration = 'selected="selected"';
					break;
				case "725":
					var shortDuration = 'selected="selected"';
					break;
				default:	
					var defaultDuration = 'selected="selected"';
					break;
			}	
			
			switch(timeout) {
			
				case "4500": 
					var shortTimeout = 'selected="selected"';
					break;
				case "7250":
					var defaultTimeout = 'selected="selected"';
					break;
				case "10000":
					var longTimeout = 'selected="selected"';
					break;
				default:	
					var defaultTimeout = 'selected="selected"';
					break;
			}	
			
			
			var txt = 	'<table class="admintable">'+
						'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_ANIMATIONS')+'</h3>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_TOGGLE')+'</td>'+
						'<td><select name="wx-input-aboutapp-animate"><option value="none">'+
						Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
						'<option value="fade" '+selected+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+'</option></select>'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION')+'</td>'+
						'<td><select name="wx-input-aboutapp-animate-duration"><option value="725" '+shortDuration+'>'+
						Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_SHORT')+'</option>'+
						'<option value="1450" '+defaultDuration+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_DEFAULT')+
						'</option>'+
						'<option value="1925" '+longDuration+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_LONG')+
						'</option></select>'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT')+'</td>'+
						'<td><select name="wx-input-aboutapp-timeout"><option value="4500" '+shortTimeout+'>'+
						Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_SHORT')+'</option>'+
						'<option value="7250" '+defaultTimeout+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_DEFAULT')+
						'</option>'+
						'<option value="10000" '+longTimeout+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_LONG')+
						'</option></select>'+
						'</td></tr>'+
						'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_HEADERS_TOOLTIP')+
						'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_HEADERS')+'</td>'+
						'<td><select name="wx-input-aboutapp-headers"><option value="false">'+
						Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
						'<option value="true" '+selectedHeader+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+
						'</option></select>'+
						'</td></tr></table>';
								
			var clickedElem = jQuery(this);
						
			myCallbackForm = function(v,m,f) {
			
				if(v != undefined && v == true)
				{ 
				
					var animate = encodeURIComponent(f["wx-input-aboutapp-animate"]),
						animateDuration = encodeURIComponent(f["wx-input-aboutapp-animate-duration"]),
						timeout = encodeURIComponent(f["wx-input-aboutapp-timeout"]),
						headers = encodeURIComponent(f["wx-input-aboutapp-headers"]);
				
					
					jQuery.ajax({
					   type: "POST",
					   url: "index.php",
					   data: "option=com_weever&task=ajaxUpdateTabSettings&type=aboutapp&var="+animate+","+animateDuration+","+timeout+","+headers+"&id="+tabId+'&site_key='+siteKey,
					   success: function(msg){
					     jQuery('#wx-modal-loading-text').html(msg);
					     
					     if(msg == "Tab Settings Saved")
					     {
					     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
					     	document.location.href = "index.php?option=com_weever#aboutappTab";
					     	document.location.reload(true);
					     }
					     else
					     {
					     	jQuery('#wx-modal-secondary-text').html('');
					     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					     	document.location.href = "index.php?option=com_weever#aboutappTab";
					     	document.location.reload(true);
					     }
	
					   }
					 });
				
				}
			}	
			
			submitCheck = function(v,m,f){
				
				an = m.children('#alertName');
			
				if(f.alertName == "" && v == true){
					an.css("border","solid #ff0000 1px");
					return false;
				}
				
				return true;
			
			}		
			
			var aniSettings = jQuery.prompt(txt, {
					callback: myCallbackForm, 
					submit: submitCheck,
					overlayspeed: "fast",
					buttons: {  Cancel: false, Submit: true },
					focus: 1
					});
					
			jQuery('input#alertName').select();

	
		
		}
		
		
		jQuery('.wx-aboutapp-reveal').show();
		
	});
	
	
	
	jQuery('#wx-select-blog').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-blog-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-blog-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
	
		if(jQuery(this).val() == "menu") 
		{
			jQuery('#wx-add-blog-menu-item').show();
			jQuery('#wx-add-blog-menu-item-select').attr('name', 'cms_feed');
			jQuery('#wx-add-blog-jcategory-item').hide();
			jQuery('#wx-add-blog-jcategory-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-k2-category-item').hide();
			jQuery('#wx-add-blog-k2-category-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-k2-tag').hide();
			jQuery('#wx-add-blog-k2-tag-input').attr('name', 'unnamed');
		}
		
		if(jQuery(this).val() == "content-cat") 
		{
			jQuery('#wx-add-blog-menu-item').hide();
			jQuery('#wx-add-blog-menu-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-jcategory-item').show();
			jQuery('#wx-add-blog-jcategory-item-select').attr('name', 'cms_feed');
			jQuery('#wx-add-blog-k2-category-item').hide();
			jQuery('#wx-add-blog-k2-category-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-k2-tag').hide();
			jQuery('#wx-add-blog-k2-tag-input').attr('name', 'unnamed');
		}
		
		if(jQuery(this).val() == "k2-cat") 
		{
			jQuery('#wx-add-blog-menu-item').hide();
			jQuery('#wx-add-blog-menu-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-jcategory-item').hide();
			jQuery('#wx-add-blog-jcategory-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-k2-category-item').show();
			jQuery('#wx-add-blog-k2-category-item-select').attr('name', 'cms_feed');
			jQuery('#wx-add-blog-k2-tag').hide();
			jQuery('#wx-add-blog-k2-tag-input').attr('name', 'unnamed');
		}
		
		if(jQuery(this).val() == "k2-tags") 
		{
			jQuery('#wx-add-blog-menu-item').hide();
			jQuery('#wx-add-blog-menu-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-jcategory-item').hide();
			jQuery('#wx-add-blog-jcategory-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-k2-category-item').hide();
			jQuery('#wx-add-blog-k2-category-item-select').attr('name', 'unnamed');
			jQuery('#wx-add-blog-k2-tag').show();
			jQuery('#wx-add-blog-k2-tag-input').attr('name', 'tag');
		}
			
		jQuery('.wx-blog-reveal').show();
		
	});
	
	jQuery('#wx-select-contact').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-contact-title').attr('name','name');
		jQuery('.wx-contact-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		if(jQuery(this).val() == "jcontact") 
		{
			jQuery('#wx-add-contact-joomla').show();
			jQuery('#wx-add-contact-joomla-help').show();
		}
		
		jQuery('.wx-contact-reveal').show();
	});
	
	jQuery('#wx-select-component').change(function() {
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-component-title').attr('name','name');
		jQuery('.wx-component-reveal').show();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
	});

	jQuery('#wx-select-listingcomponent').change(function() {
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-listingcomponent-title').attr('name','name');
		jQuery('.wx-listingcomponent-reveal').show();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
	});

});