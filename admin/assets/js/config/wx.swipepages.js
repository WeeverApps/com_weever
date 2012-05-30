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


wx.swipePages = [

	{
	
		/* name:		'1. Add Website Content to Your Mobile App', */
		
		helpHtml:	'<div id="wxnavtip-content" class="wx_box info wxblk"><h2 class="wxnavtip-title">Welcome to Weever Apps! <span style="font-size:14px; float:right;"> <span onclick="wx.swipe.next()" class="wxnavtip-slide-info">next &rarr;</span></span></h2><p class="wxnavtip-description">You\'re currently on the &rdquo;Add Site Content&ldquo; slide. Each slide has different things that you can add to your app.</p></div>',
		
		
		items:		[
		
			'joomla.blog',
			'joomla.category',
			'joomla.article',
			'joomla_contact',
			'k2.blog',
			'k2.category',
			'k2.item',
			'k2.tag',
			'easyblog.blog',
			'easyblog.category',
			'easyblog.item',
			'easyblog.tag',
			'virtuemart'
		
		]	
	
	},
	{
	
		/* name:		'2. Add Your Social Feeds', */
		
		
		helpHtml:	'<div id="wxnavtip-social" class="wx_box info wxblk"><h2 class="wxnavtip-title">2. Add Your Social Media Streams <span style="font-size:14px; float:right;"><span onclick="wx.swipe.prev()" class="wxnavtip-slide-info">&larr; previous</span> <span class="wxnavtip-minisep">|</span> <span onclick="wx.swipe.next()" class="wxnavtip-slide-info">next &rarr;</span></span></h2><p class="wxnavtip-description">Be Social! &nbsp;The Weever Apps &ldquo;share tab&rdquo; and social-forwarding options make it easy for visitors to share your app!</p></div>',
		
		
		
		items:		[
		
			'twitter',
			'facebook',
			'blogger',
			'identica',
			'google_plus',
			'tumblr'
		
		]	
	
	},
	{
	
		/* name:		'3. Add Your Multimeda Content', */
		
		helpHtml:	'<div id="wxnavtip-audiovideo" class="wx_box info wxblk"><h2 class="navtip-title">3. Add Audio, Video and Photos <span style="font-size:14px; float:right;"><span onclick="wx.swipe.prev()" class="wxnavtip-slide-info">&larr; previous</span> <span class="wxnavtip-minisep">|</span> <span onclick="wx.swipe.next()" class="wxnavtip-slide-info">next &rarr;</span></span></h2><p class="wxnavtip-description">Share your products, services, tutorials, creative works or favorite content!</p></div>',
		
			items:		[
		
			'flickr',
			'picasa',
			'youtube',
			'vimeo',
			'foursquare',
			'facebook',
			'soundcloud',
			'bandcamp'
		
		]
	
	},
	{
	
		/* name:		'4. Add Forms, Calendars, and More', */
		
		helpHtml:	'<div id="wxnavtip-eventsandforms" class="wx_box info wxblk"><h2 class="navtip-title">4. Add Event Calendars, Signup Forms &amp; More! <span style="font-size:14px; float:right;"><span onclick="wx.swipe.prev()" class="wxnavtip-slide-info">&larr; previous</span> <span class="wxnavtip-minisep">|</span> <span onclick="wx.swipe.next()" class="wxnavtip-slide-info">next &rarr;</span></span></h2><p class="wxnavtip-description">Connect your visitors to everything they need to know, when they need to know it.</p></div>',
		
		items:		[
		
			'google_calendar',
			'wufoo',
			'facebook',
			'r3s',
			'suggestion'
		
		]
	
	},
	{
	
		/* name:		'... or, Add Content by Navigation Tab Type', */
		
		helpHtml:	'<div id="wxnavtip-alltabs" class="wx_box info wxblk"><h2 class="navtip-title">...and Done!<span style="font-size:14px; float:right;"><span onclick="wx.swipe.prev()" class="wxnavtip-slide-info">&larr; previous</span> </span></h2><p class="wxnavtip-description">Easy, eh?  Well, we certainly hope so!  &#x263A; &nbsp; Here are all the <strong>&ldquo;tab-types&rdquo;</strong> we support (tabs are those little icon-buttons at the bottom of the app). Pick from the icons below to add a new feature to that tab &ndash; or just use the slides again if you like that better.<br/><br/>All set with features? Great! &nbsp;<a style="color:#2B6181;" class="wxreverse-decor" href="index.php?option=com_weever&view=theme&task=theme">Now let\'s make this app look fantastic</a>!</p></div>',		
		
		
		items:		[
		
			'type.blog',
			'type.page',
			'type.social',
			'type.map',
			'type.panel',
			'type.directory',
			'type.proximity',
			'type.aboutapp',
			'type.photo',
			'type.video',
			'type.audio',
			'type.calendar',
			'type.form',
			'type.contact',
			'type.product'
		
		]
	
	}

];
