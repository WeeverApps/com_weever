/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
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

jQuery( document ).ready( function() {

	jQuery('.wx-add-source-icon').click(function(e) {
	
		var typeRef 	= jQuery(this).attr('ref'),
			typeRel		= jQuery(this).attr('rel'),
			dialogId,
			buttonNames	= ["Cancel", "Add to App"],
			backAction,
			buttons		= {};
			
		if( jQuery(this).is('.wx-missing-extension') ) {
		
			alert("You must install this extension before you can add it to your app.");
			return;
		
		}
			
		if( jQuery(this).is('.wx-unavailable') ) {
		
			alert("This feature is coming soon! See http://www.weeverapps.com/ for details.");
			return;
		
		} else if( jQuery(this).is('.wx-upgrade-prompt') ) {
			
			dialogId	=  '#wx-upgrade-notice';
			
			wx.localizedConditionalDialog( ["Cancel"], dialogId );
			
			return;
		
		}
		
		backAction		= function() { 
		
			jQuery( "#wx-add-" + typeRel + "-type-dialog" ).dialog('open'); 
		
		}
		
		dialogId = "#wx-" + typeRef + "-dialog";
		
		jQuery('.wx-jquery-dialog').dialog('close');
		
		buttons[ buttonNames[0] ] 		= function() {
		
			jQuery(this).dialog( "close" );
		
		}
		
		if( jQuery(this).hasClass('wx-add-single') ) {
		
			buttons[ buttonNames[1] ] 	= function() {
			
				jQuery(this).dialog( "close" );
			
			}
		
		}
	
		wx.localizedConditionalDialog( ["« Back", "Add to App"], dialogId, backAction );
		
		e.preventDefault();
	
	});	
	
	
	jQuery('div.wx-add-item-icon').click(function() {

		var typeId		= jQuery(this).attr('id'),
			dialogId,
			backAction,
			service		= typeId.split('-')[1];
			
		backAction		= function() { 
		
			jQuery('#wx-add-'+ service +'-dialog').dialog('open'); 
		
		}
		
		jQuery('.wx-jquery-dialog').dialog('close');
		
		dialogId = "#wx-" + typeId + "-dialog";
		
		wx.localizedConditionalDialog( ["« Back", "Add to App"], dialogId, backAction );
		
	});		
	

	jQuery('div.wx-nav-label').dblclick( wx.navLabelDialog );
	jQuery('button.wx-nav-label').click( wx.navLabelDialog );
	
	jQuery('div.wx-nav-icon').dblclick( wx.navIconDialog );
	jQuery('button.wx-nav-icon').click( wx.navIconDialog );
	
	jQuery('button.wx-tab-settings').click( function(e) {
	
		wx.settingsDialog[ jQuery(this).attr('rel') ](e);
		
	});

});