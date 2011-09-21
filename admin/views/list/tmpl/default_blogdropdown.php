<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.2
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

defined('_JEXEC') or die;

?>
<div class="wx-add-ui">
	<div class='wx-add-item-blog wx-add-item-dropdown'>
		<select id='wx-select-blog'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_BLOG_PARENTHESES'); ?></option>
			<option value='menu'><?php echo JText::_('WEEVER_ADD_BLOG_FROM_MENU'); ?></option>
			<option value='content-cat'><?php echo JText::_('WEEVER_ADD_BLOG_FROM_JCATEGORY'); ?></option>
			<option value='k2-cat'><?php echo JText::_('WEEVER_ADD_BLOG_FROM_K2_CATEGORY'); ?></option>
			<option value='k2-tags'><?php echo JText::_('WEEVER_ADD_BLOG_FROM_K2_TAGS'); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-blog-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-blog-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>
	
	<div class='wx-add-item-option wx-blog-reveal wx-reveal'>
	
		<?php echo $this->blogMenuDropdown; ?> 
		
		<?php echo $this->blogJCategoryDropdown;?>
		
		<?php echo $this->blogK2CategoryDropdown;?>
		
		<div id="wx-add-blog-k2-tag">
		<input type='text' value='' id='wx-add-blog-k2-tag-input' class='wx-input wx-blog-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_K2_TAG_PLACEHOLDER"); ?>' />
		<label for='wx-add-blog-k2-tag-input' id='wx-add-blog-k2-tag-input-label' class='wx-blog-label'><?php echo JText::_('WEEVER_ADD_BLOG_K2_TAG'); ?></label>
		</div>
	
	</div>
	
	<div class='wx-add-title wx-blog-reveal wx-reveal'>
	
		<input type='text' id='wx-blog-title' value='' class='wx-title wx-input wx-blog-input' name='noname' />
		<label for='wx-blog-title'><?php echo JText::_('WEEVER_BLOG_TAB_NAME'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-blog-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_BLOG_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	

</div>