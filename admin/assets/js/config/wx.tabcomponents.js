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


/* Identifies which components have been added to app */
/* set = service, items = components of service, checkField = where to do regex, check = check*/

wx.tabComponents	= {

	'twitter':			{
	
		set:		'twitter',
		items:		[
		
			{
			
				name:			'twitter-search',
				checkField:		'component_behaviour',
				check:			function(str) {
				
					if( str.search( /\#/ ) != -1 ) 
						return false;
						
					return true;
				
				}
			
			},
			{
			
				name:			'twitter-hashtag',
				checkField:		'component_behaviour',
				check:			function(str) {
				
					if( str.search( /\#/ ) != -1 ) 
						return true;
						
					return false;
				
				}
				
			}
				
		],
	},
	'twitteruser':		{
	
		set:		'twitter',
		items:		[{ name: 'twitter-user' }]
		
	},		
	'identi.ca':		{
	
		set:		'identica'
		
	},
	'facebook':			{
	
		set:		'facebook',
		items:		[{ name: 'facebook-stream' }]
		
	},
	'flickr.photosets':	{
	
		set:		'flickr',
		items:		[{ name: 'flickr-photosets' }]
		
	},
	'flickr':			{
	
		set:		'flickr',
		items:		[{ name: 'flickr-photostream' }]
		
	},
	'google.picasa':	{
	
		set:		'picasa'
	
	},
	'facebook.photos':	{
	
		set:		'facebook',
		items:		[{name:	'facebook-albums'}]
	
	},
	'foursquare':		{
	
		set:		'foursquare'
	
	},
	'youtube':			{
	
		set:		'youtube',
		items:		[{name:	'youtube-channel'}]
		
	},
	'youtube.playlist':	{
	
		set:		'youtube',
		items:		[{name:	'youtube-playlist'}]
	
	},
	'vimeo':		{
	
		set:		'vimeo'
	
	},
	'wufoo':		{
	
		set:		'wufoo'
	
	},
	'google.calendar':	{
	
		set:		'google_calendar'
	
	},
	'facebook.events':	{
	
		set:		'facebook',
		items:		[{ name: 'facebook-events' }]
	
	},
	'contact':			{
	
		set:		'joomla_contact'
	
	},
	'blog':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1 ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1 ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1 ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-category';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) {
					
						if( str.search( /tag=/ ) != -1 )
							return 'k2-tag';
						else
							return 'k2-category';
					
					}
						
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1 ) { 
						
						if( str.search( /tag=/ ) != -1 )
							return 'easyblog-tag';
						else
							return 'easyblog-category';
				
					}
				
				}
			
			}
		
		]
	
	},
	'directory':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1 ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1 ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1 ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-category';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) {
					
						if( str.search( /tag=/ ) != -1 )
							return 'k2-tag';
						else
							return 'k2-category';
					
					}
						
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1 ) { 
						
						if( str.search( /tag=/ ) != -1 )
							return 'easyblog-tag';
						else
							return 'easyblog-category';
				
					}
				
				}
			
			}
		
		]
	
	},
	'page':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1 ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1 ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1 ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-article';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) 
						return 'k2-article';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1 ) 
						return 'easyblog-article';
				
				}
			
			}
		
		]
	
	},
	'panel':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1 ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1 ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1 ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-article';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) 
						return 'k2-article';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1 ) 
						return 'easyblog-article';
				
				}
			
			}
		
		]
	
	},
	'aboutapp':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1  ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1 ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1 ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-article';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) 
						return 'k2-article';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1 ) 
						return 'easyblog-article';
				
				}
			
			}
		
		]
	
	},
	'map':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1  ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1  ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1  ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-category';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) {
					
						if( str.search( /tag=/ ) != -1  )
							return 'k2-tag';
						else
							return 'k2-category';
					
					}
						
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1  ) { 
						
						if( str.search( /tag=/ ) != -1  )
							return 'easyblog-tag';
						else
							return 'easyblog-category';
				
					}
				
				}
			
			}
		
		]
	
	},
	'proximity':				{
	
		checkField:		'cms_feed',
		set:			function(str) {
		
			if( str.search( /com_content/ ) != -1 ) 
				return 'joomla';
				
			if( str.search( /com_k2/ ) != -1 ) 
				return 'k2';
			
			if( str.search( /com_easyblog/ ) != -1 ) 
				return 'easyblog';
		
		},
		items:			[
		
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_content/ ) != -1 ) 
						return 'joomla-category';
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_k2/ ) != -1 ) {
					
						if( str.search( /tag=/ ) != -1 )
							return 'k2-tag';
						else
							return 'k2-category';
					
					}
						
				
				}
			
			},
			{
			
				checkField:		'cms_feed',
				check:			function(str) {
				
					if( str.search( /com_easyblog/ ) != -1 ) { 
						
						if( str.search( /tag=/ ) )
							return 'easyblog-tag';
						else
							return 'easyblog-category';
				
					}
				
				}
			
			}
		
		]
	
	}

}
