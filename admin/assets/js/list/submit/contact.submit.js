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

});