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

jQuery(function() {
	jQuery("#listTabs").tabs( {
		
		select: function(e, ui) {

			var t = String(ui.tab);
			var tpos = strpos(t, '#');
			t = t.substring(tpos + 1);
			tpos = strpos(t, 'Tab');
			t = t.substring(0, tpos);
			
			jQuery('.wx-title').attr('name','noname');
			jQuery('#wx-'+t+'-title').attr('name', 'name');
			jQuery('#wx-select-'+t).val(0).change();
			jQuery('.wx-title').attr('name','noname');
			jQuery('.wx-reveal').hide();
			jQuery('.wx-dummy').hide();
			jQuery('.wx-'+t+'-dummy').show();
		
		}
	
	});

	jQuery("#listTabsSortable").sortable({ 
										axis: "x",
										update: function(event, info) {
															
											var str = String(jQuery(this).sortable('toArray'));
											var siteKey = jQuery("input#wx-site-key").val();
											
											
											jQuery.ajax({
											   type: "POST",
											   url: "index.php",
											   data: "option=com_weever&task=ajaxSaveTabOrder&site_key="+siteKey+"&order="+str,
											   success: function(msg){
											     jQuery('#wx-modal-loading-text').html(msg);
											     
											     if(msg == "Order Updated")
											     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
											     else
											     {
											     	jQuery('#wx-modal-secondary-text').html('');
											     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
											     }
											   }
											 });
															
										}
																					 	
									});

});



jQuery(document).ready(function(){ 


	jQuery('.wx-table-sort').sortable({
	    cursor:     'move',
	    axis:       'y',
	    revert:  	true,
	    forcePlaceholderSize: true,
	    placeholder: 'group_move_placeholder',
	    items: 'tr',
	    update: function(e, ui) {
	        jQuery(this).sortable("refresh");
	        var siteKey = jQuery("input#wx-site-key").val();
	        var str = String(jQuery(this).sortable('toArray'));
	        
	      	jQuery.ajax({
	      	   type: "POST",
	      	   url: "index.php",
	      	   data: "option=com_weever&task=ajaxSaveTabOrder&site_key="+siteKey+"&order="+str,
	      	   success: function(msg){
	      	     jQuery('#wx-modal-loading-text').html(msg);
	      	     
	      	     if(msg == "Order Updated")
	      	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	      	     else
	      	     {
	      	     	jQuery('#wx-modal-secondary-text').html('');
	      	     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
	      	     }
	      	   }
	      	 });
	      	 
	    }
	});
	
	jQuery('.wx-table-sort').disableSelection();

	jQuery("li.wx-nav-tabs").bind("mouseover", function(){
	
		
		
		if(jQuery(this).attr("rel") == "unpublished")
		{
			jQuery("#wx-overlay-drag-img").hide();
			jQuery("#wx-overlay-unpublished").show();
		}
		
		jQuery("#wx-overlay-drag").show();
		
		
	
	});
	
	jQuery("li.wx-nav-tabs").bind("mouseout", function(){
	
		jQuery("#wx-overlay-drag").hide();
		jQuery("#wx-overlay-unpublished").hide();
		jQuery("#wx-overlay-drag-img").show();
	
	});
	

	
	
	jQuery('div.wx-nav-icon').dblclick(function(){
	
		var tabType = jQuery(this).attr('title');
		var siteKey = jQuery("input#wx-site-key").val();
		var txt = 	'<div class="jqimessage">'+
			'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_CHANGING_NAV_ICONS')+'</h3>'+
			Joomla.JText._('WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS')+
			'<div id="wx-nav-icon-preview-wrapper">'+
			'<img id="wx-nav-icon-preview" src="">'+
			'<img src="components/com_weever/assets/icons/no-image.png">'+
			'</div>'+
			'<div id="wx-nav-icon-textarea-wrapper">'+
			'<textarea name="nav_icon" id="wx-nav-icon-textarea" placeholder="'+Joomla.JText._('WEEVER_JS_CHANGING_NAV_PASTE_CODE')+'"></textarea>'+
			'<br/><br/></div></div>';
					
		var clickedElem = jQuery(this);
		
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true)
			{ 
			
				tabIcon = f["nav_icon"];
				
				jQuery.ajax({
				   type: "POST",
				   url: "index.php",
				   data: "option=com_weever&task=ajaxSaveTabIcon&icon="+encodeURIComponent(tabIcon)+"&type="+tabType+'&site_key='+siteKey,
				   success: function(msg){
				     jQuery('#wx-modal-loading-text').html(msg);
				     
				     if(msg == "Icon Saved")
				     {
				     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
				     	clickedElem.html('<img class="wx-nav-icon-img" src="data:image/png;base64,'+tabIcon+'" />');
				     }
				     else
				     {
				     	jQuery('#wx-modal-secondary-text').html('');
				     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
				     }
				   }
				 });
			
			}
			
			
		}	
		
		submitCheck = function(v,m,f){
			
			an = m.children('#wx-nav-icon-textarea');
			
			if(v == "reset")
			{ 
				jQuery("textarea#wx-nav-icon-textarea").val(iconDefault[tabType]);
				setTimeout('previewIcon();', 10);
				return false;
			}
			
		
			if(f.nav_icon == "" && v == true){
				an.css("border","solid #ff0000 1px");
				return false;
			}
			
			return true;
		
		}	
		
		previewIcon = function() {
		
			jQuery("img#wx-nav-icon-preview").attr(
				"src", 
				"data:image/png;base64," + 
					jQuery("textarea#wx-nav-icon-textarea").val()
				);
				
		}
		
				
		var tabIcon = jQuery.prompt(txt, {
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, "Reset to Default": "reset", Submit: true },
				focus: 2
				});	
				
		jQuery("textarea#wx-nav-icon-textarea").bind("paste", function(){
			
			setTimeout('previewIcon();', 10);
			
		});
		
	});
	
	
	jQuery('div.wx-nav-label').dblclick(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var htmlName = jQuery(this).html();
		var txt = 	'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_ENTER_NEW_APP_ICON_NAME')+'</h3>'+
					'<input type="text" id="alertName" name="alertName" value="'+htmlName+'" />';
		var clickedElem = jQuery(this);
		
					
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true)
			{ 
			
				tabName = f["alertName"];
				
				jQuery.ajax({
				   type: "POST",
				   url: "index.php",
				   data: "option=com_weever&task=ajaxSaveTabName&name="+encodeURIComponent(tabName)+"&id="+tabId+'&site_key='+siteKey,
				   success: function(msg){
				     jQuery('#wx-modal-loading-text').html(msg);
				     
				     if(msg == "Tab Changes Saved")
				     {
				     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
				     	clickedElem.html(tabName);
				     }
				     else
				     {
				     	jQuery('#wx-modal-secondary-text').html('');
				     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
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
		
		var tabName = jQuery.prompt(txt, {
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, Submit: true },
				focus: 1
				});
				
		jQuery('input#alertName').select();
		// hit 'enter/return' to save
		jQuery("input#alertName").bind("keypress", function (e) {
		        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		            jQuery('button#jqi_state0_buttonSubmit').click();
		            return false;
		        } else {
		            return true;
		        }
		    });

	});
	


	jQuery('a.wx-subtab-link').click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var htmlName = jQuery(this).html();
		var txt = 	'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_ENTER_NEW_APP_ITEM')+'</h3>'+
					'<input type="text" id="alertName" name="alertName" value="'+htmlName+'" />';
		var clickedElem = jQuery(this);
					
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true)
			{ 
			
				tabName = f["alertName"];
				
				
				jQuery.ajax({
				   type: "POST",
				   url: "index.php",
				   data: "option=com_weever&task=ajaxSaveTabName&name="+encodeURIComponent(tabName)+"&id="+tabId+'&site_key='+siteKey,
				   success: function(msg){
				     jQuery('#wx-modal-loading-text').html(msg);
				     
				     if(msg == "Tab Changes Saved")
				     {
				     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
				     	clickedElem.html(tabName);
				     }
				     else
				     {
				     	jQuery('#wx-modal-secondary-text').html('');
				     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
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
		
		var tabName = jQuery.prompt(txt, {
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, Submit: true },
				focus: 1
				});
				
		jQuery('input#alertName').select();
		// hit 'enter/return' to save
		jQuery("input#alertName").bind("keypress", function (e) {
		        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		            jQuery('button#jqi_state0_buttonSubmit').click();
		            return false;
		        } else {
		            return true;
		        }
		    });

	});
	
	jQuery("a.wx-subtab-publish").click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var clickedElem = jQuery(this);
		var pubStatus = jQuery(this).attr('rel');
		var unpublishedIcon = '<img src="components/com_weever/assets/icons/publish_x.png" border="0" alt="Unpublished">';
		var publishedIcon = '<img src="components/com_weever/assets/icons/tick.png" border="0" alt="Published">';
		
		jQuery.ajax({
		   type: "POST",
		   url: "index.php",
		   data: "option=com_weever&task=ajaxTabPublish&status="+pubStatus+"&id="+tabId+'&site_key='+siteKey,
		   success: function(msg){
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     if(msg == "Item Published" || msg == "Item Unpublished")
		     {
		     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
		     	
		     	if(pubStatus == 1)
		     	{
		     		clickedElem.html(unpublishedIcon);
		     		clickedElem.attr('rel', 0);
		     	}
		     	else
		     	{
		     		clickedElem.html(publishedIcon);
		     		clickedElem.attr('rel', 1);
		     	}
		     }
		     else
		     {
		     	jQuery('#wx-modal-secondary-text').html('');
		     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
		     }

		   }
		 });
	
	});
	
	
		jQuery("a.wx-subtab-delete").click(function() {
		
			var tabId = jQuery(this).attr('title');
			tabId = tabId.substring(4);
			var siteKey = jQuery("input#wx-site-key").val();
			var tabType = jQuery(this).attr('rel');
			var tabName = jQuery(this).attr('alt');
			
			var confDelete = confirm(Joomla.JText._('WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO')+tabName+Joomla.JText._('WEEVER_JS_QUESTION_MARK'));
			
			if(!confDelete)
				return false;
			
			jQuery.ajax({
			   type: "POST",
			   url: "index.php",
			   data: "option=com_weever&task=ajaxSubtabDelete&id="+tabId+'&site_key='+siteKey,
			   success: function(msg){
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     if(msg == "Item Deleted")
			     {
			     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
		     		document.location.href = "index.php?option=com_weever#"+tabType+"Tab";
		     		setTimeout("document.location.reload(true);",20);
			     }
			     else
			     {
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
			     }
	
			   }
			 });
		
		});
	
	
	jQuery("a.wx-subtab-up").click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var tabType = jQuery(this).attr('rel');
	
		jQuery.ajax({
		   type: "POST",
		   url: "index.php",
		   data: "option=com_weever&task=ajaxSaveSubtabOrder&site_key="+siteKey+"&type="+tabType+"&dir=up&id="+tabId,
		   success: function(msg){
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     if(msg == "Order Updated")
		     {
		     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
		     	document.location.href = "index.php?option=com_weever#"+tabType+"Tab";
		     	setTimeout("document.location.reload(true);",20);
		     }
		     else
		     {
		     	jQuery('#wx-modal-secondary-text').html('');
		     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
		     }
		   }
		 });
	
	});
	
	jQuery("a.wx-subtab-down").click(function() {
	
		var tabId = jQuery(this).attr('title');
		tabId = tabId.substring(4);
		var siteKey = jQuery("input#wx-site-key").val();
		var tabType = jQuery(this).attr('rel');
	
		jQuery.ajax({
		   type: "POST",
		   url: "index.php",
		   data: "option=com_weever&task=ajaxSaveSubtabOrder&site_key="+siteKey+"&dir=down&type="+tabType+"&id="+tabId,
		   success: function(msg){
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     if(msg == "Order Updated")
		     {
		     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
		     	document.location.href = "index.php?option=com_weever#"+tabType+"Tab";
		     	setTimeout("document.location.reload(true);",20);
		     }
		     else
		     {
		     	jQuery('#wx-modal-secondary-text').html('');
		     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
		     }
		   }
		 });
	
	});
	
	jQuery('select.wx-cms-feed-select').change(function(){
	
        if(jQuery(this).val() != '' && jQuery('input#wx-blog-title').val() != ''){
           jQuery('#wx-blog-submit').removeAttr('disabled');
        } else { jQuery('#wx-blog-submit').attr('disabled', 'disabled'); }
        
        if(jQuery(this).val() != '' && jQuery('input#wx-page-title').val() != ''){
           jQuery('#wx-page-submit').removeAttr('disabled');
        } else { jQuery('#wx-page-submit').attr('disabled', 'disabled'); }
        
        if(jQuery(this).val() != ''){
           jQuery('#wx-map-submit').removeAttr('disabled');
        } else { jQuery('#wx-map-submit').attr('disabled', 'disabled'); }
        
        if(jQuery(this).val() != ''){
           jQuery('#wx-proximity-submit').removeAttr('disabled');
        } else { jQuery('#wx-proximity-submit').attr('disabled', 'disabled'); }
        
        if(jQuery('input#wx-blog-title' == '')) {
        	var thisText = jQuery("select[name=cms_feed] option:selected").text();
        	jQuery('input#wx-blog-title').val(thisText);
        	jQuery('#wx-blog-submit').removeAttr('disabled');
        }
        
        if(jQuery('input#wx-directory-title' == '')) {
        	var thisText = jQuery("select[name=cms_feed] option:selected").text();
        	jQuery('input#wx-directory-title').val(thisText);
        	jQuery('#wx-directory-submit').removeAttr('disabled');
        }
        
        if(jQuery('input#wx-page-title' == '')) {
        	var thisText = jQuery("select[name=cms_feed] option:selected").text();
        	jQuery('input#wx-page-title').val(thisText);
        	jQuery('#wx-page-submit').removeAttr('disabled');
        }
        
        jQuery('select.wx-cms-feed-select option[value="0"]').attr('disabled','disabled');
        
	});
	
	jQuery('#wx-add-directory-r3s-url-input').change(function(){
	
		jQuery('#wx-directory-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-page-r3s-url-input').change(function(){
	
		jQuery('#wx-page-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-blog-r3s-url-input').change(function(){
	
		jQuery('#wx-blog-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-map-r3s-url-input').keyup(function(){
	
		jQuery('#wx-map-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-panel-r3s-url-input').change(function(){
	
		jQuery('#wx-panel-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-aboutapp-r3s-url-input').change(function(){
	
		jQuery('#wx-aboutapp-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-proximity-r3s-url-input').change(function(){
	
		jQuery('#wx-proximity-submit').removeAttr('disabled');
	
	});
	
	jQuery('#wx-add-contact-joomla-select').change(function(){
		
		var thisText = jQuery("select#wx-add-contact-joomla-select option:selected").text();
		jQuery('input#wx-contact-title').val(thisText);
		jQuery('#wx-contact-submit').removeAttr('disabled');
		
	});
	
	jQuery('select.wx-component-id-select').change(function(){
	
        if(jQuery(this).val() != '' && jQuery('input#wx-contact-title').val() != ''){
           jQuery('#wx-contact-submit').removeAttr('disabled');
        } else { jQuery('#wx-contact-submit').attr('disabled', 'disabled'); }
        
        jQuery('select.wx-component-id-select option[value="0"]').attr('disabled','disabled');
        
	});
	
	jQuery('input.wx-contact-input').keypress(function(){
	
        if(jQuery('input#wx-contact-title').val() != ''){
           jQuery('#wx-contact-submit').removeAttr('disabled');
        } else { jQuery('#wx-contact-submit').attr('disabled', 'disabled'); }
        
	});
	
	jQuery('input.wx-video-input').keyup(function(){
	
        if(jQuery('input#wx-video-url').val() != '' && jQuery('input#wx-video-title').val() != ''){
           jQuery('#wx-video-submit').removeAttr('disabled');
        } else { jQuery('#wx-video-submit').attr('disabled', 'disabled'); }
        
	});
	
	jQuery('input.wx-panel-input').keyup(function(){
	
	    if(jQuery('input#id_name').val() != '' && jQuery('input#wx-panel-title').val() != ''){
	       jQuery('#wx-panel-submit').removeAttr('disabled');
	    } 
	    
	});
	
	
	jQuery('a.map-k2-modal').click(function(){

	       jQuery('#wx-map-submit').removeAttr('disabled');
	    
	});
	
	jQuery('a.map-joomla-modal').click(function(){
	
		   jQuery('#wx-map-submit').removeAttr('disabled');
		    
	});

	jQuery('input.wx-aboutapp-input').keyup(function(){
	
	    if(jQuery('input#id_name').val() != '' && jQuery('input#wx-aboutapp-title').val() != ''){
	       jQuery('#wx-aboutapp-submit').removeAttr('disabled');
	    } 
	    
	});
	
	jQuery('input.wx-social-input').keyup(function(){
	
        if(jQuery('input#wx-social-value').val() != '' && jQuery('input#wx-social-title').val() != ''){
           jQuery('#wx-social-submit').removeAttr('disabled');
        } else { jQuery('#wx-social-submit').attr('disabled', 'disabled'); }
        
	});
	
	jQuery('input.wx-photo-input').keyup(function(){
	
        if(jQuery('input#wx-photo-url').val() != '' && jQuery('input#wx-photo-title').val() != ''){
           jQuery('#wx-photo-submit').removeAttr('disabled');
        } else { jQuery('#wx-photo-submit').attr('disabled', 'disabled'); }
        
	});
	
	jQuery('input.wx-form-input').keyup(function(){
	
	    if(jQuery('input#wx-form-url').val() !='' && jQuery('input#wx-form-title').val() != '' && jQuery('input#wx-form-api-key').val() !=''){
	       jQuery('#wx-form-submit').removeAttr('disabled');
	    } else { jQuery('#wx-form-submit').attr('disabled', 'disabled'); }
	    
	});
	
	
	jQuery('input.wx-calendar-input').keyup(function(){
	
	    if( ( jQuery('input#wx-facebook-calendar-url').val() !='' || jQuery('input#wx-google-calendar-email').val() != '' )  && jQuery('input#wx-calendar-title').val() != ''){
	       jQuery('#wx-calendar-submit').removeAttr('disabled');
	    } else { jQuery('#wx-calendar-submit').attr('disabled', 'disabled'); }
	    
	});
	
	jQuery('input#wx-add-blog-k2-tag-input').keyup(function(){
		
		var thisVal = jQuery('input#wx-add-blog-k2-tag-input').val();
		jQuery('input#wx-blog-title').val(thisVal);
		
		if(thisVal != "")
			jQuery('#wx-blog-submit').removeAttr('disabled');
	});
	
	jQuery('input#wx-add-map-k2-tag-input').keyup(function(){
		
		var thisVal = jQuery('input#wx-add-map-k2-tag-input').val();
		
		if(thisVal != "")
			jQuery('#wx-map-submit').removeAttr('disabled');
	});
	
	jQuery('input#wx-add-proximity-k2-tag-input').keyup(function(){
		
		var thisVal = jQuery('input#wx-add-proximity-k2-tag-input').val();
		
		if(thisVal != "")
			jQuery('#wx-proximity-submit').removeAttr('disabled');
	});
	
	jQuery('input#wx-add-directory-k2-tag-input').keyup(function(){
		
		var thisVal = jQuery('input#wx-add-directory-k2-tag-input').val();
		jQuery('input#wx-directory-title').val(thisVal);
		
		if(thisVal != "")
			jQuery('#wx-directory-submit').removeAttr('disabled');
	});
	
	

});