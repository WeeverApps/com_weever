<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.0
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
	<div class='wx-add-item-aboutapp wx-add-item-dropdown'>
		<select id='wx-select-aboutapp'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_ABOUTAPP_PARENTHESES'); ?></option>
			<option value='content'><?php echo JText::_('WEEVER_ADD_ARTICLE'); ?></option>
			<option value='k2'><?php echo JText::_('WEEVER_ADD_K2_ITEM'); ?></option>
			<!--option value='page-cat'><?php echo JText::_('WEEVER_ADD_WHOLE_CATEGORY_OF_ARTICLES_AS_LIST'); ?></option>
			<option value='page-cat-k2'><?php echo JText::_('WEEVER_ADD_WHOLE_CATEGORY_OF_K2_ITEMS_AS_LIST'); ?></option-->
		</select>
	</div>
		
	<div class='wx-dummy wx-aboutapp-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-aboutapp-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>

	<div class='wx-add-item-value wx-aboutapp-reveal wx-reveal'>
	
		<div id='wx-add-aboutapp-k2-item'>
		
			<div class="button2-left" style='float:right;'>
				<div class="blank">
					<a class="modal" title="Select an item"  href="index.php?option=com_k2&amp;view=items&amp;task=element&amp;tmpl=component&amp;object=id" rel="{handler: 'iframe', size: {x: 700, y: 450}}">select</a>
				</div>
			</div>
			

		</div>
		
		
		<div id='wx-add-aboutapp-content-joomla'>
		
			<div class="button2-left" style='float:right;'>
				<div class="blank">
					<a class="modal" title="Select a Joomla article"  href="index.php?option=com_content&amp;task=element&amp;tmpl=component&amp;object=id" rel="{handler: 'iframe', size: {x: 700, y: 450}}">select</a>
				</div>
			</div>

		</div>
		
		<input type="text" id="id_name-aboutapp" placeholder="Select content..." class='wx-input wx-aboutapp-input' disabled="disabled" />
		
		<input type="hidden" id="id_id-aboutapp" class="wx-aboutapp-input" name="urlparams[id]" value="0" />
		<label id="urlparamsid-lbl" for="urlparamsid" class="hasTip" title="Select Item::Select an item to link to directly.">Select Content</label>
		
		
		<?php //echo $this->pageK2CategoryDropdown; 
		?>
	
	</div>
	
	<div class='wx-add-title wx-aboutapp-reveal wx-reveal'>
		<input type='text' value='' id='wx-aboutapp-title' class='wx-title wx-input wx-aboutapp-input' name='noname' />
		<label for='wx-aboutapp-title'><?php echo JText::_('WEEVER_CUSTOM_ABOUTAPP_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-aboutapp-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_ABOUTAPP_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	
	


</div>