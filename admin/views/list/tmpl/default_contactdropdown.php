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
	<div class='wx-add-item-contact wx-add-item-dropdown'>
		<select id='wx-select-contact'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_CONTACT_PARENTHESES'); ?></option>
			<option value='jcontact'><?php echo JText::_('WEEVER_ADD_NEW_CONTACT_JOOMLA'); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-contact-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-contact-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>

	
	<div class='wx-add-item-value wx-contact-reveal wx-reveal'>
	
		<?php echo $this->jContactDropdown; ?>
                <label><?php echo JText::_('WEEVER_CONTACT_CHOOSE'); ?></label>
	
	</div>
	
	<div class='wx-add-title wx-contact-reveal wx-reveal'>
		<input type='text' value='' id='wx-contact-title' class='wx-title wx-input wx-contact-input' name='noname' />
		<label for='wx-contact-title'><?php echo JText::_('WEEVER_CONTACT_NAME'); ?></label>
	</div>
	
	<div class='wx-contact-options wx-contact-reveal wx-reveal'>
		<input type="checkbox" name="emailform" id="wx-contact-option-email-form" value="1" /> 
		<label for="wx-contact-option-email-form" class="key hasTip" title="<?php echo JText::_('WEEVER_CONTACT_USE_FORM_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CONTACT_USE_FORM'); ?></label>
		<br/>
		<input type="checkbox" name="googlemaps" id="wx-contact-option-google-maps" value="1" /> 
		<label for="wx-contact-option-google-maps"><?php echo JText::_('WEEVER_CONTACT_SHOW_GOOGLEMAPS'); ?></label>
		<br/>
		<input type="checkbox" name="showimage" id="wx-contact-option-show-image" value="1" /> 
		<label for="wx-contact-option-show-image"><?php echo JText::_('WEEVER_CONTACT_SHOW_IMAGE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-contact-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_CONTACT_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	



</div>	