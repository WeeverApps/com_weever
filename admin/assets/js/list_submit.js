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


	jQuery('button#wx-aboutapp-button').click(function(e) {
	
		e.preventDefault();
	
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
		// hit 'enter/return' to save
		/*jQuery("input#alertName").bind("keypress", function (e) {
		        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		            jQuery('button#jqi_state0_buttonSubmit').click();
		            return false;
		        } else {
		            return true;
		        }
		    });*/
	
	});

	jQuery('button#wx-panel-button').click(function(e) {
	
		e.preventDefault();
	
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
		// hit 'enter/return' to save
		/*jQuery("input#alertName").bind("keypress", function (e) {
		        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		            jQuery('button#jqi_state0_buttonSubmit').click();
		            return false;
		        } else {
		            return true;
		        }
		    });*/
	
	});
	
	
	jQuery('button#wx-map-button').click(function(e) {
	
		e.preventDefault();
	
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
					'</td></tr></table>';
					
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
	
	});
	

	jQuery('input#wx-contact-submit').click(function(e) {
	  
		var componentId = jQuery("select[name=component_id]").val();
		var tabName = jQuery('input#wx-contact-title').val();
		var siteKey = jQuery("input#wx-site-key").val();
		
		var emailForm;
		
		if(jQuery("input[name=emailform]").is(":checked"))
			emailForm = jQuery("input[name=emailform]").val();
		else
			emailForm = 0;
			
		var googleMaps;
		
		if(jQuery("input[name=googlemaps]").is(":checked"))
			googleMaps = jQuery("input[name=googlemaps]").val();
		else
			googleMaps = 0;
		
		var showImage;
		
		if(jQuery("input[name=showimage]").is(":checked"))
			showImage = jQuery("input[name=showimage]").val();
		else
			showImage = 0;
			
		jQuery.ajax({
		 type: "POST",
		 url: "index.php",
		 data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=contact&emailform="+emailForm+"&googlemaps="+googleMaps+"&showimage="+showImage+"&component=contact&component_id="+componentId+"&weever_action=add&published=1&site_key="+siteKey,
		 success: function(msg){
		   jQuery('#wx-modal-loading-text').html(msg);
		   
		   if(msg == "Item Added")
		   {
		   	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
		   	document.location.href = "index.php?option=com_weever#contactTab";
		   	document.location.reload(true);
		   }
		   else
		   {
		   	jQuery('#wx-modal-secondary-text').html('');
		   	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
		   }
		 }
		});
		
		e.preventDefault();
	});
	
	jQuery('input#wx-aboutapp-submit').click(function(e) {

	  	var cmsFeed;
	  	var id = jQuery("#id_id").val();
	  	var component = jQuery('select#wx-select-aboutapp').val();
	  	var siteKey = jQuery("input#wx-site-key").val();
	  	var tabName = jQuery('input#wx-aboutapp-title').val();
	  	
	  	if(component == "k2") {
	  		cmsFeed = "index.php?option=com_k2&view=item&id="+id;
	  	}
	  	else {
	  		cmsFeed = "index.php?opton=com_content&view=article&id="+id;
	  	}
	  	
	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=aboutapp&component=aboutapp&weever_action=add&published=1&cms_feed="+encodeURIComponent(cmsFeed)+"&site_key="+siteKey,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#aboutappTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     	//document.location.href = "index.php?option=com_weever#photoTab";
	  	     	//document.location.reload(true);
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	});


	jQuery('input#wx-panel-submit').click(function(e) {

	  	var cmsFeed;
	  	var id = jQuery("#id_id").val();
	  	var component = jQuery('select#wx-select-panel').val();
	  	var siteKey = jQuery("input#wx-site-key").val();
	  	var tabName = jQuery('input#wx-panel-title').val();
	  	
	  	if(component == "k2") {
	  		cmsFeed = "index.php?option=com_k2&view=item&id="+id;
	  	} else {
	  		cmsFeed = "index.php?opton=com_content&view=article&id="+id;
	  	}
	  	
	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=panel&component=panel&weever_action=add&published=1&cms_feed="+encodeURIComponent(cmsFeed)+"&site_key="+siteKey,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#panelTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	});

	
	jQuery('input#wx-map-submit').click(function(e) {

	  	var siteKey = jQuery("input#wx-site-key").val(),
	  		component = jQuery('select#wx-select-map').val(),
	  		id, name, cmsFeed, tag, tagQString = '';
	  	
	  	switch(component) {
	  	
	  		case "k2":
	  		
	  			id = jQuery("#id_id").val()
	  			name = jQuery("#id_name").val()
	  			cmsFeed = "index.php?option=com_k2&view=item&id="+id+"&template=weever_cartographer";
	  			
	  			break;
	  		
	  		case "k2-cat":
	  		
	  			name = jQuery("select[name=cms_feed] option:selected").text();
	  			cmsFeed = jQuery("select[name=cms_feed]").val();
	  			
	  			break;
	  		
	  		case "k2-tags":
	  		
	  			tag	= jQuery('input[name=tag]').val();
	  			name = "Tag: "+tag;
	  			tagQString = "&tag="+encodeURIComponent(tag);
	  			
	  			break;
	  	
	  	}

	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name=" + encodeURIComponent(name) + "&type=map&component=map&weever_action=add&published=1&cms_feed=" + encodeURIComponent(cmsFeed)+"&site_key="+siteKey+tagQString,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#mapTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	});
	
	
	jQuery('input#wx-page-submit').click(function(e) {
  
	  	var cmsFeed = jQuery("select[name=cms_feed]").val();
	  	var tabName = jQuery('input#wx-page-title').val();
	  	var siteKey = jQuery("input#wx-site-key").val();
	  	
	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=page&component=page&component_behaviour=leaf&weever_action=add&published=1&cms_feed="+encodeURIComponent(cmsFeed)+"&site_key="+siteKey,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#pageTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     	//document.location.href = "index.php?option=com_weever#photoTab";
	  	     	//document.location.reload(true);
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	});
	
	jQuery('input#wx-blog-submit').click(function(e) {
	  
  		var cmsFeed = jQuery("select[name=cms_feed]").val();
  	  	var tabName = jQuery('input#wx-blog-title').val();
  	  	var tabTag	= jQuery('input[name=tag]').val();
  	  	var siteKey = jQuery("input#wx-site-key").val();
  	  	
  	  	jQuery.ajax({
  	  	   type: "POST",
  	  	   url: "index.php",
  	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=blog&component=blog&tag="+encodeURIComponent(tabTag)+"&weever_action=add&published=1&cms_feed="+encodeURIComponent(cmsFeed)+"&site_key="+siteKey,
  	  	   success: function(msg){
  	  	     jQuery('#wx-modal-loading-text').html(msg);
  	  	     
  	  	     if(msg == "Item Added")
  	  	     {
  	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
  	  	     	document.location.href = "index.php?option=com_weever#blogTab";
  	  	     	document.location.reload(true);
  	  	     }
  	  	     else
  	  	     {
  	  	     	jQuery('#wx-modal-secondary-text').html('');
  	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
  	  	     }
  	  	   }
  	  	 });
  	  	 
  	  	 e.preventDefault();
	});
	
	jQuery('input#wx-video-submit').click(function(e) {
	  
 		var tabUrl = jQuery('#wx-video-url').val();
  	  	var tabName = jQuery('input#wx-video-title').val();
  	  	var siteKey = jQuery("input#wx-site-key").val();
  	  	var component = jQuery("select#wx-select-video").val();
  
  	  	
  	  	jQuery.ajax({
  	  	   type: "POST",
  	  	   url: "index.php",
  	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=video&weever_action=add&published=1&component="+component+"&component_behaviour="+encodeURIComponent(tabUrl)+"&site_key="+siteKey,
  	  	   success: function(msg){
  	  	     jQuery('#wx-modal-loading-text').html(msg);
  	  	     
  	  	     if(msg == "Item Added")
  	  	     {
  	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
  	  	     	document.location.href = "index.php?option=com_weever#videoTab";
  	  	     	document.location.reload(true);
  	  	     }
  	  	     else
  	  	     {
  	  	     	jQuery('#wx-modal-secondary-text').html('');
  	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
  	  	     }
  	  	   }
  	  	 });
  	  	 
  	  	 e.preventDefault();
	});
	
	jQuery('input#wx-social-submit').click(function(e) {
	  
  		var query = jQuery('#wx-social-value').val();
  	  	var tabName = jQuery('input#wx-social-title').val();
  	  	var siteKey = jQuery("input#wx-site-key").val();
  	  	var component = jQuery("select#wx-select-social").val();
  
  	  	
  	  	jQuery.ajax({
  	  	   type: "POST",
  	  	   url: "index.php",
  	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=social&weever_action=add&published=1&component="+component+"&component_behaviour="+encodeURIComponent(query)+"&site_key="+siteKey,
  	  	   success: function(msg){
  	  	     jQuery('#wx-modal-loading-text').html(msg);
  	  	     
  	  	     if(msg == "Item Added")
  	  	     {
  	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
  	  	     	document.location.href = "index.php?option=com_weever#socialTab";
  	  	     	document.location.reload(true);
  	  	     }
  	  	     else
  	  	     {
  	  	     	jQuery('#wx-modal-secondary-text').html('');
  	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
  	  	     }
  	  	   }
  	  	 });
  	  	 
  	  	 e.preventDefault();
	});
	
	jQuery('input#wx-photo-submit').click(function(e) {
	  

	  	var tabUrl = jQuery('#wx-photo-url').val();
	  	var tabName = jQuery('input#wx-photo-title').val();
	  	var siteKey = jQuery("input#wx-site-key").val();
	  	var component = jQuery("select#wx-select-photo").val();

	  	
	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=photo&weever_action=add&published=1&component="+component+"&component_behaviour="+encodeURIComponent(tabUrl)+"&site_key="+siteKey,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#photoTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	  	
	});
	
	
	jQuery('input#wx-calendar-submit').click(function(e) {
	  
	  	var tabEmail = jQuery('#wx-google-calendar-email').val();
	  	var tabUrl = jQuery('#wx-facebook-calendar-url').val();
	  	var tabName = jQuery('input#wx-calendar-title').val();
	  	var siteKey = jQuery("input#wx-site-key").val();
	  	var timezone = jQuery("#wx-select-facebook-timezone-time").val();
	  	var component = jQuery("select#wx-select-calendar").val();
	  	var componentBehaviour = null;
	  	
	  	if(component == "google.calendar") {
	  		componentBehaviour = tabEmail;
	  	} else {
	  		componentBehaviour = tabUrl;
	  	}
	  	
	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=calendar&weever_action=add&published=1&component="+component+"&component_behaviour="+encodeURIComponent(componentBehaviour)+"&site_key="+siteKey+"&var="+timezone,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#calendarTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	  	
	});
	
	
	jQuery('input#wx-form-submit').click(function(e) {
	  
	  	var tabUrl = jQuery('#wx-form-url').val();
	  	var APIKey = jQuery('#wx-form-api-key').val();
	  	var tabName = jQuery('input#wx-form-title').val();
	  	var siteKey = jQuery("input#wx-site-key").val();
	  	var component = jQuery("select#wx-select-form").val();
	  	
	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=form&weever_action=add&published=1&component="+component+"&component_behaviour="+encodeURIComponent(tabUrl)+"&site_key="+siteKey+"&var="+APIKey,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#formTab";
	  	     	document.location.reload(true);
	  	     }
	  	     else
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html('');
	  	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	  	     }
	  	   }
	  	 });
	  	 
	  	 e.preventDefault();
	  	
	});

});