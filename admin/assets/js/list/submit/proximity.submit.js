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
	

	jQuery('input#wx-proximity-submit').click(function(e) {

	  	var siteKey = jQuery("input#wx-site-key").val(),
	  		component = jQuery('select#wx-select-proximity').val(),
	  		id, name, cmsFeed, tag, tagQString = '';
	  	
	  	switch(component) {
	  	
	  		case "joomla-category":
	  		
	  			name = jQuery("select[name=cms_feed] option:selected").text();
	  			cmsFeed = jQuery("select[name=cms_feed]").val();
	  			
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
	  			
	  		case "r3s-url":
	  		
	  			name = jQuery("input#wx-proximity-title").val();
	  			cmsFeed = jQuery("input#wx-add-proximity-r3s-url-input").val();
	  			
	  			break;
	  	
	  	}

	  	jQuery.ajax({
	  	   type: "POST",
	  	   url: "index.php",
	  	   data: "option=com_weever&task=ajaxSaveNewTab&name=" + encodeURIComponent(name) + "&type=proximity&component=proximity&weever_action=add&published=1&cms_feed=" + encodeURIComponent(cmsFeed)+"&site_key="+siteKey+tagQString,
	  	   success: function(msg){
	  	     jQuery('#wx-modal-loading-text').html(msg);
	  	     
	  	     if(msg == "Item Added")
	  	     {
	  	     	jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
	  	     	document.location.href = "index.php?option=com_weever#proximityTab";
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
	