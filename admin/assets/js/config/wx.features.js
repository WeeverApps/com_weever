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


wx.features = [

	{
	
		group:		'local-content',
		id:			'joomla',
		icon:		'Joomla_NoCircle.png',
		name:		'Joomla Content',
		summary:	'From your Joomla site...',
		items:	[
		
			{
			
				id:				'category',
				name:			'Blog or Category',
				icon:			'category_icon.png',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'article',
				name:			'Article',
				icon:			'/article_icon.png',
				types:			['page', 'panel', 'map', 'aboutapp', 'proximity']
			
			},
			{
			
				id:				'menu',
				name:			'Content from Menu',
				icon:			'Joomla_NoCircle.png',
				unavailable:	true
			
			}
		
		]
		
	
	},
	{
	
		group:		'local-content',
		id:			'joomla_contact',
		name:		'Joomla Contact',
		icon:		'contact_icon.png',
		types:		'contact'
		
	},
	{
	
		group:		'local-content',
		id:			'k2',
		component:	'com_k2',
		name:		'K2 Content',
		icon:		'K2_Square.png',
		items:	[
		
			{
			
				id:				'category',
				name:			'Category',
				icon:			'category_icon.png',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'article',
				name:			'Article',
				icon:			'/article_icon.png',
				types:			['page', 'panel', 'map', 'aboutapp', 'proximity']
			
			},
			{
			
				id:				'tag',
				name:			'Tag',
				icon:			'tag_icon.png',
				types:			['blog', 'directory', 'map', 'proximity']
			
			}
		
		]
	
	},
	{
	
		group:			'local-content',
		id:				'virtuemart',
		component:		'com_virtuemart',
		name:			'Virtuemart',
		icon:			'Store_Pricetag',
		unavailable:	true,
		types:			'product',
		tier:			2
	
	},
	{
	
		group:			'local-content',
		id:				'easyblog',
		component:		'com_easyblog',
		name:			'EasyBlog Content',
		icon:			'easyblog_icon.png',
		unavailable: 	true,
		items:	[
		
			{
			
				id:				'category',
				name:			'Category',
				icon:			'category_icon.png',
				types:			['blog', 'directory', 'map', 'proximity']
			
			},
			{
			
				id:				'article',
				name:			'Article',
				icon:			'/article_icon.png',
				types:			['page', 'panel', 'map', 'aboutapp', 'proximity']
			
			},
			{
			
				id:				'tag',
				name:			'Tag',
				icon:			'tag_icon.png',
				types:			['blog', 'directory', 'map', 'proximity']
			
			}
		
		]
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'twitter',
		name:			'Twitter',
		icon:			'TwitterBird_NoCircle.png',
		items:	[
		
			{
			
				id:			'user',
				name:		'Twitter User',
				icon:		'profile_icon.png',
				types:		'social'
			
			},
			{
				
				id:			'hashtag',
				name:		'Hash Tag',
				icon:		'hashtag_icon.png',
				types:		'social'
			
			},
			{
			
				id:			'search',
				name:		'Search Term',
				icon:		'search_icon.png',
				types:		'social'
			
			}			
		
		]
	
	},
	{
	
		group:			'third-party',
		id:				'facebook',
		vertical:		'all',
		name:			'Facebook',
		icon:			'Facebook_Square.png',
		description:	'<p>Add a stream of Facebook updates to your mobile app!</p>' +
			
				'<p>Mobile App Features:'+
				
				   '<ul><li>Display Facebook updates instantly</li>'+
				    '<li>Share App via Facebook (from the ‘Share App’ tab)</li>'+
				    '<li>Display your Facebook Photos</li>'+
				    '<li>Display your Facebook Events</li>'+
				    
				    '</ul>'+
				    
				' </p>'+
				 
				' <p><em>It is recommended you add Pages, rather than personal profiles. Due to privacy settings, personal profiles may not work in the app.</em></p>	',
				
		url:			'http://facebook.com/',
		items:			[
		
			{
			
				id:			'stream',
				name:		'Status Stream',
				icon:		'profile_icon.png',
				types:		'social'
			
			},
			{
			
				id:			'albums',
				name:		'Photo Albums',
				icon:		'album_photos_icon.png',
				types:		'photo'
			
			},
			{
			
				id:			'events',
				name:		'Events',
				icon:		'calendar.png',
				types:		'calendar'
			
			}
		
		]
	
	},
	{
	
		group:			'third-party',
		id:				'tumblr',
		vertical:		'all',
		name:			'Tumblr',
		icon:			'tumblr_icon.png',
		types:			'blog',
		unavailable:	true
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'google_plus',
		name:			'Google +',
		icon:			'GooglePlus.png',
		types:			'social'
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'youtube',
		name:			'Youtube',
		icon:			'Youtube_NoCircle.png',
		items:			[
		
			{
			
				id:			'channel',
				name:		'User or Channel',
				icon:		'video_icon.png',
				types:		'video'
			
			},
			{
			
				id:			'playlist',
				name:		'Playlist',
				icon:		'video_icon.png',
				types:		'video'
			
			}
		
		]
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'vimeo',
		name:			'Vimeo',
		icon:			'Vimeo_NoCircle.png',
		types:			'video'
	
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'wufoo',
		name:			'Wufoo Forms',
		icon:			'Wufoo_NoCircle.png',
		types:			'form',
		tier:			2
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'flickr',
		name:			'Flickr',
		icon:			'Flickr_Circle.png',
		items:			[
		
			{
			
				id:		'photostream',
				name:	'Photostream (latest only)',
				icon:	'album_photos_icon.png',
				types:	'photo'
			
			},
			{
			
				id:		'photosets',
				name:	'All Photosets',
				icon:	'album_photos_icon.png',
				types:	'photo'
			
			}
		
		]
	
	},
	{
	
		group:			'third-party',
		id:				'picasa',
		vertical:		'all',
		name:			'Picasa',
		icon:			'Picasa_NoCircle.png',
		types:			'photo'
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'foursquare',
		name:			'Foursquare',
		icon:			'Foursquare_NoCircle.png',
		types:			'photo'	
	
	},
	{
	
		group:			'third-party',
		vertical:		'all',
		id:				'soundcloud',
		name:			'SoundCloud',
		icon:			'Soundcloud_NoCircle_White.png',
		unavailable:	true,
		items:			[
		
			{
				
				id:		'user',
				name:	'User',
				icon:	'profile_icon.png',
				types:	'audio'				
			
			},
			{
			
				id:		'set',
				name:	'Set',
				icon:	'album_icon.png',
				types:	'audio'
			
			}
		
		]		
	
	},
	{
	
		group:			'third-party',
		id:				'bandcamp',
		vertical:		['music', 'event'],
		name:			'BandCamp',
		unavailable:	true,
		icon:			'Bandcamp_ShapeLetters.png',
		items:			[
			
			{
			
				id:		'band',
				name:	'Band',
				icon:	'profile_icon.png',
				types:	'audio'
			
			},
			{
			
				id:		'album',
				name:	'Album',
				icon:	'album_icon.png',
				types:	'audio'			
			
			}
		
		]
	
	},
	{
	
		group:			'third-party',
		id:				'google_calendar',
		name:			'Google Calendar',
		icon:			'calendar.png',
		types:			'calendar'
	
	},
	{
	
		group:			'third-party',
		id:				'blogger',
		name:			'Blogger',
		icon:			'Blogger_NoCircle.png',
		types:			'blog'
	
	},
	{
	
		group:			'third-party',
		id:				'identica',
		name:			'Identi.ca',
		icon:			'Indentica_NoCircle.png',
		types:			'social'
	
	},
	{
	
		group:			'advanced-feed',
		id:				'r3s',
		name:			'R3S Feed',
		icon:			'cloud5.png',
		types:			['blog', 'page', 'map', 'panel', 'directory', 'aboutapp', 'proximity']
	
	}

];
