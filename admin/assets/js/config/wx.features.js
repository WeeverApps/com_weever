/*	
*	Weever Apps Administrator extension for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.7.1.2
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
		description:'Add Content from your Joomla website.',
		splitTypes:	true,
		items:	[
		
			{
			
				id:				'blog',
				component:		'blog',
				name:			'Blog',
				title:			true,
				types:			['blog', 'map', 'proximity',  'directory'],
				fields:			{
				
					'cms_feed':	'#wx-add-joomla-blog-select',
					
				},
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				}
			
			},
			{
			
				id:				'category',
				component:		'blog',
				name:			'Category',
				title:			true,
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-joomla-category-select',
					
				}
			
			},
			{
			
				id:				'article',
				name:			'Article',
				component:		'page',
				title:			true,
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				types:			['page', 'panel', 'map', 'aboutapp'],
				fields:			{
				
					cms_feed:	'#wx-add-joomla-article-url',
					
				},
				component:		{
				
					'map':			'map',
					'page':			'page',
					'panel':		'panel',
					'aboutapp':		'aboutapp'
				
				}
			
			}
		
		]
		
	
	},
	{
	
		id:				'joomla_contact',
		name:			'Contact',
		component:		'contact',
		defaultTitle:	'Contact Us',
		fields:			{
		
			component_id:	'#wx-add-contact-joomla-select'
		
		},
		options:		{
		
			'emailform':	'Display a form instead of my email address',	
			'googlemaps':	'Show my location on a Google Map',
			'showimages':	'Add the image from my Joomla contact'
		
		},
		types:			'contact'
		
	},
	{

		id:			'k2',
		extension:	'com_k2',
		name:		'K2 Content',
		splitTypes:	true,
		description:'Add content from the K2 extension.',
		items:	[
		
			{
			
				id:				'blog',
				name:			'K2 Blog',
				extension:		'com_k2',
				title:			true,
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-k2-blog-select',
					
				}
			
			},
			{
			
				id:				'category',
				name:			'K2 Category',
				extension:		'com_k2',
				title:			true,
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-k2-category-url',
					
				}
			
			},
			{
			
				id:				'item',
				name:			'K2 Item',
				extension:		'com_k2',
				title:			true,
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				types:			['page', 'panel', 'map', 'aboutapp'],
				component:		{
				
					'map':			'map',
					'page':			'page',
					'panel':		'panel',
					'aboutapp':		'aboutapp'
				
				},
				fields:			{
				
					cms_feed:		'#wx-add-k2-item-url',
					
				}
			
			},
			{
			
				id:				'tag',
				name:			'K2 Tag',
				extension:		'com_k2',
				title:			true,
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-k2-tag-url',
					
				}
			
			}
		
		]
	
	},
	{
	
		id:				'virtuemart',
		extension:		'com_virtuemart',
		name:			'Virtuemart',
		unavailable:	'Feature coming soon!',
		types:			'product',
		defaultTitle:	'Products',
		tier:			2
	
	},
	{
	
		id:				'easyblog',
		extension:		'com_easyblog',
		//unavailable:	'Coming soon!',
		name:			'EasyBlog Content',
		description:	'Add content from the easyblog extension.',
		items:	[
		
			{
			
				id:				'blog',
				name:			'EasyBlog Blog',
				extension:		'com_easyblog',
				title:			true,
				//unavailable:	'Coming soon!',
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-k2-blog-select',
					
				}
			
			},
			{
			
				id:				'category',
				name:			'EasyBlog Category',
				extension:		'com_easyblog',
				title:			true,
				//unavailable:	'Coming soon!',
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-category-url',
					
				}
			
			},
			{
			
				id:				'item',
				name:			'EasyBlog Item',
				extension:		'com_easyblog',
				title:				true,
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				//unavailable:	'Coming soon!',
				types:			['page', 'panel', 'map', 'aboutapp'],
				component:		{
				
					'map':			'map',
					'page':			'page',
					'panel':			'panel',
					'aboutapp':	'aboutapp'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-item-url',
					
				}
			
			},
			{
			
				id:				'tag',
				name:			'EasyBlog Tag',
				extension:		'com_easyblog',
				title:			true,
				//unavailable:	'Coming soon!',
				types:			['blog', 'directory', 'map', 'proximity'],
				component:		{
				
					'blog':			'blog',
					'directory':	'directory',
					'map':			'map',
					'proximity':	'proximity'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-tag-url',
					
				}
			
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
					    '<li>Share App via Twitter (from the "Share App" tab)</li>'+
					    '</ul></p>',
					
		items:	[
		
			{
			
				id:				'user',
				name:			'Twitter User',
				defaultTitle:	'component_behaviour',
				component:		'twitteruser',
				types:			'social',
				fields:			{
				
					component_behaviour: 	'#wx-twitter-user-value'
				
				},
				defaultValue:	{
				
					component_behaviour:	'@'
					
				}
			
			},
			{
				
				id:				'hashtag',
				name:			'Hash Tag',
				component:		'twitter',
				defaultTitle:	'component_behaviour',
				types:			'social',
				fields:			{
				
					component_behaviour: 	'#wx-twitter-hashtag-value'
				
				},
				defaultValue:	{
				
					component_behaviour:	'#'
					
				}
			
			},
			{
			
				id:				'search',
				name:			'Search Term',
				component:		'twitter',
				types:			'social',
				defaultTitle:	'Twitter',
				fields:			{
				
					component_behaviour: 	'#wx-twitter-search-value'
				
				}
			
			}			
		
		]
	
	},
	{
	
		id:				'facebook',
		defaultTitle:	'Facebook',
		vertical:		'all',
		component:		{
		
			'social':	'facebook',
			'photo':	'facebook.photos',
			'calendar':	'facebook.events'
		
		},
		name:			'Facebook',
		description:	'<p>Add a stream of Facebook updates to your mobile app!</p>' +
			
				'<h4>Mobile App Features</h4>'+
				
				   '<ul><li>Display Facebook updates instantly</li>'+
				    '<li>Share App via Facebook (from the "Share App" tab)</li>'+
				    '<li>Display your Facebook Photos</li>'+
				    '<li>Display your Facebook Events</li>'+
				    
				    '</ul>'+
				 
				' <p><em>It is recommended you add Pages, rather than personal profiles. Due to privacy settings, personal profiles may not work in the app.</em></p>	',
				
		url:			'http://facebook.com/',
		types:			['social', 'photo', 'calendar'],
		labels:			{
		
			'social':		new wx.labelText('Display my status updates as a stream', null),
			'photo':		new wx.labelText('Display my public photo albums', null),
			'calendar':		new wx.labelText('Display my upcoming events', null)
		
		},
		fields:			{
		
			component_behaviour: 	'#wx-facebook-user-value'
		
		},
		defaultValue:	{
		
			component_behaviour:	'http://facebook.com/'
			
		}
			
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
			
				id:				'channel',
				name:			'User / Channel',
				types:			'video',
				title:			true,
				defaultTitle:	'Videos',
				component:		'youtube',
				fields:			{
				
					component_behaviour:	'#wx-youtube-channel-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://youtube.com/'
				
				}
			
			},
			{
			
				id:				'playlist',
				name:			'Playlist',
				types:			'video',
				component:		'youtube.playlists',
				title:			true,
				defaultTitle:	'Videos',
				fields:			{
				
					component_behaviour:	'#wx-youtube-playlist-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://youtube.com/playlist?list='
				
				}
			
			}
		
		]
	
	},
	{
	
		vertical:		'all',
		id:				'vimeo',
		name:			'Vimeo',
		component:		'vimeo',
		url:			'http://vimeo.com/',
		description:	'<p>Add Vimeo video channels to your mobile app – share your media!</p>'+
		
			'<h4>Mobile App Features</h4>'+
			
			'<ul>'+
			
			    '<li>Display Vimeo channel videos</li>'+
			    '<li>Display Vimeo user videos</li>'+
			    '<li>Play videos embedded in articles</li>'+
			    '<li>Videos play in full screen</li>'+
			    
			'</ul>',
			
		types:			'video',
		title:			true,
		defaultTitle:	'Videos',
		fields:			{
		
			component_behaviour:	'#wx-vimeo-channel-url'
		
		},
		defaultValue:	{
		
			component_behaviour:	'http://vimeo.com/'
		
		}
	
	
	},
	{
	
		vertical:		'all',
		id:				'wufoo',
		name:			'Wufoo Forms',
		component:		'wufoo',
		url:			'http://wufoo.com/',
		description:	'<p>Use Wufoo\'s free online form creator to power your Weever App\'s contact forms, online surveys, and event registrations.</p>'+
		
			'<p>Wufoo Forms connect to many free and paid services on the web.</p>'+
			
			'<h4>Integrates With:</h4>'+
			
			'<ul>'+
			
				    '<li>MailChimp Newsletters</li>'+
				    '<li>Campaign Monitor Newsletters</li>'+
				    '<li>PayPal Donations and Payments</li>'+
				    '<li>SalesForce CRM</li>'+
				    '<li>Freshbooks Accounting &amp; Billing</li>'+
				    '<li>Highrise Contact Management</li>'+
				    '<li>Twitter "Auto Form Tweets"</li>'+
				
			'</ul>'+
			
			'<p>For more information check out: <a href="http://wufoo.com/integrations" target="_blank">http://wufoo.com/integrations</a></p>',
			
		types:			'form',
		defaultTitle:	'Forms',
		tier:			2,
		fields:			{
		
			component_behaviour:	'#wx-wufoo-form-url',
			var:					'#wx-wufoo-form-api-key'
		
		}
	
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
			
				id:				'photostream',
				name:			'Latest Photos',
				title:			true,
				defaultTitle:	'Latest Photos',
				component:		'flickr',
				types:			'photo',
				fields:			{
				
					component_behaviour:	'#wx-flickr-photostream-photo-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://flickr.com/photos/'
					
				}
			
			},
			{
			
				id:				'photosets',
				name:			'All Photosets',
				defaultTitle:	'Photos',
				component:		'flickr.photosets',
				types:			'photo',
				defaultValue:	{
				
					component_behaviour:	'http://flickr.com/photos/'
					
				},
				fields:			{
				
					component_behaviour:	'#wx-flickr-photosets-photo-url'
				
				}
			
			}
		
		]
	
	},
	{
	
		id:				'picasa',
		vertical:		'all',
		name:			'Picasa',
		component:		'google.picasa',
		url:			'http://picasa.google.com/',
		defaultTitle:	'Photos',
		description:	'<p>Fast and easy photo sharing from Google.</p>'+
		
			'<h4>Mobile App Features</h4>' +
			
			'<ul>' +
			
				'<li>Add your Picasa Web Albums to your mobile app</li>'+
				'<li>Albums display in a gallery and swipe-to-see-next photo stream</li>'+
				'<li>Double-tap to display photos at full-screen size</li>'+
			
			'</ul>', 
			
		
		types:			'photo',
		fields:			{
		
			component_behaviour:	'#wx-picasa-photo-url'
		
		}
	
	},
	{
	
		vertical:		'all',
		id:				'foursquare',
		name:			'Foursquare',
		component:		'foursquare',
		defaultTitle:	'Foursquare Photos',
		url:			'http://foursquare.com/',
		description:	'<p>Foursquare is a location-based social networking website for mobile devices. Users "check-in" at venues by selecting from a list of venues the app locates nearby. Each check-in awards the user points and sometimes "badges".</p>' +
		
			'<p>With Weever Apps, you can add a real-time photo stream for a Foursquare location.'+
			
			'<ul>'+
			
				    '<li>Add a real-time stream of user-generated Foursquare Venue Photos to your mobile app.</li>'+
				    '<li>Albums display in a swipe-to-see-next photo stream</li>'+
				    '<li>Double-tap to display photos at full-screen size</li>'+
				
			
			'</ul>',
			
		types:			'photo',
		labels:			{
		
			'photo':	new wx.labelText(null, 'This content will be displayed as a slideshow of photos')
		
		},
		fields:			{
		
			component_behaviour:	'#wx-foursquare-photo-url'
		
		},
		defaultValue:	{
		
			component_behaviour:	'https://foursquare.com/v/'
		
		}
	
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
		types:			'calendar',
		defaultTitle:	'Calendar',
		component:		'google.calendar',
		title:			true,
		fields:			{
		
			component_behaviour: 	'#wx-google-calendar-email'
		
		}
	
	},
	{
	
		id:				'blogger',
		name:			'Blogger',
		component:		'blogger',
		title:			true,
		defaultTitle:	'Our Blog',
		types:			'blog',
		fields:			{
		
			cms_feed: 	'#wx-add-blog-blogger-url-input'
		
		}
	
	},
	{
	
		id:				'identica',
		name:			'Identi.ca',
		component:		'identi.ca',
		description:	'<p>Identi.ca is a social microblogging service similar to Twitter, but built on open source tools and open standards.' +
					
					'<p>In Weever, you can display a search term or hashtag stream.</p>',
		types:			'social',
		defaultTitle:	'Identi.ca Status',
		fields:			{
		
			component_behaviour: 	'#wx-identica-social-value'
		
		}
	
	},
	{
	
		id:				'r3s',
		name:			'R3S Object',
		component:		'r3s',
		title:			true,
		types:			['blog', 'page', 'map', 'panel', 'directory', 'aboutapp', 'proximity'],
		component:		{
		
			'blog':			'blog',
			'directory':	'dir	ectory',
			'map':			'map',
			'proximity':	'proximity',
			'aboutapp':		'aboutapp',
			'page':			'page',
			'panel':		'panel'
		
		},
		fields:			{
		
			cms_feed: 	'#wx-add-page-r3s-url-input'
		
		}
	
	},
	{
	
		id:				'suggestion',
		name:			'What\'s Missing?'
	
	}

];
