/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.7
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

jQuery(function() {

	jQuery('div#wx-list-workspace').css({ 'opacity': 1 });

	if( wxComK2 == false ) {
	
		jQuery('.wx-require-extension-com_k2').css({ 'opacity': 0.45  });
		jQuery('.wx-require-extension-com_k2').addClass('wx-missing-extension');
		
	}
		
	if( wxComEasyBlog == false ) {
	
		jQuery('.wx-require-extension-com_easyblog').css({ 'opacity': 0.45 });
		jQuery('.wx-require-extension-com_easyblog').addClass('wx-missing-extension');
		
	}

	jQuery("#listTabs").tabs({
		
		select: 	function(e, ui) {

			var t 		= String(ui.tab),
				tpos 	= strpos(t, '#');
				
			t 		= t.substring(tpos + 1);
			tpos 	= strpos(t, 'Tab');
			t 		= t.substring(0, tpos);
			
			jQuery( '.wx-title' ).attr('name','noname');
			jQuery( '#wx-' + t + '-title' ).attr('name', 'name');
			jQuery( '#wx-select-' + t ).val(0).change();
			jQuery( '.wx-title').attr('name','noname');
			jQuery( '.wx-reveal').hide();
			jQuery( '.wx-dummy').hide();
			jQuery( '.wx-' + t + '-dummy').show();
		
		}
	
	});

	jQuery("#listTabsSortable").sortable({ 
	
		axis: 		"x",
		cancel:		'.wx-nosort',
		update: 	function(event, info) {
							
			var str 	= String(jQuery(this).sortable('toArray')),
				siteKey = jQuery("input#wx-site-key").val();
			
			
			jQuery.ajax({
			
			   type: 		"POST",
			   url: 		"index.php",
			   data: 		"option=com_weever&task=ajaxSaveTabOrder&site_key=" + siteKey + 
			   					"&order=" + str,
			   success: 	function(msg) {
			   
					 jQuery('#wx-modal-loading-text').html(msg);
					 
					 if(msg == "Order Updated")
					 	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
					 	
					 else {
					 
					 	jQuery('#wx-modal-secondary-text').html('');
					 	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					 	
					 }
				 
			   }
			   
			 });
							
		}
													 	
	});

});

wx.navLabelDialog	= function(e) {

	var tabId 		= jQuery(this).attr('ref'),
		siteKey 	= jQuery("input#wx-site-key").val(),
		htmlName 	= jQuery( '#wx-nav-label-' + tabId ).html(),
		clickedElem	= jQuery( '#wx-nav-label-' + tabId ),
		txt 		= '<h3 class="wx-imp-h3">' + 
							Joomla.JText._('WEEVER_JS_ENTER_NEW_APP_ICON_NAME') + 
						'</h3>' +
						'<input type="text" id="alertName" name="alertName" value="' + 
							htmlName + 
						'" />',
		myCallbackForm 	= function(v,m,f) {
		
			if( false == v )
				return;
			
			var tabName 	= f["alertName"];
			
			jQuery.ajax({
			
			   type: 	"POST",
			   url: 	"index.php",
			   data: 	"option=com_weever&task=ajaxSaveTabName&name=" + 
			   				encodeURIComponent( tabName ) + 
			   			"&id=" + tabId + '&site_key=' + siteKey,
			   success: function(msg) {
			   
				 jQuery('#wx-modal-loading-text').html(msg);
				 
				 if(msg == "Tab Changes Saved")
				 {
				 
				 	jQuery('#wx-modal-secondary-text').html( Joomla.JText._('WEEVER_JS_APP_UPDATED') );
				 	clickedElem.html( tabName );
				 	
				 }
				 else
				 {
				 
				 	jQuery('#wx-modal-secondary-text').html('');
				 	jQuery('#wx-modal-error-text').html( Joomla.JText._('WEEVER_JS_SERVER_ERROR') );
				 	
				 }

			   }
			   
			});
		
		},
		submitCheck 	= function(v,m,f) {
			
			var an 	= m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
		
		},
		tabName 		= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
			
		});
			
	jQuery('input#alertName').select();
	
	/* hit 'enter/return' to save */
	
	jQuery("input#alertName").bind("keypress", function (e) {
	
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		
			jQuery('button#jqi_state0_buttonSubmit').click();
			return false;
			
		} else {
		
			return true;
			
		}
			
	});
	
	e.preventDefault();

};


wx.navIconDialog	= function(e) {
	
	var tabType 		= jQuery(this).attr('title'),
		siteKey 		= jQuery("input#wx-site-key").val(),
		txt 			= 	'<div class="jqimessage">'+
						'<h3 class="wx-imp-h3">' + 
							Joomla.JText._('WEEVER_JS_CHANGING_NAV_ICONS') + 
						'</h3>'+
						Joomla.JText._('WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS') +
						'<div id="wx-nav-icon-preview-wrapper">'+
							'<img id="wx-nav-icon-preview" src="">'+
							'<img src="components/com_weever/assets/icons/no-image.png">'+
						'</div>'+
						'<div id="wx-nav-icon-textarea-wrapper">'+
							'<textarea name="nav_icon" id="wx-nav-icon-textarea" placeholder="'+Joomla.JText._('WEEVER_JS_CHANGING_NAV_PASTE_CODE')+'"></textarea>'+
						'<br/><br/></div></div>',
		tabRef			= jQuery(this).attr('ref'),
		tabElem 		= jQuery( '#wx-nav-icon-' + tabRef ),		
		myCallbackForm 	= function(v,m,f) {
	
			if( false == v )
				return;
		
			tabIcon = f["nav_icon"];
			
			jQuery.ajax({
			
			   type: 	"POST",
			   url: 	"index.php",
			   data: 	"option=com_weever&task=ajaxSaveTabIcon&icon=" + 
			   				encodeURIComponent(tabIcon) + 
			   			"&type=" + tabType + '&site_key=' + siteKey,
			   success: function(msg) {
			   
				   jQuery('#wx-modal-loading-text').html(msg);
					 
				   if(msg == "Icon Saved")
				   {
					 
				   		jQuery('#wx-modal-secondary-text').html( Joomla.JText._('WEEVER_JS_APP_UPDATED') );
				   		
					 	tabElem.html(
					 	
					 		'<img class="wx-nav-icon-img" src="data:image/png;base64,' + tabIcon + '" />'
					 	
					 	);
					 	
					}
					else
					{
					 
						jQuery('#wx-modal-secondary-text').html('');
					 	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					 	
					}
				 
			 	}
			   
			});

		},	
		submitCheck 	= function(v,m,f) {
		
			var previewIcon 	= function() {
			
					jQuery("img#wx-nav-icon-preview").attr(
						"src", 
						"data:image/png;base64," + 
							jQuery("textarea#wx-nav-icon-textarea").val()
						);
					
				};
		
			an = m.children('#wx-nav-icon-textarea');
			
			if(v == "reset")
			{ 
				
				jQuery("textarea#wx-nav-icon-textarea").val(iconDefault[tabType]);
				previewIcon();
				
				return false;
				
			}
			
		
			if(f.nav_icon == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
	
		},		
		tabIcon 		= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{ Cancel: false, "Reset to Default": "reset", Submit: true },
			focus: 			2
			
		});	
			
	jQuery("textarea#wx-nav-icon-textarea").bind("paste", function() {

		jQuery("img#wx-nav-icon-preview").attr(
			"src", 
			"data:image/png;base64," + 
				jQuery("textarea#wx-nav-icon-textarea").val()
			);
	
	});
	
	e.preventDefault();
	
};

wx.settingsDialog	= {

	aboutapp:		function(e) {
	
		e.preventDefault();
			
		var panelAnimate 			= jQuery("input#wx-aboutapp-animate").val(),
			panelHeaders 			= jQuery("input#wx-aboutapp-headers").val(),
			panelAnimateDuration 	= jQuery("input#wx-aboutapp-animate-duration").val(),
			timeout 				= jQuery("input#wx-aboutapp-timeout").val(),
			siteKey 				= jQuery("input#wx-site-key").val(),
			tabId 					= jQuery("input#wx-aboutapp-tab-id").val();
		
		if(panelAnimate == "fade") 
			var selected = 'selected="selected"';
		else
			var selected = null;	
		
		if(panelHeaders == "true") 
			var selectedHeader = 'selected="selected"';
		else 
			var selectedHeader = null;	
		
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
	
		myCallbackForm = function(v,m,f) {
		
			if( false == v )
				return;
			
			var animate 		= encodeURIComponent(f["wx-input-aboutapp-animate"]),
				animateDuration = encodeURIComponent(f["wx-input-aboutapp-animate-duration"]),
				timeout 		= encodeURIComponent(f["wx-input-aboutapp-timeout"]),
				headers 		= encodeURIComponent(f["wx-input-aboutapp-headers"]);
			
			jQuery.ajax({
			
				type: 		"POST",
				url: 		"index.php",
				data: 		"option=com_weever&task=ajaxUpdateTabSettings&type=aboutapp&var=" + 
								animate + "," + animateDuration + "," + timeout + "," + headers +
									"&id=" + tabId + '&site_key=' + siteKey,
				success: function(msg) {
				
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
		
		submitCheck = function(v,m,f) {
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
		
		};	
		
		var aniSettings = jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
				
		});
				
		jQuery('input#alertName').select();
	
	},

	panel:	 	function(e) {
	
		e.preventDefault();
			
		var panelAnimate 			= jQuery("input#wx-panel-animate").val(),
			panelAnimateDuration 	= jQuery("input#wx-panel-animate-duration").val(),
			panelHeaders 			= jQuery("input#wx-panel-headers").val(),
			timeout 				= jQuery("input#wx-panel-timeout").val(),
			siteKey 				= jQuery("input#wx-site-key").val(),
			tabId 					= jQuery("input#wx-panel-tab-id").val();
		
		if(panelAnimate == "fade") 
			var selected = 'selected="selected"';
		else
			var selected = null;	
		
		if(panelHeaders == "true") 
			var selectedHeader = 'selected="selected"';
		else 
			var selectedHeader = null;	
		
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
					
		myCallbackForm = function(v,m,f) {
		
			if( false == v )
				return;
	
			var animate 		= encodeURIComponent(f["wx-input-panel-animate"]),
				animateDuration = encodeURIComponent(f["wx-input-panel-animate-duration"]),
				timeout 		= encodeURIComponent(f["wx-input-panel-timeout"]),
				headers 		= encodeURIComponent(f["wx-input-panel-headers"]);
			
			jQuery.ajax({
			
				type: 		"POST",
				url: 		"index.php",
				data: 		"option=com_weever&task=ajaxUpdateTabSettings&type=panel&var=" + 
								animate + "," + animateDuration + "," + timeout + 
								"," + headers + "&id=" + tabId + '&site_key=' + siteKey,
				success: 	function(msg) {
				
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
		
		submitCheck = function(v,m,f){
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
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
	
	},

	map: 	function(e) {
	
		e.preventDefault();
		
		var startLat 		= jQuery("input#wx-map-start-latitude").val(),
			startLong 		= jQuery("input#wx-map-start-longitude").val(),
			startZoom 		= jQuery("input#wx-map-start-zoom").val(),
			marker 			= jQuery("input#wx-map-marker").val(),
			siteKey 		= jQuery("input#wx-site-key").val(),
			tabId 			= jQuery("input#wx-map-tab-id").val();
		
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
					
		myCallbackForm = function(v,m,f) {
		
			if( false == v )
				return;
	
			var startLat 	= encodeURIComponent(f["wx-input-map-start-lat"]),
				startLong 	= encodeURIComponent(f["wx-input-map-start-long"]),
				startZoom 	= encodeURIComponent(f["wx-input-map-start-zoom"]),
				marker 		= encodeURIComponent(f["wx-input-map-marker"]);
			
			jQuery.ajax({
			
				type: 		"POST",
				url: 		"index.php",
				data: 		"option=com_weever&task=ajaxUpdateTabSettings&type=map&var=" + 
								startLat + "," + startLong + "," + startZoom + "," + marker + "&id=" + tabId + '&site_key=' + siteKey,
				success: 	function(msg) {
				
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
		
		submitCheck = function(v,m,f){
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
		
		}		
		
		var mapSettings = jQuery.prompt(txt, {
	
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			width: 			500,
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
	
		});
	
	}
	
};