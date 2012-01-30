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

	jQuery('#wx-select-social').change(function() {
		
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-social-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-social').attr('name', 'component');
		jQuery('.wx-social-help').hide();
		jQuery('.wx-social-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		if(jQuery(this).val() == "twitteruser") 
		{
			jQuery('#wx-add-social-twitter-user-help').show();
			jQuery('label#wx-twitter-user').show();
			jQuery('input#wx-social-value').val('@');
			jQuery('input#wx-social-title').val('Twitter');
			jQuery('input#wx-social-value').attr('placeholder', '');
		}
		
		if(jQuery(this).val() == "twitterhashtag") 
		{
			jQuery('#wx-add-social-twitter-hashtag-help').show();
			jQuery('label#wx-twitter-hashtag').show();
			jQuery('input#wx-social-value').val('#');
			jQuery('input#wx-social-title').val('Twitter');
			jQuery('input#wx-social-value').attr('placeholder', '');
		}
		
		if(jQuery(this).val() == "twitterquery") 
		{
			jQuery('#wx-add-social-twitter-query-help').show();
			jQuery('label#wx-twitter-query').show();
			jQuery('input#wx-social-value').val('');
			jQuery('input#wx-social-title').val('Twitter');
			jQuery('input#wx-social-value').attr('placeholder', '');
		}
		
		if(jQuery(this).val() == "identi.ca") 
		{
			jQuery('#wx-add-social-identica-query-help').show();
			jQuery('label#wx-identica-query').show();
			jQuery('input#wx-social-value').val('');
			jQuery('input#wx-social-value').attr('placeholder', '');
			jQuery('input#wx-social-title').val('Identi.ca');
		}
		
		if(jQuery(this).val() == "facebook") 
		{
			jQuery('#wx-add-social-facebook-help').show();
			jQuery('label#wx-facebook-url').show();
			jQuery('input#wx-social-value').val('');
			jQuery('input#wx-social-value').attr('placeholder', 'http://');
			jQuery('input#wx-social-title').val('Facebook');
		}
		
		jQuery('.wx-social-reveal').show();
		
	});
	
});