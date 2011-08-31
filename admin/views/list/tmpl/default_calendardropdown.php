<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
*	Version: 	0.9.3
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
	<div class='wx-add-item-calendar wx-add-item-dropdown'>
		<select id='wx-select-calendar' class='wx-component-select' name='noname'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_CALENDAR_PARENTHESES'); ?></option>
			<option value='google.calendar'>Add upcoming events from a Google Calendar</option>
			<option value='facebook.events'>Add upcoming events from a Facebook Profile</option>
		</select>
                <label for="wx-select-calendar" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
                 title="<?php echo JText::_('WEEVER_ADD_CALENDAR_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_ADD_CALENDAR_HELP_LABEL'); ?></label>
	</div>
	
	<div class='wx-dummy wx-calendar-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-calendar-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>
	
	
	<div class='wx-add-item-value wx-google-calendar-reveal wx-reveal'>
		<input type='text' value='yourname@email.com' id='wx-google-calendar-email' class='wx-calendar-input wx-input' name='email' />
		<label for='wx-google-calendar-email' id='wx-google-calendar-email-label'>Google Calendar Email</label>
	</div>
	
	<div class='wx-add-item-value wx-facebook-calendar-reveal wx-reveal'>
		<input type='text' value='http://' id='wx-facebook-calendar-url' class='wx-input wx-calendar-input' name='url' />
		<label for='wx-facebook-calendar-url' id='wx-facebook-calendar-url-label'>Facebook Profile URL</label>
	</div>
	
	<div class='wx-add-title wx-calendar-reveal wx-reveal'>
		<input type='text' value='' id='wx-calendar-title' class='wx-title wx-input' name='noname' />
                <label for='wx-calendar-title' id='wx-newcalendar-title' class='wx-calendar-label'><?php echo JText::_('WEEVER_CALENDAR_TAB_NAME'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-calendar-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_CALENDAR_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	


</div>