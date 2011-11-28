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



jQuery(document).ready(function(){ 


	jQuery('#wx-modal-loading')
	    .hide()  
	    .ajaxStart(function() {
	    	jQuery('#wx-modal-error-text').html('');
	        jQuery(this).fadeIn(200);
	        jQuery('#wx-modal-loading-text').html(Joomla.JText._('WEEVER_JS_SAVING_CHANGES'));
	        jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_PLEASE_WAIT'));
	    })
	    .ajaxStop(function() {
	    	var jObj = jQuery(this);
	    	setTimeout( function() {
	    			jObj.fadeOut(750);
	    		}, 600 );
	    });
	
	
	jQuery("#wx-theme-select").change(function() {

		var image = jQuery("option:selected", this).attr("rel");
		
		jQuery("#wx-theme-screenshot").attr("src", image);	
		jQuery("#wx-theme-screenshot-link").attr("href", image);
		jQuery("#wx-titlebar-text-save-reminder").show();
	
	
	});
	
	
	jQuery('input#wx-titlebar-text').keyup(function(){
		
		var thisVal = jQuery(this).val();
		jQuery('div#wx-theme-titlebar-text-preview').text(thisVal);
		
		jQuery("#wx-titlebar-text-save-reminder").show();

	});
	
	
	jQuery('input#wx-install-text').keyup(function() {
	
		jQuery("#wx-install-text-save-reminder").show();
	
	});
		
		
	jQuery("#wx-enable-titlebar-text").click(function() {
	
		if( jQuery(this).is(':checked') ) {
			jQuery("#wx-theme-titlebar-logo-options").hide();
			jQuery("#wx-theme-titlebar-logo-preview").hide();
			jQuery("#wx-theme-note-titlebar-text").show();
			jQuery(".wx-titlebar-text-container").show();
			jQuery("#wx-theme-titlebar-text-preview").show();
			jQuery("#wx-titlebar-text-save-reminder").show();
		} else {
			jQuery("#wx-theme-titlebar-logo-options").show();
			jQuery("#wx-theme-titlebar-logo-preview").show();
			jQuery("#wx-theme-note-titlebar-text").hide();
			jQuery(".wx-titlebar-text-container").hide();
			jQuery("#wx-theme-titlebar-text-preview").hide();
			jQuery("#wx-titlebar-text-save-reminder").show();
		}
		
	});

	//
	jQuery("#wx-app-status-button").click(function(e) {
	
		var siteKey = jQuery("input#wx-site-key").val();
	
		if( jQuery("#wx-app-status-online").hasClass("wx-app-hide-status") ) {
			
			
			jQuery.ajax({
			   type: "POST",
			   url: "index.php",
				   data: "option=com_weever&task=ajaxToggleAppStatus&app_enabled=1&site_key="+siteKey,
			   success: function(msg){
			   
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     if(msg == "App Online")
			     {
			     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_ONLINE'));
			     	jQuery("#wx-app-status-online").removeClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-offline").addClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-button").removeClass("wx-app-status-button-offline");
			     }
			     else
			     {
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
			     }
	
			   }
			 });
			
			
		}
		else {
	
			jQuery.ajax({
			   type: "POST",
			   url: "index.php",
			   data: "option=com_weever&task=ajaxToggleAppStatus&app_enabled=0&site_key="+siteKey,
			   success: function(msg){
			   
			     jQuery('#wx-modal-loading-text').html(msg);
			     
			     if(msg == "App Offline")
			     {
			     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_OFFLINE'));
			     	jQuery("#wx-app-status-online").addClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-offline").removeClass("wx-app-hide-status");
			     	jQuery("#wx-app-status-button").addClass("wx-app-status-button-offline");
			     }
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