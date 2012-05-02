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

/* builds the jQuery UI + SwipeJS Pages system using settings from /config */

jQuery(document).ready( function() { 

	wx.build = function() {
	
		var pushItemTypes = function(oldTypes, newTypes) {
		
			if( oldTypes == undefined )		
				return newTypes;
	
			var checkOldItemTypes = function(checkType) {
			
				if( !(oldTypes instanceof Array) ) {
				
					if( oldTypes == checkType )
						return true;
						
					return false;
				
				}
					
				for ( var i=0; i < oldTypes.length; i++ ) {
				
					var type = oldTypes[i];
					
					if( type == checkType )
						return true;
	
				}	
				
				return false;
			
			}
		
			if( !(newTypes instanceof Array) ) {
			
				if( checkOldItemTypes(newTypes) === true )
					return oldTypes;
				else {
				
					if( !(oldTypes instanceof Array) )
						oldTypes = [ oldTypes ];
						
					oldTypes.push( newTypes );
					
					return oldTypes;
				
				} 
					
			
			}
				
			for( var i=0; i < newTypes.length; i++ ) {
			
				var type = newTypes[i];		
				
				if( checkOldItemTypes(type) === true ) 
					continue;
					
				if( !(oldTypes instanceof Array) )
					oldTypes = [ oldTypes ];
					
				oldTypes.push( type );
					
			} 
			
			return oldTypes;
		
		}
		
		var pushSubItemTypes 	= function(item, extraClass) {
		
			for( var ii=0; ii < item.items.length; ii++ ) { 
			
				var	iiExtraClass	= '',
					icon			= item.id + "-" + item.items[ii].id + ".png";
				
				if( item.items[ii].unavailable )
					iiExtraClass += ' wx-unavailable';
					
				if( item.items[ii].extension )
					iiExtraClass += ' wx-require-extension-' + item.extension;
					
				item.types = pushItemTypes(item.types, item.items[ii].types);		
	
				jQuery( 'div#wx-add-' + item.id + '-items' ).append(
					
					"<div id='add-" + item.id + "-" + item.items[ii].id + "' class='wx-add-item-icon wxui-btn white large radius3 wx-alignleft wx-add-" + item.id + "-dialog-item wx-add-single" + extraClass + "'>" +
					
						"<img src='" + wx.navIconDir + icon + "' />" +
						"<span>" + item.items[ii].name + "</span>" +
						
					"</div>"
				
				);
				
			}
		
		}
		
		/* Add an icon to a tab type */
	
		var insertToTypeDialogs	= function(item, extraClass) {
				
			for( var ii=0; ii < item.types.length; ii++ ) {
			
				var type 	= item.types[ii],
					icon	= item.id.replace(/\./, "-") + ".png";
				
				jQuery( 'div#wx-add-' + type + '-type-dialog' ).append(
				
					"<div id='add-" + item.id + "'  ref='add-" + item.id + "' rel='" + type + "' class='wxui-btn white large radius3 wx-floatleft wx-add-source-icon" + extraClass + "'>" +
					
						"<img src='"  + wx.navIconDir + icon + "' />" +
						"<span>" + item.name + "</span>" +
						
					"</div>"
				
				);	
		
			}
	
		}
		
		var checkExtraClasses	= function(item, addDescription) {
		
			var extraClass	= '';
			
			if( item.extension )
				extraClass += ' wx-require-extension-' + item.extension;
		
			if( item.unavailable )
				extraClass += ' wx-unavailable';
				
			if( !(item.items instanceof Array) ) {
			
				extraClass += ' wx-add-single';
				
				if( undefined == item.types )
					extraClass += ' wx-special-notice';
				
			}
				
			if( true == addDescription && item.description && jQuery( '.wx-service-' + item.id + ' > div.wx-service-description' ).length == 0 ) {
			
				jQuery( '.wx-service-' + item.id ).prepend( 
				
					"<div class='wx-service-description'>" + 
						item.description + 
					"</div>" 
			
				);
				
			}
				
			return extraClass;
		
		}
		
		var createSwipePages	= function() {
		
			/* Add a service type icon */
			
			var serviceIconHtml		= function(item, id) {
			
					var extraClass 			= checkExtraClasses(item, true),
						appendDiv			= '',
						icon				= id.replace(/\./, "-") + ".png";
					
					if( item.types instanceof Array && undefined != wx.types[ item.types[0] ] ) {
					
						if( wx.tabSyncData.results.config.tier == 2.1 && ( wx.types[ item.types[0] ].tier > 1 ) )
							appendDiv = appendNoticeDiv( 'div#add-' + item.id, 'trial' );
						
						if( wx.types[ item.types[0] ].tier > wx.tabSyncData.results.config.tier ) {
						
							appendDiv 	= appendNoticeDiv( 'div#add-' + item.id, 'upgrade' );
							extraClass	+= ' wx-upgrade-prompt';
							
						}
							
					}
				
					return "<div id='add-" + id + "' ref='add-" + id + "' class='wxui-btn white large radius3 wx-floatleft wx-add-source-icon" + 
										extraClass + "'>" +
					
								"<img src='"  + wx.navIconDir  + 
											icon + "' />" +
											
								"<span>" + item.name + "</span>" + appendDiv +
						
							"</div>";
			
				},
				
				/* Add upgrade or trial badge */
				
				appendNoticeDiv				= function(serviceDiv, notice) {
				
					if( notice == 'upgrade' ) {
					
						jQuery( serviceDiv ).addClass( 'wx-upgrade-prompt' );
					
					}
		
					jQuery( serviceDiv ).append(
					
						'<div class="wx-icon-badge-notice">' + notice + '</div>'
					
					);
					
					return appendDiv =  '<div class="wx-icon-badge-notice">' + notice + '</div>';
		
				},
				
				/* Add tab type icon */
				
				typeIconHtml				= function(type) {
				
					if( wx.types[ type ] == undefined ) {
						
						console.log( "Missing tab detected: " + type);
						return "";
						
					}
				
					return 	"<div id='add-" + type + "-type' ref='add-" + type + "-type' class='wxui-btn white large radius3 wx-floatleft wx-add-source-icon'>" +
					
								"<img src='" + wx.navIconDir + type + ".png' />" +
								"<span>" + wx.types[type].name + "</span>" +
						
							"</div>";
	
				},
				
				/* Find out about what a page icon should be linked to */
				
				getItemData					= function(alias) {
			
					var alias		= alias.split("."),
						item;
						
					if( alias[0] == "type" ) 
						return typeIconHtml(alias[1]);
				
					for( var i=0; i < wx.features.length; i++ ) {
					
						var feature		= wx.features[i];
					
						if( alias[0] == feature.id ) {
						
							if( alias[1] == undefined )
								return serviceIconHtml(feature, feature.id);
								
							else {
								
								for( var ii=0; ii < feature.items.length; ii++ ) {
								
									var subFeature		= feature.items[ii],
										id				= feature.id + "-" + subFeature.id;
									
									if( alias[1] == subFeature.id )
										return serviceIconHtml(subFeature, id);
								
								}
								
							}
							
						}
				
					}
				
					console.log( "Failed to load: " + alias[0] + "." + alias[1] );
			
				};
		
			for( var i=0; i < wx.swipePages.length; i++ ) {
			
				var page 		= wx.swipePages[i],
					pageHtml	= '';
			
				for( var ii=0; ii < page.items.length; ii++ ) {
				
					pageHtml 		+= getItemData( page.items[ii] )
	
				}
			
				jQuery( 'div#wx-swipe-wrap' ).append(
				
					"<div class='wx-swipe-page'>" +
					
						 page.helpHtml + pageHtml +
						
					"</div>"			
				
				);
				
			}
		
		}
		
		var addIconBadges		= function() {
		
			var badges			= {
			
					check:		{},
					notice:		{}
			
				},
				
				/* Add check badge */
				
				appendCheckDiv		= function(serviceDiv) {
				
					if( badges.check[ serviceDiv ] != true ) {
						
						badges.check[ serviceDiv ] = true;
							
						jQuery( serviceDiv ).append(
						
							'<div class="wx-icon-badge-checkmark">&#x2713;</div>'
						
						);
						
					}
				
				},
				
				/* Add trial or upgrade badge */
				
				appendNoticeDiv		= function(serviceDiv, notice) {
				
					if( badges.notice[ serviceDiv ] != true ) {
					
						badges.notice[ serviceDiv ] = true;
						
						if( notice == 'upgrade' ) {
						
							jQuery( serviceDiv ).addClass( 'wx-upgrade-prompt' );
						
						}
	
						jQuery( serviceDiv ).append(
						
							'<div class="wx-icon-badge-notice">' + notice + '</div>'
						
						);
					
					}
				
				};
		
			for( var i = 0; i < wx.tabSyncData.results.tabs.length; i++ ) {
			
				var tab			= wx.tabSyncData.results.tabs[i],
					serviceDiv 	= 'div#add-';
					
				if( tab.type == "tab" ) {
				
					serviceDiv +=	tab.component + "-type";
					
					if( wx.tabSyncData.results.config.tier == 2.1 && ( wx.types[ tab.component ].tier > 1 ) )
						appendNoticeDiv( serviceDiv, 'trial' );
				
					if( wx.types[ tab.component ].tier > wx.tabSyncData.results.config.tier )
						appendNoticeDiv( serviceDiv, 'upgrade' );
						
					continue;
				
				}
					
				if( wx.tabComponents[ tab.component ] == undefined || tab.published == 0 )
					continue;
					
				if( isFunction( wx.tabComponents[ tab.component ].set) )
					serviceDiv += wx.tabComponents[ tab.component ].set( tab[ wx.tabComponents[tab.component].checkField ] );
				else 
					serviceDiv += wx.tabComponents[ tab.component ].set;
					
				appendCheckDiv( serviceDiv );
	
				if( wx.tabComponents[ tab.component ].items == undefined )
					continue;
				
				for( var ii = 0; ii < wx.tabComponents[ tab.component ].items.length; ii++ ) {
				
					var serviceItem = wx.tabComponents[ tab.component ].items[ii],
						serviceDiv	= 'div#add-';
					
					if( serviceItem.check == undefined ) {
					
						serviceDiv += serviceItem.name;
					
					} else {
						
						var serviceCode = serviceItem.check( tab[ serviceItem.checkField ] );
						
						if( !serviceCode )
							continue;
						
						serviceDiv += serviceCode;
						
					}
					
					appendCheckDiv( serviceDiv );
				
				}
	
			}
		
		}
		
		/* Build the wx.types object */
		
		var buildTabTypes		= function() {
		
			wx.types	= wx.types || {};
		
			for( i = 0; i < wx.tabSyncData.results.tabs.length; i++ ) {
			
				var tab		= wx.tabSyncData.results.tabs[i];
				
				if( tab.type != 'tab' )
					continue;
					
				wx.types[ tab.component ] = {
				
					name:	tab.name,
					tier:	tab.tier
				
				};
				
			}
		
		}
		
		/* Build dialogs initializer */
		
		var createDialogsInit	= function() {
		
			buildTabTypes();
	
			for (var i=0; i < wx.features.length; i++) {
			
				var item 			= jQuery.extend(true, {}, wx.features[i]), // clone, not reference
					extraClass 		= checkExtraClasses(item);
					
				if( item.items instanceof Array ) {
				
					jQuery( 'div#wx-hidden-dialogs' ).append(
					
						"<div id='wx-add-" + item.id + "-dialog' class='wx-jquery-dialog wx-hide'>" +
						
							"<div id='wx-add-" + item.id + "-items'><div class='wx-service-description'>" + item.description + "</div>" +
							
							"</div>" +
							
						"</div>"
						
					);
					
					pushSubItemTypes(item, extraClass);
				
				}
				
				if( !(item.types instanceof Array) )
					item.types = [ item.types ];
				
				insertToTypeDialogs(item, extraClass);
					
			}
			
			createSwipePages();
			addIconBadges();
			
			wx.swipeElem	= jQuery('#wx-swipe')[0];
			wx.swipe 		= new Swipe(wx.swipeElem, {
						
						continuous: 	true,
						speed:			400,
						transitionEnd:	function(i, el) {
						
							jQuery('button.red').addClass('white');
							jQuery('button.red').removeClass('red');
							jQuery( 'button#wx-content-nav-' + i ).removeClass('white');
							jQuery( 'button#wx-content-nav-' + i ).addClass('red');
						
						}
						
			});
		
		}();
		
	}();

});