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

wx.localizedConditionalDialog	= function (buttonName, dialogId, backAction, populateOptions) {

	var	buttons			= {},
		type 			= dialogId.replace('#wx-add-', '').replace('-dialog', '').replace(/\-/, '.'),
		subType 		= type.split('.'),
		titlebarHtml	= '',
		featureData,
		parentFeatureData,
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
	
	/* cancel button */
	buttons[ buttonName[0] ] = function() {
	
		jQuery(dialogId).dialog( "close" );
		
		if( isFunction(backAction) )
			backAction();
	
	}
	
	/* action button */
	if( buttonName[1] != undefined ) {
		
		buttons[ buttonName[1] ] = function() {
		
			jQuery(dialogId).dialog( "close" );
		
		}
	
	}
	
	if( subType[1] != 'type' )
		getFeatureData();
		
	else { 
	
		titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' src='components/com_weever/assets/icons/nav/" + subType[0] + ".png' /> " + wx.types[ subType[0] ].name;
	
	}
	
	if( populateOptions == true && jQuery(dialogId + ' > div#wx-added-elems').length == 0 ) {
	
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
		buttons: 	buttons,
		title:		titlebarHtml,
		show:		'fade',
		hide:		'drop',
		open:		function(e, ui) {
		
			/* click outside dialog to close */
		
			jQuery('.ui-widget-overlay').bind('click', function() { 
			
				jQuery(dialogId).dialog('close');
				
			});
			
		
		}
			
	}); 		
	

}

function isFunction(functionToCheck) {

 	var getType = {};
	return functionToCheck && getType.toString.call(functionToCheck) == '[object Function]';
	
}
