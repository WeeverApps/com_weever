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
	
	jQuery('input#wx-directory-submit').click(function(e) {
	  
			var cmsFeed = jQuery("select[name=cms_feed]").val();
		  	var tabName = jQuery('input#wx-directory-title').val();
		  	var tabTag	= jQuery('input[name=tag]').val();
		  	var siteKey = jQuery("input#wx-site-key").val();
		  	
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