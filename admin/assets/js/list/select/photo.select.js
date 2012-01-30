/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.5.1
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
	
	jQuery('#wx-select-photo').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-photo-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-photo').attr('name', 'component');
		jQuery('.wx-photo-help').hide();
		jQuery('.wx-photo-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		if(jQuery(this).val() == "flickr") 
		{
			jQuery('#wx-add-photo-flickr-help').show();
			jQuery('label#wx-flickr-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://');
			jQuery('input#wx-photo-title').val('Flickr Latest');
		}
		
		if(jQuery(this).val() == "flickr.photosets") 
		{
			jQuery('label#wx-flickr-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://');
			jQuery('input#wx-photo-title').val('Flickr');
		}
		
		if(jQuery(this).val() == "foursquare") 
		{
			jQuery('#wx-add-photo-foursquare-help').show();
			jQuery('label#wx-foursquare-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://');
			jQuery('input#wx-photo-title').val('Foursquare');
		}
		
		if(jQuery(this).val() == "google.picasa") 
		{
			jQuery('label#wx-google-picasa-email').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'https://picasa… OR you@gmail.com');
			jQuery('input#wx-photo-title').val('Picasa');
		}
		
		if(jQuery(this).val() == "facebook.photos")
		{
			jQuery('label#wx-facebook-photos-url').show();
			jQuery('input#wx-photo-url').val('');
			jQuery('input#wx-photo-url').attr('placeholder', 'http://facebook.com/yourprofile');
			jQuery('input#wx-photo-title').val('Facebook');		
		}
		
		jQuery('.wx-photo-reveal').show();
		
	});
});