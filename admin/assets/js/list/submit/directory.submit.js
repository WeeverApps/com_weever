/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.6
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


	jQuery('input#wx-directory-submit').click(function(e) {
	  
			var cmsFeed = jQuery("select[name=cms_feed]").val();
		  	var tabName = jQuery('input#wx-directory-title').val();
		  	var tabTag	= jQuery('input[name=tag]').val();
		  	var siteKey = jQuery("input#wx-site-key").val();
		  	
		  	if(cmsFeed == undefined) {
		  		cmsFeed = jQuery("input#wx-add-directory-r3s-url-input").val();
		  	}
		  	
		  	jQuery.ajax({
		  	   type: "POST",
		  	   url: "index.php",
		  	   data: "option=com_weever&task=ajaxSaveNewTab&name="+encodeURIComponent(tabName)+"&type=directory&component=directory&tag="+encodeURIComponent(tabTag)+"&weever_action=add&published=1&cms_feed="+encodeURIComponent(cmsFeed)+"&site_key="+siteKey,
		  	   success: function(msg){
		  	     jQuery('#wx-modal-loading-text').html(msg);
		  	     
		  	     if(msg == "Item Added")
		  	     {
		  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
		  	     	document.location.href = "index.php?option=com_weever#directoryTab";
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