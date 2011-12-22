<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.4
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
<div class="wx-add-ui formspacer">
	<div class='wx-add-item-page wx-add-item-dropdown'>
		<select id='wx-select-page'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_PAGE_PARENTHESES'); ?></option>
			<option value='menu'><?php echo JText::_('WEEVER_ADD_ARTICLE_OR_K2_ITEM_FROM_MENU'); ?></option>
			<option value='r3s-url'><?php echo JText::_('WEEVER_ADD_R3S_URL'); ?></option>
			<!--option value='page-cat'><?php echo JText::_('WEEVER_ADD_WHOLE_CATEGORY_OF_ARTICLES_AS_LIST'); ?></option>
			<option value='page-cat-k2'><?php echo JText::_('WEEVER_ADD_WHOLE_CATEGORY_OF_K2_ITEMS_AS_LIST'); ?></option-->
		</select>
	</div>
	
	<div class='wx-dummy wx-page-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-page-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>

	<div class='wx-add-item-value wx-page-reveal wx-reveal'>
	
		<?php echo $this->pageMenuDropdown; ?>
		
		<div id="wx-add-page-r3s-url">
			<input type='text' value='' id='wx-add-page-r3s-url-input' class='wx-input wx-page-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_R3S_URL_PLACEHOLDER"); ?>' />
			<label for='wx-add-page-r3s-url-input' id='wx-add-page-r3s-url-input-label' class='wx-page-label'><?php echo JText::_('WEEVER_ADD_R3S_URL_LABEL'); ?></label>
		</div>
	
		<?php //echo $this->pageJCategoryDropdown; 
		?>
		
		<?php //echo $this->pageK2CategoryDropdown; 
		?>
	
	</div>
	
	<div class='wx-add-title wx-page-reveal wx-reveal'>
		<input type='text' value='' id='wx-page-title' class='wx-title wx-input wx-page-input' name='noname' />
		<label for='wx-page-title'><?php echo JText::_('WEEVER_CUSTOM_PAGE_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-page-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_PAGE_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	
	


</div>