var wx	= wx || {};

/* IE 8 and Camino give errors if a console.log is left in the code */
/* Let's fix that: */

if (typeof console == "undefined") {
    this.console = {log: function() {}};
}

wx.localizedConditionalDialog	= function (buttonName, dialogId, backAction) {

	var	buttons	= {};
	
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
