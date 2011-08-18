/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.2
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