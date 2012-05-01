/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
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

var wx	= wx || {};

/* IE 8 and Camino give errors if a console.log is left in the code */
/* Let's fix that: */

if (typeof console == "undefined") {

    this.console = { log: function() {} };
    
}

/* Call to the CMS */

wx.ajaxCms			= function(params, msgSuccess) { 

	jQuery.ajax({
	
		type: 		"POST",
		url: 		'index.php',
		data: 		params,
		success: 	function(msg) {
		   
			jQuery('#wx-modal-loading-text').html(msg);
			
			if(msg == msgSuccess) {
			
				jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
//				document.location.href = "index.php";
				document.location.reload(true);
				
			}
			else {
			
				jQuery('#wx-modal-secondary-text').html('');
				jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
				
			}
			
	   }
	   
	});	

};

/* Assembles the URL params */

wx.ajaxUrl			= function(a) {

	this.title					= "&name=" + encodeURIComponent( jQuery('#wx-add-title-tab-item').val() );
	this.type 					= "&type=" + a.type;
	this.component				= "&component=" + a.component;
	this.appKey					= "&site_key=" + jQuery("input#wx-site-key").val();
	this.var					= "";
	this.component_behaviour	= "";
	this.published				= "&published=" + a.published;
	this.component_id			= "";
	this.extra					= "";
		
	this.getParams		= function() {
	
		if(this.component_behaviour)
			this.component_behaviour 	= "&component_behaviour=" + encodeURIComponent(this.component_behaviour);
			
		if(this.var) 
			this.var					= "&var=" + encodeURIComponent(this.var);
			
		if(this.component_id)
			this.component_id			= "&component_id=" + this.component_id;
	
		return "option=com_weever&task=ajaxSaveNewTab" + this.title + this.type +
						this.component + this.component_behaviour + this.var + "&weever_action=add" +
					 	this.appKey + this.published + this.component_id + this.extra;			

	}
	
}

/* Prep our Ajax call to the CMS */

wx.ajaxAddTabItem	= function(a) {

	//console.log(a);
	
	var ajaxUrls	= [],
		returned	= 0,
		addAjaxUrl	= function(type, data) {
		
			var newType = new wx.ajaxUrl({ 
			
				type:		type,
				component:	data.component,
				published:	1
				
			});
			
			/* If there's no user-entered title, use the default; e.g., Facebook */
			if( undefined != data.defaultTitle && !( jQuery('#wx-add-title-tab-item').val() ) )
				newType.title = "&name=" + encodeURIComponent( data.defaultTitle );
		 
		 	/* get all the fields we need */
			for( var ii in data.fields ) {

				newType[ii]	= jQuery( data.fields[ ii ] ).val();
				
			}
			
			/* for those where we're just going to set the title as a Twitter handle, etc */
			if( "component_behaviour" == data.defaultTitle )
				newType.title = "&name=" + encodeURIComponent( newType.component_behaviour );
				
			if(data.options) {
			
				for( var ii in data.options ) {
				
					newType.extra += "&" + ii + "=";
				
					if( jQuery('#wx-add-source-option-' + ii ).is(':checked') )
						newType.extra += "1";
					else	
						newType.extra += "0";
				
				}
			
			}
			
			ajaxUrls.push( newType.getParams() );
		
		};
	
	if( a.featureData.types instanceof Array ) {
	
		/* for each type checked */
		for( var i=0; i < a.featureData.types.length; i++ ) {
		
			console.log(a.featureData.types[i]);
		
			if ( jQuery('#wx-add-source-check-' + a.featureData.types[i] + ':checked').length > 0 ) {
			
				addAjaxUrl(a.featureData.types[i], a.featureData);
			
			}
			
		}
	
	} else {

		addAjaxUrl(a.featureData.types, a.featureData);	
	
	}
	
	console.log(ajaxUrls);
	
	for( var i=0; i < ajaxUrls.length; i++ ) {
	
		jQuery.ajax({
		
		   type: 	"POST",
		   url: 	"index.php",
		   data: 	ajaxUrls[i],
		   success: function(msg) {
		   
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     returned++;
		     
		     if( returned == ajaxUrls.length ) {
		     
			     if(msg == "Item Added")
			     {
			     
			     	jQuery('#wx-modal-secondary-text').html('Reloading page..');
			     	//document.location.href = "index.php?option=com_weever#calendarTab";
			     	//Joomla.JText._('WEEVER_JS_APP_UPDATED')
			     	document.location.reload(true);
			     	
			     }
			     else
			     {
			     
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
			     	
			     }
			     
			 }
		     
		   }
		   
		 });
	
	}
	
	//document.location.reload(true);
	
	return;// remove when ready
	
	/* to get: required database fields required from wx.features for a feature; IE:
	
		requiredFields:	[
			
			'cms_feed':		'#wx-input-field',
			'var':			'xyz',
			'rss':			1
			
		];
		
		*/ 
	

		
		wx.ajaxCms( buildParams(), "Item Added" );	

}

/* Confirmation dialog, skipped if we don't ask about a title (wx.features [title] property is undefined) */

wx.confirmAddTabItem	= function(a) {

	var dialogId		= '#wx-add-title-tab-dialog',
		titlebarHtml	= "Confirm";
		
	if( undefined != a.featureData.defaultTitle )
		jQuery('input#wx-add-title-tab-item').val(a.featureData.defaultTitle);
	else
		jQuery('input#wx-add-title-tab-item').val('');
		
	if( undefined != a.featureData.titleUse )
		jQuery('p#wx-add-title-use').html(a.featureData.titleUse);
	else
		jQuery('p#wx-add-title-use').html(
		
			'This title will be just above your content, keep it short so it will fit easily on a small screen.'
		
		);

	jQuery(dialogId).dialog({
		
		modal: 		true, 
		resizable: 	false,
		width: 		'auto',
		height: 	'auto',
		title:		titlebarHtml,
		show:		'fade',
		hide:		'drop',
		buttons: 	wx.setButtonActions({
			
			buttonName:		['Finish', 'Cancel'],
			dialogId:		dialogId,
			backAction:		function() { 
			
				jQuery(a.previousDialog).dialog('open'); 
			
			},
			action:			wx.ajaxAddTabItem, 
			actionArg:		{
			
				previousDialog: 	a.dialogId,
				featureData:		a.featureData
				
			}
			
		}),
		open:		function(e, ui) {
		
			/* click outside dialog to close */
		
			jQuery('.ui-widget-overlay').bind('click', function() { 
			
				jQuery(dialogId).dialog('close');
				
			});
			
		}
			
	}); 		

}

/* object to create a set of buttons, one cancel, one for action */

wx.setButtonActions		= function(a) {

	var buttons		= {};

	if( undefined != a.buttonName[1] ) {
		
		/* action button */
		buttons[ a.buttonName[0] ] = {
			
			id:		'wxui-action',
			text:	a.buttonName[0],
			click:	function() {
			
				jQuery(a.dialogId).dialog( "close" );
	
				a.action(a.actionArg);
				
			}
		
		};
		
		/* cancel button */
		buttons[ a.buttonName[1] ] = function() {
		
			jQuery(a.dialogId).dialog( "close" );
			
			if( isFunction(a.backAction) )
				a.backAction();
		
		};
	
	} 
	else {
	
		/* solo cancel button */
		buttons[ a.buttonName[0] ] = function() {
		
			jQuery(a.dialogId).dialog( "close" );
			
			if( isFunction(a.backAction) )
				a.backAction();
		
		};
	
	}
	
	return buttons;

};

/* Create our dialog, with localization */

wx.localizedConditionalDialog	= function (buttonName, dialogId, backAction, populateOptions) {

	var	type 			= dialogId.replace('#wx-add-', '').replace('-dialog', '').replace(/\-/, '.'),
		subType 		= type.split('.'),
		titlebarHtml	= '',
		featureData,
		parentFeatureData,
		actionArg,
		action,
		getFeatureData	= function() {	
		
			for( var i=0; i < wx.features.length; i++ ) {
			
				if( wx.features[i].id == subType[0] && wx.features[i].items && subType[1] ) {
				
					parentFeatureData = wx.features[i];

					for (var ii=0; ii < wx.features[i].items.length; ii++ ) {
					
						if( wx.features[i].items[ii].id == subType[1] )
							featureData = wx.features[i].items[ii];
					
					}
				
				}
				else if( wx.features[i].id == subType[0] )
					featureData = wx.features[i];
			
			}
			
			if( undefined == featureData ) {
			
				console.log('Failed with type ' + type );
				return;
				
			}
			
			if( undefined != parentFeatureData ) {
			
				titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' src='components/com_weever/assets/icons/nav/" + parentFeatureData.id + ".png' /> " + parentFeatureData.name + ": " + featureData.name;
			
			}
			else
			{
			
				titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' src='components/com_weever/assets/icons/nav/" + featureData.id + ".png' /> " + featureData.name;
			
			}
		
		};
	
	if( subType[1] != 'type' ) {
	
		getFeatureData();
		
		if( true === featureData.title ) 
			action 	= wx.confirmAddTabItem;
		else 
			action	= wx.ajaxAddTabItem;
		
	}	
	else { 
	
		titlebarHtml 	+= "<img class='wx-jquery-dialog-titlebar-icon' src='components/com_weever/assets/icons/nav/" + subType[0] + ".png' /> " + wx.types[ subType[0] ].name;
		
		action 			= function(a) { null; };
	
	}
	
	if( populateOptions == true && jQuery(dialogId + ' > div#wx-added-elems').length == 0 && undefined != featureData.types ) {
	
		var checkboxOptions	= '<div id="wx-added-elems"></div>', // hidden div to detect repetition
			serviceTypes	= featureData.types;
			
		/* if it's a string, convert it */
		if( typeof serviceTypes === "string" ) {
			
			oldString 		= serviceTypes;
			
			serviceTypes	= [];				
			serviceTypes[0] = oldString;
			
		}
		
		if( serviceTypes.length == 1 ) {
		
			if( undefined == featureData.labels )
				checkboxOptions 	+= "<p>" + wx.tabTypes[ serviceTypes[0] ].label.futurePassive;
			else
				checkboxOptions		+= "<p>" + featureData.labels[ serviceTypes[0] ].futurePassive;
		
			checkboxOptions 	+= " in the tab \"" + wx.types[ serviceTypes[0] ].name + "\".</p>";	
			
			if( featureData.options ) {
			
				for( var i in featureData.options ) {
				
					checkboxOptions		+= "<div>"+
									
							"<input type='checkbox' class='wx-add-source-check' id='wx-add-source-option-" + i + "' value='" + i + "' />" +
							
							"<label for='wx-add-source-option-" + i + "'>"+ featureData.options[i] +"</label>" +
			
						"</div>"
				
				}			
			
			}
		
		}
		else
		{
		
			var checked, label, disabled,
				extraClass		= '';

			for( var i=0; i < serviceTypes.length; i++ ) {
			
				if( i == 0 )	
					checked = " checked='checked'";
				else
					checked = 0;
					
				if( undefined == featureData.labels )
					label	= wx.tabTypes[ serviceTypes[i] ].label;
				else
					label	= featureData.labels[ serviceTypes[i] ];
					
				if( wx.types[ serviceTypes[i] ].tier > wx.tabSyncData.results.config.tier ) {
				
					extraClass	= ' wx-add-upgrade';
					disabled	= ' disabled="disabled"';
					
				}
				else 
				{
				
					extraClass	= '';	
					disabled 	= '';
				
				}
					
				checkboxOptions += "<div class='wx-add-source-check-container" + extraClass + "'>" +
				
						"<input type='checkbox' class='wx-add-source-check' id='wx-add-source-check-" +
						 	serviceTypes[i] + "' value='" + serviceTypes[i] + 
						 		"' " + checked + disabled + " />" +
						
						"<label for='wx-add-source-check-" +  serviceTypes[i] + "'>" + label.active + "</label>" +
						
					 	" in the tab \"" + wx.types[ serviceTypes[i] ].name + "\"."+
					 	
				 	"</div>";
			
			}
			
		}
		
		jQuery(dialogId).append( checkboxOptions );
		
	}
	
	jQuery(dialogId).dialog({
		
		modal: 		true, 
		resizable: 	false,
		width: 		'auto',
		height: 	'auto',
		title:		titlebarHtml,
		show:		'fade',
		hide:		'drop',
		buttons: 	wx.setButtonActions({
			
			buttonName:		buttonName,
			dialogId:		dialogId,
			backAction:		backAction,
			action:			action, 
			actionArg:		{
			
				previousDialog: 	dialogId,
				featureData:		featureData
				
			}
			
		}),
		open:		function(e, ui) {
		
			var actionButton = 'div.ui-dialog-buttonset button#wxui-action';
			
			jQuery(actionButton).attr('disabled', 'disabled');
			jQuery(actionButton).removeClass('blue');
			jQuery(actionButton).addClass('white');

			/* click outside dialog to close */
			jQuery('.ui-widget-overlay').bind('click', function() { 
			
				jQuery(dialogId).dialog('close');
				
			});
			
			jQuery( 'input:first-child', jQuery(this) ).blur();
			jQuery('.wx-dialog-input').val('');

		}
			
	}); 		
	

}

/* helper for finding if something is a function */

function isFunction(functionToCheck) {

 	var getType = {};
 	
	return functionToCheck && getType.toString.call(functionToCheck) == '[object Function]';
	
}
