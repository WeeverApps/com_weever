var wx	= wx || {};

/* IE 8 and Camino give errors if a console.log is left in the code */
/* Let's fix that: */

if (typeof console == "undefined") {

    this.console = { log: function() {} };
    
}

wx.localizedConditionalDialog	= function (buttonName, dialogId, backAction, populateOptions) {

	var	buttons		= {},
		type 		= dialogId.replace('#wx-add-', '').replace('-dialog', '').replace(/\-/, '.'),
		subType 	= type.split('.'),
		serviceTypes;
	
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
	
	if( populateOptions == true ) {
	
		var radioOptions	= '';
	
		for( var i=0; i < wx.features.length; i++ ) {
		
			if( wx.features[i].id == subType[0] && wx.features[i].items ) {
			
				for (var ii=0; ii < wx.features[i].items.length; ii++ ) {
				
					if( wx.features[i].items[ii].id == subType[1] )
						serviceTypes = wx.features[i].items[ii].types;
				
				}
			
			}
			else if( wx.features[i].id == subType[0] )
				serviceTypes = wx.features[i].types;
		
		}
		
		if( serviceTypes.length == 1 ) {
		
			radioOptions += "<p>This content will be displayed in the " + serviceTypes[0] + " tab.";
		
		}
		else
		{
		
			radioOptions += "<p>3. Select how this content will be displayed in the app</p>";
		
			for( var i=0; i < serviceTypes.length; i++ ) {
			
				radioOptions += "<input type='radio' class='wx-add-source-radio' id='wx-add-source-radio-"+
					i + "' value='" + serviceTypes[i] + "' />" +
					"<label for='wx-add-source-radio-" + i + "'>" + serviceTypes[i] + "</label><br />"
			
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
			buttons: 	buttons
			
	}); 		
	

}

function isFunction(functionToCheck) {

 	var getType = {};
	return functionToCheck && getType.toString.call(functionToCheck) == '[object Function]';
	
}
