<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
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
	<div class='wx-add-item-form wx-add-item-dropdown'>
		<select id='wx-select-form' class='wx-component-select'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_FORM_PARENTHESES'); ?></option>
			<option value='wufoo'><?php echo JText::_('WEEVER_ADD_WUFOO_FORM'); ?></option>
		</select>
                <label for="wx-select-form" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
                 title="<?php echo JText::_('WEEVER_ADD_FORM_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_ADD_FORM_HELP_LABEL'); ?></label>
	</div>
	
	<div class='wx-dummy wx-form-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-form-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>
	
	
	<div class='wx-add-item-value wx-form-reveal wx-reveal'>
		<input type='text' id='wx-form-url' class='wx-input wx-form-input' name='url' />
		<label for='wx-form-url'><?php echo JText::_('WEEVER_WUFOO_FORM_URL'); ?></label>
	</div>
	
	<div class='wx-add-item-value wx-form-reveal wx-reveal'>
		<input type='text' id='wx-form-api-key' class='wx-input wx-form-input' name='api_key' />
		<label for='wx-form-api-key'><?php echo JText::_('WEEVER_WUFOO_API_KEY'); ?></label>
	</div>
	
	<div class='wx-add-title wx-form-reveal wx-reveal'>
		<input type='text' value='' id='wx-form-title' class='wx-title wx-input wx-form-input' name='noname' />
        <label for='wx-form-title'><?php echo JText::_('WEEVER_FORM_TAB_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-form-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_FORM_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	


</div>