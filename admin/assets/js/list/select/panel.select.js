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
		jQuery("#id_id.wx-page-input").attr("id", "id_id-page");
		jQuery("#id_name.wx-page-input").attr("id", "id_name-page");
		jQuery("#id_id-panel").attr("id", "id_id");
		jQuery("#id_name-panel").attr("id", "id_name");
		
		jQuery('#wx-add-panel-content-joomla').hide();
		jQuery('#wx-add-panel-r3s-url').hide();
		jQuery('#wx-add-panel-r3s-url-input').attr('name', 'unnamed');
		jQuery('#wx-add-panel-k2-item').hide();
		jQuery('#id_id').attr('name', 'unnamed');
		jQuery('#wx-add-panel-content-input-fields').hide();
		
		//jQuery('select.wx-cms-feed-select option[value="0"]').removeAttr('disabled');
		
		if(jQuery(this).val() == "k2") 
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-panel-content-input-fields').show();
			jQuery('#wx-add-panel-k2-item').show();
			
		}
		
		if(jQuery(this).val() == "content") 
		{
			jQuery('#wx-add-panel-content-input-fields').show();
			jQuery('#wx-add-panel-content-joomla').show();
			jQuery('#id_id').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "r3s-url") 
		{
			jQuery('#wx-add-panel-r3s-url').show();
			jQuery('#wx-add-panel-r3s-url-input').attr('name', 'cms_feed');
		}
		
		
		if(jQuery(this).val() == "settings")
		{
			
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
	
});