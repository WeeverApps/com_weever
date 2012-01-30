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

	jQuery('#wx-select-calendar').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-calendar-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-calendar').attr('name', 'component');
		jQuery('.wx-calendar-help').hide();
		jQuery('.wx-calendar-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery('.wx-calendar-reveal').show();
		
		if(jQuery(this).val() == "google.calendar") 
		{
			jQuery('label#wx-google-calendar-email-label').show();
			jQuery('label#wx-facebook-calendar-url-label').hide();
			jQuery('div.wx-facebook-calendar-reveal').hide();
			jQuery('div.wx-google-calendar-reveal').show();
			jQuery('input#wx-google-calendar-email').val('');
			jQuery('input#wx-google-calendar-email').attr('placeholder', 'yourname@email.com');
			jQuery('input#wx-calendar-title').val('Google Calendar');
		}
		
		if(jQuery(this).val() == "facebook.events") 
		{
			jQuery('label#wx-facebook-calendar-url-label').show();
			jQuery('label#wx-google-calendar-email-label').hide();
			jQuery('div.wx-google-calendar-reveal').hide();
			jQuery('div.wx-facebook-calendar-reveal').show();
			jQuery('input#wx-facebook-calendar-url').val('');
			jQuery('input#wx-facebook-calendar-url').attr('placeholder', 'http://');
			jQuery('input#wx-calendar-title').val('Facebook Events');
		}
		
	});
	
});