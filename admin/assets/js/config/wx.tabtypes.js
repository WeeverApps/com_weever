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

wx.labelText = function(active, futurePassive) {

	this.active 		= active;
	this.futurePassive 	= futurePassive;

};

/* Language for checkboxes; note there are many overrides for specific services in the wx.features object */

wx.tabTypes = {

	'blog':			{
	
		label:	new wx.labelText('Display as a list of articles', 'This content will be displayed as a list of articles')

	},
	'page':			{
	
		label:	new wx.labelText('Display as part of a list of pages', 'This content will be displayed as part of a list of pages')
	
	},
	'directory':	{
	
		label:	new wx.labelText('Display as part of a directory', 'This content will be displayed as a part of a directory')
	
	},
	'video':		{

		label:	new wx.labelText('Display as a list of videos', 'This content will be displayed as a list of videos')

	},
	'photo':		{
	
		label:	new wx.labelText('Display as a list of photo albums', 'This content will be displayed as a list of photo albums')
	
	},
	'panel':		{
	
		label:	new wx.labelText('Display this as a single page', 'This content will be displayed as a single page')
	
	},
	'aboutapp':		{
	
		label:	new wx.labelText('Display this as a single page about this app','This content will be displayed as a single page about this app')
	
	},
	'map':			{
	
		label:	new wx.labelText('Display this as locations on a map', 'This content will be displayed as locations on a map')
	
	},
	'proximity':	{
	
		label:	new wx.labelText('Display as a list of nearby locations', 'This content will be displayed as a list of nearby locations')
	
	},
	'social':		{
	
		label:	new wx.labelText('Display as a list of status updates', 'This content will be displayed as a list of status updates')
	
	},
	'audio':		{
	
		label:	new wx.labelText('Display as a list of audio tracks', 'This content will be displayed as a list of audio tracks')
		
	},
	'product':		{
	
		label: 	new wx.labelText('Display as a list of products', 'This content will be displayed as a list of products')
	
	},
	'calendar':		{
	
		label:	new wx.labelText('Display as a list of events on a calendar', 'This content will be displayed as a list of events on a calendar')
	
	},
	'form':			{
	
		label: 	new wx.labelText('Display as a list of forms', 'This content will be displayed as a list of forms')
	
	},
	'contact':		{
	
		label:	new wx.labelText('Display as a contact card', 'This content will be displayed as a contact card')
	
	}

};