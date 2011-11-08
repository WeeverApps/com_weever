<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.1
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
	<div class='wx-add-item-map wx-add-item-dropdown'>
		<select id='wx-select-map'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_MAP_PARENTHESES'); ?></option>
			<option value='k2-cat'><?php echo JText::_('WEEVER_ADD_MAP_FROM_K2_CATEGORY'); ?></option>
			<option value='k2-tags'><?php echo JText::_('WEEVER_ADD_MAP_FROM_K2_TAGS'); ?></option>
			<option value='k2'><?php echo JText::_('WEEVER_ADD_MAP_K2_ITEM'); ?></option>
			<option value='' disabled='disabled'>----------------</option>
			<option value='settings'><?php echo JText::_('WEEVER_MAP_SETTINGS'); ?></option>
		</select>
		<label for="wx-select-map" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
		 title="<?php echo JText::_('WEEVER_ADD_MAP_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_ADD_MAP_HELP_LABEL'); ?></label>
	</div>
	
	<div class='wx-dummy wx-map-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-add-item-option wx-map-reveal wx-reveal'>
		
		<?php echo $this->mapK2CategoryDropdown;?>
		
		<div id="wx-add-map-k2-tag">
		<input type='text' value='' id='wx-add-map-k2-tag-input' class='wx-input wx-map-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_K2_TAG_PLACEHOLDER"); ?>' />
		<label for='wx-add-map-k2-tag-input' id='wx-add-map-k2-tag-input-label' class='wx-map-label'><?php echo JText::_('WEEVER_ADD_MAP_K2_TAG'); ?></label>
		</div>
		
		<div id='wx-add-map-k2-item'>
		
			<div class="button2-left" style='float:right;'>
				<div class="blank">
					<a class="modal map-k2-modal" title="<?php echo JText::_('WEEVER_MAP_SELECT_K2_ITEM'); ?>"  href="index.php?option=com_k2&amp;view=items&amp;task=element&amp;tmpl=component&amp;object=id" rel="{handler: 'iframe', size: {x: 700, y: 450}}"><?php echo JText::_('WEEVER_MAP_SELECT'); ?></a>
				</div>
			</div>
			
			<input type="text" id="id_name-map" placeholder="Select content..." class='wx-input wx-map-input' disabled="disabled" />
			
			<input type="hidden" id="id_id-map" class="wx-map-input" name="urlparams[id]" value="0" />
			<label id="urlparamsid-lbl" for="urlparamsid" class="hasTip" title="<?php echo JText::_('WEEVER_MAP_SELECT_ARTICLE_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_MAP_SELECT_CONTENT'); ?></label>

		</div>
						
						
	
	</div>
	
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-map-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_MAP_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	

</div>