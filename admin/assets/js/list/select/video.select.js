/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.6.1
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

jQuery(document).ready(function(){ 

	jQuery('#wx-select-video').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-video-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-video').attr('name', 'component');
		jQuery('.wx-video-help').hide();
		jQuery('.wx-video-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');

		if(jQuery(this).val() == "youtube") 
		{
			jQuery('label#wx-youtube-url').show();
			jQuery('input#wx-video-url').val('');
			jQuery('input#wx-video-url').attr('placeholder', 'http://');
			jQuery('input#wx-video-title').val('YouTube');
		}
		
		if(jQuery(this).val() == "youtube.playlists") 
		{
			jQuery('label#wx-youtube-playlist-url').show();
			jQuery('input#wx-video-url').val('');
			jQuery('input#wx-video-url').attr('placeholder', 'http://');
			jQuery('input#wx-video-title').val('YouTube');
		}
		
		if(jQuery(this).val() == "vimeo") 
		{
			jQuery('label#wx-vimeo-url').show();
			jQuery('input#wx-video-url').val('');
			jQuery('input#wx-video-url').attr('placeholder', 'http://');
			jQuery('input#wx-video-title').val('Vimeo');
		}
		
		
		jQuery('.wx-video-reveal').show();
		
	});
	
});