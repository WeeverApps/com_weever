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
	
	jQuery('#wx-select-blog').change(function() {
	
		jQuery('.wx-title').attr('name','noname');
		jQuery('#wx-blog-title').attr('name','name');
		jQuery('.wx-cms-feed-select').attr('name','noname');
		jQuery('.wx-blog-help').hide();
		jQuery('.wx-dummy').hide();
		jQuery('.wx-submit').attr('disabled', 'disabled');
		
		jQuery('#wx-add-blog-menu-item').hide();
		jQuery('#wx-add-blog-menu-item-select').attr('name', 'unnamed');
		jQuery('#wx-add-blog-jcategory-item').hide();
		jQuery('#wx-add-blog-jcategory-item-select').attr('name', 'unnamed');
		jQuery('#wx-add-blog-k2-category-item').hide();
		jQuery('#wx-add-blog-k2-category-item-select').attr('name', 'unnamed');
		jQuery('#wx-add-blog-k2-tag').hide();
		jQuery('#wx-add-blog-k2-tag-input').attr('name', 'unnamed');
		jQuery('#wx-add-blog-r3s-url').hide();
		jQuery('#wx-add-blog-r3s-url-input').attr('name', 'unnamed');
	
		if(jQuery(this).val() == "menu") 
		{
			jQuery('#wx-add-blog-menu-item').show();
			jQuery('#wx-add-blog-menu-item-select').attr('name', 'cms_feed');		
		}
		
		if(jQuery(this).val() == "content-cat") 
		{			
			jQuery('#wx-add-blog-jcategory-item').show();
			jQuery('#wx-add-blog-jcategory-item-select').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "k2-cat") 
		{
			jQuery('#wx-add-blog-k2-category-item').show();
			jQuery('#wx-add-blog-k2-category-item-select').attr('name', 'cms_feed');
		}
		
		if(jQuery(this).val() == "k2-tags") 
		{
			jQuery('#wx-add-blog-k2-tag').show();
			jQuery('#wx-add-blog-k2-tag-input').attr('name', 'tag');
		}
		
		if(jQuery(this).val() == "r3s-url")
		{
			jQuery('#wx-add-blog-r3s-url').show();
			jQuery('#wx-add-blog-r3s-url-input').attr('name', 'cms_feed');
		}
			
		jQuery('.wx-blog-reveal').show();
		
	});
});