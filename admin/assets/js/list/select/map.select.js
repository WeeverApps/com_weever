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
		
		jQuery('#wx-add-map-k2-category-item').hide();
		jQuery('#wx-add-map-k2-category-item-select').attr('name', 'unnamed');
		jQuery('#wx-add-map-k2-tag').hide();
		jQuery('#wx-add-map-k2-tag-input').attr('name', 'unnamed');
		jQuery('#wx-add-map-r3s-url').hide();
		jQuery('#wx-add-map-r3s-url-input').attr('name', 'unnamed');
		jQuery('#id_id').attr('name', 'unnamed');
		jQuery('#wx-add-map-k2-item').hide();
		
		
		if(jQuery(this).val() == "k2") 
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-map-k2-item').show();
		}
		
		if(jQuery(this).val() == "k2-cat") 
		{
			jQuery('#wx-add-map-k2-category-item').show();
			jQuery('#wx-add-map-k2-category-item-select').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "k2-tags") 
		{
			jQuery('#wx-add-map-k2-tag').show();
			jQuery('#wx-add-map-k2-tag-input').attr('name', 'tag');
		}
		
		if(jQuery(this).val() == "r3s-url")
		{
			jQuery('#wx-add-map-r3s-url').show();
			jQuery('#wx-add-map-r3s-url-input').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "settings")
		{
		
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
	
});