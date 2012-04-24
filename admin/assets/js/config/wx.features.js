/*	
*	Weever Apps Administrator extension for Joomla
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


wx.features = [

	{
	
		id:			'joomla',
		name:		'Joomla Content',
		summary:	'From your Joomla site...',
		items:	[
		
			{
			
				id:				'blog',
				name:			'Blog',
				types:			['blog', 'map', 'proximity',  'directory']
			
			},
			{
			
				id:				'category',
				name:			'Category',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'article',
				name:			'Article',
				types:			['page', 'panel', 'map', 'aboutapp', 'proximity']
			
			}
		
		]
		
	
	},
	{
	
		id:			'joomla_contact',
		name:		'Contact',
		types:		'contact'
		
	},
	{

		id:			'k2',
		extension:	'com_k2',
		name:		'K2 Content',
		items:	[
		
			{
			
				id:				'blog',
				name:			'K2 Blog',
				extension:		'com_k2',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'category',
				name:			'K2 Category',
				extension:		'com_k2',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'item',
				name:			'K2 Item',
				extension:		'com_k2',
				types:			['page', 'panel', 'map', 'aboutapp', 'proximity']
			
			},
			{
			
				id:				'tag',
				name:			'K2 Tag',
				extension:		'com_k2',
				types:			['blog', 'directory', 'map', 'proximity']
			
			}
		
		]
	
	},
	{
	
		id:				'virtuemart',
		extension:		'com_virtuemart',
		name:			'Virtuemart',
		unavailable:	'Feature coming soon!',
		types:			'product',
		tier:			2
	
	},
	{
	
		id:				'easyblog',
		extension:		'com_easyblog',
		name:			'EasyBlog Content',
		items:	[
		
			{
			
				id:				'category',
				name:			'EasyBlog Category',
				extension:		'com_easyblog',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'post',
				name:			'EasyBlog Post',
				extension:		'com_easyblog',
				types:			['page', 'panel', 'map', 'aboutapp', 'proximity']
			
			},
			{
			
				id:				'tag',
				name:			'EasyBlog Tag',
				extension:		'com_easyblog',
				types:			['blog', 'directory', 'map', 'proximity']
			
			}
		
		]
	
	},
	{
	
		vertical:		'all',
		id:				'twitter',
		name:			'Twitter',
		url:			'http://twitter.com/',
		description:	'<p>Twitter offers businesses an easy way to communicate with an engaged mobile audience.</p>' +
		
					'<h4>Mobile App Features</h4>'+
					
					   '<ul><li>Display Twitter user streams, #hashtag(s) or search results</li>'+
					    '<li>Share Blog Post or Pages via Twitter (options button)</li>'+
					    '<li>Share App via Twitter (from the ‘Share App’ tab)</li>'+
					    '</ul></p>',
					
		items:	[
		
			{
			
				id:			'user',
				name:		'Twitter User',
				types:		'social'
			
			},
			{
				
				id:			'hashtag',
				name:		'Hash Tag',
				types:		'social'
			
			},
			{
			
				id:			'search',
				name:		'Search Term',
				types:		'social'
			
			}			
		
		]
	
	},
	{
	
		id:				'facebook',
		vertical:		'all',
		name:			'Facebook',
		description:	'<p>Add a stream of Facebook updates to your mobile app!</p>' +
			
				'<h4>Mobile App Features</h4>'+
				
				   '<ul><li>Display Facebook updates instantly</li>'+
				    '<li>Share App via Facebook (from the ‘Share App’ tab)</li>'+
				    '<li>Display your Facebook Photos</li>'+
				    '<li>Display your Facebook Events</li>'+
				    
				    '</ul>'+
				 
				' <p><em>It is recommended you add Pages, rather than personal profiles. Due to privacy settings, personal profiles may not work in the app.</em></p>	',
				
		url:			'http://facebook.com/',
		types:			['social', 'photo', 'calendar']
			
	},
	{
	
		id:				'tumblr',
		vertical:		'all',
		name:			'Tumblr',
		types:			'blog',
		unavailable:	'Tumblr Support is coming soon!'
	
	},
	{
	
		vertical:		'all',
		id:				'google_plus',
		name:			'Google +',
		types:			'social',
		unavailable:	'Google Plus Support is coming soon!'
	
	},
	{
	
		vertical:		'all',
		id:				'youtube',
		name:			'Youtube',
		url:			'http://youtube.com/',
		description:	'<p>Share your YouTube video channels, playlists and embeds inside your app.</p>'+
			
			'<h4>Mobile App Features</h4>'+
			
			'<ul>'+
			'<li>Display YouTube Channel videos</li>'+
			'<li>Display YouTube Playlist videos</li>'+
			'<li>Play videos embedded in articles</li>'+
			'<li>Videos play in full screen</li>'+
			'</ul>',

		items:			[
		
			{
			
				id:			'channel',
				name:		'User or Channel',
				types:		'video'
			
			},
			{
			
				id:			'playlist',
				name:		'Playlist',
				types:		'video'
			
			}
		
		]
	
	},
	{
	
		vertical:		'all',
		id:				'vimeo',
		name:			'Vimeo',
		url:			'http://vimeo.com/',
		description:	'<p>Add Vimeo video channels to your mobile app – share your media!</p>'+
		
			'<h4>Mobile App Features</h4>'+
			
			'<ul>'+
			
			    '<li>Display Vimeo channel videos</li>'+
			    '<li>Display Vimeo user videos</li>'+
			    '<li>Play videos embedded in articles</li>'+
			    '<li>Videos play in full screen</li>'+
			    
			'</ul>',
			
		types:			'video'
	
	
	},
	{
	
		vertical:		'all',
		id:				'wufoo',
		name:			'Wufoo Forms',
		url:			'http://wufoo.com/',
		description:	'<p>Use Wufoo’s free online form creator to power your Weever App’s contact forms, online surveys, and event registrations.</p>'+
		
			'<p>Wufoo Forms connect to many free and paid services on the web.</p>'+
			
			'<h4>Integrates With:</h4>'+
			
			'<ul>'+
			
				    '<li>MailChimp Newsletters</li>'+
				    '<li>Campaign Monitor Newsletters</li>'+
				    '<li>PayPal Donations and Payments</li>'+
				    '<li>SalesForce CRM</li>'+
				    '<li>Freshbooks Accounting & Billing</li>'+
				    '<li>Highrise Contact Management</li>'+
				    '<li>Twitter “Auto Form Tweets”</li>'+
				
			'</ul>'+
			
			'<p>For more information check out: <a href="http://wufoo.com/integrations" target="_blank">http://wufoo.com/integrations</a></p>',
			
		types:			'form',
		tier:			2
	
	},
	{
	
		vertical:		'all',
		id:				'flickr',
		name:			'Flickr',
		url:			'http://flickr.com/',
		description:	'<p>Add Flickr Photo streams, sets (galleries) and even group pools to your app!</p>' +
		
			'<h4>Mobile App Features</h4>' +
			
			'<ul>' +
			
				    '<li>Flickr User Photo Streams</li>'+
				    '<li>Flickr Photo Sets (galleries)</li>'+
				    '<li>Coming soon: Flickr Group Pools (a stream of photos from multiple Flickr users)</li>'+
				    '<li>Albums display in a swipe-to-see-next photo stream</li>'+
				    '<li>Double-tap to display photos at full-screen size</li>'+
			
			'</ul>'+
			
			'<p>Compatible with all <em>publicly available</em> photos on Flickr. Note that photos uploaded prior to April 2011 may not display as gallery thumbnails – simply rotate and save these photos to fix.</p>',
			
		items:			[
		
			{
			
				id:		'photostream',
				name:	'Photostream (latest only)',
				types:	'photo'
			
			},
			{
			
				id:		'photosets',
				name:	'All Photosets',
				types:	'photo'
			
			}
		
		]
	
	},
	{
	
		id:				'picasa',
		vertical:		'all',
		name:			'Picasa',
		url:			'http://picasa.google.com/',
		description:	'<p>Fast and easy photo sharing from Google.</p>'+
		
			'<h4>Mobile App Features</h4>' +
			
			'<ul>' +
			
				'<li>Add your Picasa Web Albums to your mobile app</li>'+
				'<li>Albums display in a gallery and swipe-to-see-next photo stream</li>'+
				'<li>Double-tap to display photos at full-screen size</li>'+
			
			'</ul>', 
			
		
		types:			'photo'
	
	},
	{
	
		vertical:		'all',
		id:				'foursquare',
		name:			'Foursquare',
		url:			'http://foursquare.com/',
		description:	'<p>Foursquare is a location-based social networking website for mobile devices. Users “check-in” at venues by selecting from a list of venues the app locates nearby. Each check-in awards the user points and sometimes “badges”.</p>' +
		
			'<p>With Weever Apps, you can add a real-time photo stream for a Foursquare location.'+
			
			'<ul>'+
			
				    '<li>Add a real-time stream of user-generated Foursquare Venue Photos to your mobile app.</li>'+
				    '<li>Albums display in a swipe-to-see-next photo stream</li>'+
				    '<li>Double-tap to display photos at full-screen size</li>'+
				
			
			'</ul>',
			
		types:			'photo'	
	
	},
	{
	
		vertical:		'all',
		id:				'soundcloud',
		name:			'SoundCloud',
		unavailable:	'Sound Cloud support is coming soon!',
		items:			[
		
			{
				
				id:		'user',
				name:	'User',
				types:	'audio'				
			
			},
			{
			
				id:		'set',
				name:	'Set',
				types:	'audio'
			
			}
		
		]		
	
	},
	{
	
		id:				'bandcamp',
		vertical:		['music', 'event'],
		name:			'BandCamp',
		unavailable:	'BandCamp support is coming soon!',
		items:			[
			
			{
			
				id:		'band',
				name:	'Band',
				types:	'audio'
			
			},
			{
			
				id:		'album',
				name:	'Album',
				types:	'audio'			
			
			}
		
		]
	
	},
	{
	
		id:				'google_calendar',
		name:			'Google Calendar',
		types:			'calendar'
	
	},
	{
	
		id:				'blogger',
		name:			'Blogger',
		types:			'blog'
	
	},
	{
	
		id:				'identica',
		name:			'Identi.ca',
		description:	'<p>Identi.ca is a social microblogging service similar to Twitter, but built on open source tools and open standards.' +
					
					'<p>In Weever, you can display a search term or hashtag stream.</p>',
		types:			'social'
	
	},
	{
	
		id:				'r3s',
		name:			'R3S Feed',
		types:			['blog', 'page', 'map', 'panel', 'directory', 'aboutapp', 'proximity']
	
	},
	{
	
		id:				'suggestion',
		name:			'Something Missing?',
	
	}

];
