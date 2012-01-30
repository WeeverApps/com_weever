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
	
	jQuery('#wx-select-page').change(function() {

		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-page-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-page-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		jQuery("#id_id.wx-panel-input").attr("id", "id_id-panel");
		jQuery("#id_name.wx-panel-input").attr("id", "id_name-panel");
		jQuery("#id_id.wx-map-input").attr("id", "id_id-map");
		jQuery("#id_name.wx-map-input").attr("id", "id_name-map");
		jQuery("#id_id-aboutapp").attr("id", "id_id-aboutapp");
		jQuery("#id_name-aboutapp").attr("id", "id_name-aboutapp");
		jQuery("#id_id-page").attr("id", "id_id");
		jQuery("#id_name-page").attr("id", "id_name");
		
		jQuery('#wx-add-page-content-joomla').hide();
		jQuery('#wx-add-page-k2-item').hide();
		jQuery('#wx-add-page-content-input-fields').hide();
		jQuery('#wx-add-page-r3s-url').hide();
		jQuery('#wx-add-page-r3s-url-input').attr('name', 'unnamed');
		jQuery('#wx-add-page-menu-item').hide();
		jQuery('#wx-add-page-menu-item-select').attr('name', 'unnamed');
		jQuery('#wx-add-page-menu-item-help').hide();
		
		if(jQuery(this).val() == "menu") 
		{
			jQuery('#wx-add-page-menu-item').show();
			jQuery('#wx-add-page-menu-item-select').attr('name', 'cms_feed');
			jQuery('#wx-add-page-menu-item-help').show();	
		}
		
		if(jQuery(this).val() == "k2-item")
		{
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-page-k2-item').show();
			jQuery('#wx-add-page-content-input-fields').show();	
		}
		
		if(jQuery(this).val() == "joomla-article")
		{
			jQuery('#wx-add-page-content-joomla').show();
			jQuery('#id_id').attr('name', 'cms_feed');
			jQuery('#wx-add-page-content-input-fields').show();
		}
		
		if(jQuery(this).val() == "r3s-url") 
		{
			jQuery('#wx-add-page-r3s-url').show();
			jQuery('#wx-add-page-r3s-url-input').attr('name', 'cms_feed');
		}
		
		jQuery('.wx-page-reveal').show();
		
	});
	
});