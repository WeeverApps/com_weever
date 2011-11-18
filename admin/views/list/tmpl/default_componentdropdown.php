<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9
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
	<div class='wx-add-item-component wx-add-item-dropdown'>
		<select id='wx-select-component'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_COMPONENT_PARENTHESES'); ?></option>
			<option value='1'>Add a blog from Joomla menu</option>
			<option value='2'>Add a blog from Joomla category</option>
		</select>
                <label for="wx-select-component" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
                 title="<?php echo JText::_('WEEVER_ADD_COMPONENT_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_ADD_COMPONENT_HELP_LABEL'); ?></label>
	</div>
	
	<div class='wx-dummy wx-component-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-component-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>
	
	
	<div class='wx-add-item-value wx-component-reveal wx-reveal'>
		<input type='text' value='http://' id='component-url' class='wx-input' name='url' />
		<label for='component-url'>Component URL</label>
	</div>
	
	<div class='wx-add-title wx-component-reveal wx-reveal'>
		<input type='text' value='' id='wx-component-title' class='wx-title wx-input' name='noname' />
                <label for='wx-component-title' id='wx-newcomponent-title' class='wx-component-label'><?php echo JText::_('WEEVER_COMPONENT_TAB_NAME'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-component-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_COMPONENT_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	


</div>