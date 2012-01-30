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

	jQuery('#wx-select-form').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-form-title').attr('name','name');
		jQuery('.wx-component-select').attr('name', 'noname');
		jQuery('#wx-select-form').attr('name', 'component');
		jQuery('.wx-form-help').hide();
		jQuery('.wx-form-label').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		jQuery('.wx-form-reveal').show();
		
		if(jQuery(this).val() == "wufoo") 
		{
			jQuery('input#wx-form-url').attr('placeholder', 'http://');
			jQuery('input#wx-form-api-key').attr('placeholder', 'WXYZ-1234-ABCD-9876');
		}
		
	});
	
});