<?php
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


defined('_JEXEC') or die;

?>
<div class="wx-add-ui formspacer">
	<div class='wx-add-item-page wx-add-item-dropdown'>
		<select id='wx-select-page'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_PAGE_PARENTHESES'); ?></option>
			<option value='menu'><?php echo JText::_('WEEVER_ADD_ARTICLE_OR_K2_ITEM_FROM_MENU'); ?></option>
			<option value='joomla-article'><?php echo JText::_('WEEVER_ADD_ARTICLE'); ?></option>
			<option value='k2-item'><?php echo JText::_('WEEVER_ADD_K2_ITEM'); ?></option>
			<option value='r3s-url'><?php echo JText::_('WEEVER_ADD_R3S_URL'); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-page-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-page-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>

	<div class='wx-add-item-value wx-page-reveal wx-reveal'>

		<div id='wx-add-page-menu-item'>
		
			<select name='unnamed' id='wx-add-page-menu-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_CONTENT_ITEM_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->menuItems as $k=>$v ) : ?>
					
					<option value='<?php echo $v->link; ?>'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>
			
		<div id="wx-add-page-r3s-url">
			<input type='text' value='' id='wx-add-page-r3s-url-input' class='wx-input wx-page-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_R3S_URL_PLACEHOLDER"); ?>' />
			<label for='wx-add-page-r3s-url-input' id='wx-add-page-r3s-url-input-label' class='wx-page-label'><?php echo JText::_('WEEVER_ADD_R3S_URL_LABEL'); ?></label>
		</div>
	
		<div id='wx-add-page-k2-item'>
				
			<div class="button2-left" style='float:right;'>
				<div class="blank">
					<a class="modal page-k2-modal" title="<?php echo JText::_('WEEVER_PAGE_SELECT_K2_ITEM'); ?>"  href="index.php?option=com_k2&amp;view=items&amp;task=element&amp;tmpl=component&amp;object=id" rel="{handler: 'iframe', size: {x: 700, y: 450}}"><?php echo JText::_('WEEVER_PAGE_SELECT'); ?></a>
				</div>
			</div>
		
		</div>
		
		<div id='wx-add-page-content-joomla'>
				
			<div class="button2-left">
				<div class="blank">
					<a class="modal" title="Select a Joomla article"  href="<?php echo $this->jArticleLink; ?>" rel="{handler: 'iframe', size: {x: 700, y: 450}}">select</a>
				</div>
			</div>
		
		</div>
		
		<div id='wx-add-page-content-input-fields'>
			
				<input type="text" id="id_name-page" placeholder="Select content..." class='wx-input wx-page-input wx-page-content-name' disabled="disabled" />
				
				<input type="hidden" id="id_id-page" class="wx-page-input" name="urlparams[id]" value="0" />
				<label id="urlparamsid-lbl" for="urlparamsid" class="hasTip" title="Select Item::Select an item to link to directly.">Select Content</label>
		
		</div>
	
	</div>
	
	<div class='wx-add-title wx-page-reveal wx-reveal'>
		<input type='text' value='' id='wx-page-title' class='wx-title wx-input wx-page-input' name='noname' />
		<label for='wx-page-title'><?php echo JText::_('WEEVER_CUSTOM_PAGE_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-page-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_PAGE_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	
	


</div>