var wx	= wx || {};

wx.localizedConditionalDialog	= function (buttonName, dialogId, backAction) {

	var	buttons	= {};
	
	// cancel button
	buttons[ buttonName[0] ] = function() {
	
		jQuery(dialogId).dialog( "close" );
		backAction();
	
	}
	
	buttons[ buttonName[1] ] = function() {
	
		jQuery(dialogId).dialog( "close" );
	
	}
	
	jQuery(dialogId).dialog({
		
			modal: true, 
			resizable: false,
			width: 'auto',
			height: 'auto',
			buttons: buttons
			
	}); 		
	

}