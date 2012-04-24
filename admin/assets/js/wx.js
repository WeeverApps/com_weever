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
			
				if( wx.features[i].id == subType[0] && wx.features[i].items ) {
				
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
			
				titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' style='width:16px;height:16px;' src='components/com_weever/assets/icons/nav/" + parentFeatureData.id + ".png' /> " + parentFeatureData.name + ": " + featureData.name;
			
			}
			else
			{
			
				titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' style='width:16px;height:16px;' src='components/com_weever/assets/icons/nav/" + featureData.id + ".png' /> " + featureData.name;
			
			}
		
		}
	
	// cancel button
	buttons[ buttonName[0] ] = function() {
	
		jQuery(dialogId).dialog( "close" );
		
		if( isFunction(backAction) )
			backAction();
	
	}
	
	if( buttonName[1] != undefined ) {
		
		buttons[ buttonName[1] ] = function() {
		
			jQuery(dialogId).dialog( "close" );
		
		}
	
	}
	
	if( subType[1] != 'type' )
		getFeatureData();
		
	else { 
	
		titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' style='width:16px;height:16px;' src='components/com_weever/assets/icons/nav/" + subType[0] + ".png' /> " + wx.types[ subType[0] ].name;
	
	}
	
	if( populateOptions == true && jQuery(dialogId + ' > input#wx-add-source-title').length == 0 ) {
	
		var radioOptions	= '',
			serviceTypes	= featureData.types;
		
		if( serviceTypes.length == 1 ) {
		
			radioOptions += "<p>This content will be displayed in the " + serviceTypes[0] + " tab.";
		
		}
		else
		{
		
			var checked;
		
			radioOptions += "<p>3. Select how this content will be displayed in the app</p>";
		
			for( var i=0; i < serviceTypes.length; i++ ) {
			
				if( i == 0 )	
					checked = " checked='checked'";
				else
					checked = 0;
					
				radioOptions += "<input type='checkbox' class='wx-add-source-radio' id='wx-add-source-radio-"+
					 serviceTypes[i] + "' value='" + serviceTypes[i] + "' " + checked + " />" +
					"<label for='wx-add-source-radio-" +  serviceTypes[i] + "'>" + serviceTypes[i] + "</label><br />"
			
			}
			
		}
	
		jQuery(dialogId).append(
		
			"<p>2. Name this category</p>" +
			
			"<input type='text' id='wx-add-source-title' value='' class='wx-title wx-input wx-blog-input' name='sourcetitle' />" + 
			
			radioOptions
		
		);
		
	}
	
	jQuery(dialogId).dialog({
		
		modal: 		true, 
		resizable: 	false,
		width: 		'auto',
		height: 	'auto',
		buttons: 	buttons,
		title:		titlebarHtml
			
	}); 		
	

}

function isFunction(functionToCheck) {

 	var getType = {};
	return functionToCheck && getType.toString.call(functionToCheck) == '[object Function]';
	
}
