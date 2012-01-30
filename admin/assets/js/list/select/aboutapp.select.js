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

jQuery(document).ready(function(){ 
	
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
		
		jQuery('#wx-add-aboutapp-r3s-url').hide();
		jQuery('#wx-add-aboutapp-r3s-url-input').attr('name', 'unnamed');
		jQuery('#wx-add-aboutapp-content-joomla').hide();
		jQuery('#wx-add-aboutapp-k2-item').hide();
		jQuery('#id_id').attr('name', 'unnamed');
		jQuery('#wx-add-aboutapp-content-input-fields').hide();
		
		if(jQuery(this).val() == "k2") 
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-aboutapp-k2-item').show();
			jQuery('#wx-add-aboutapp-content-input-fields').show();			
		}
		
		if(jQuery(this).val() == "content") 
		{	
			jQuery('#wx-add-aboutapp-content-joomla').show();
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-aboutapp-content-input-fields').show();
		}
		
		if(jQuery(this).val() == "r3s-url") 
		{
			jQuery('#wx-add-aboutapp-r3s-url').show();
			jQuery('#wx-add-aboutapp-r3s-url-input').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "settings")
		{
			
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
	
});