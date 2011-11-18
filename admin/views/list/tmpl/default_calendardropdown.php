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
<div class="wx-add-ui formspacer">
	<div class='wx-add-item-calendar wx-add-item-dropdown'>
		<select id='wx-select-calendar' class='wx-component-select' name='noname'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_CALENDAR_PARENTHESES'); ?></option>
			<option value='google.calendar'><?php echo JText::_('WEEVER_ADD_NEW_GOOGLE_CALENDAR'); ?></option>
			<option value='facebook.events'><?php echo JText::_('WEEVER_ADD_NEW_FACEBOOK_EVENTS'); ?></option>
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
		<label for='wx-google-calendar-email' id='wx-google-calendar-email-label'><?php echo JText::_('WEEVER_GOOGLE_CALENDAR_EMAIL_ID'); ?></label>
	</div>
	
	<div class='wx-add-item-value wx-facebook-calendar-reveal wx-reveal'>
		<input type='text' value='http://' id='wx-facebook-calendar-url' class='wx-input wx-calendar-input' name='url' />
		<label for='wx-facebook-calendar-url' id='wx-facebook-calendar-url-label'><?php echo JText::_('WEEVER_FACEBOOK_PROFILE_URL'); ?></label>
	</div>
	
	<div class='wx-add-item-timezone wx-facebook-calendar-reveal wx-reveal'>
		<select id='wx-select-facebook-timezone-time' name='noname'>
			<option value="<?php echo date_default_timezone_get(); ?>"><?php echo date_default_timezone_get(); ?> [current server setting]</option>
			<option value="<?php echo date_default_timezone_get(); ?>">-----------------------------</option>
			<option value="Etc/GMT+12">Etc/GMT+12</option>
			<option value="Pacific/Pago_Pago">Pacific/Pago_Pago</option>
			<option value="America/Adak">America/Adak</option>
			<option value="Pacific/Apia">Pacific/Apia</option>
			<option value="Pacific/Honolulu">Pacific/Honolulu</option>
			<option value="Pacific/Marquesas">Pacific/Marquesas</option>
			<option value="Pacific/Gambier">Pacific/Gambier</option>
			<option value="America/Anchorage">America/Anchorage</option>
			<option value="America/Los_Angeles">America/Los_Angeles</option>
			<option value="Pacific/Pitcairn">Pacific/Pitcairn</option>
			<option value="America/Phoenix">America/Phoenix</option>
			<option value="America/Denver">America/Denver</option>
			<option value="America/Guatemala">America/Guatemala</option>
			<option value="America/Chicago">America/Chicago</option>
			<option value="Pacific/Easter">Pacific/Easter</option>
			<option value="America/Bogota">America/Bogota</option>
			<option value="America/New_York">America/New_York</option>
			<option value="America/Caracas">America/Caracas</option>
			<option value="America/Halifax">America/Halifax</option>
			<option value="America/Santo_Domingo">America/Santo_Domingo</option>
			<option value="America/Asuncion">America/Asuncion</option>
			<option value="America/St_Johns">America/St_Johns</option>
			<option value="America/Godthab">America/Godthab</option>
			<option value="America/Argentina/Buenos_Aires">America/Argentina/Buenos_Aires</option>
			<option value="America/Montevideo">America/Montevideo</option>
			<option value="America/Noronha">America/Noronha</option>
			<option value="Etc/GMT+2">Etc/GMT+2</option>
			<option value="Atlantic/Azores">Atlantic/Azores</option>
			<option value="Atlantic/Cape_Verde">Atlantic/Cape_Verde</option>
			<option value="Etc/UTC">Etc/UTC</option>
			<option value="Europe/London">Europe/London</option>
			<option value="Europe/Berlin">Europe/Berlin</option>
			<option value="Africa/Lagos">Africa/Lagos</option>
			<option value="Africa/Windhoek">Africa/Windhoek</option>
			<option value="Asia/Beirut">Asia/Beirut</option>
			<option value="Africa/Johannesburg">Africa/Johannesburg</option>
			<option value="Europe/Moscow">Europe/Moscow</option>
			<option value="Asia/Baghdad">Asia/Baghdad</option>
			<option value="Asia/Tehran">Asia/Tehran</option>
			<option value="Asia/Dubai">Asia/Dubai</option>
			<option value="Asia/Yerevan">Asia/Yerevan</option>
			<option value="Asia/Kabul">Asia/Kabul</option>
			<option value="Asia/Yekaterinburg">Asia/Yekaterinburg</option>
			<option value="Asia/Karachi">Asia/Karachi</option>
			<option value="Asia/Kolkata">Asia/Kolkata</option>
			<option value="Asia/Kathmandu">Asia/Kathmandu</option>
			<option value="Asia/Dhaka">Asia/Dhaka</option>
			<option value="Asia/Omsk">Asia/Omsk</option>
			<option value="Asia/Rangoon">Asia/Rangoon</option>
			<option value="Asia/Krasnoyarsk">Asia/Krasnoyarsk</option>
			<option value="Asia/Jakarta">Asia/Jakarta</option>
			<option value="Asia/Shanghai">Asia/Shanghai</option>
			<option value="Asia/Irkutsk">Asia/Irkutsk</option>
			<option value="Australia/Eucla">Australia/Eucla</option>
			<option value="Asia/Yakutsk">Asia/Yakutsk</option>
			<option value="Asia/Tokyo">Asia/Tokyo</option>
			<option value="Australia/Darwin">Australia/Darwin</option>
			<option value="Australia/Adelaide">Australia/Adelaide</option>
			<option value="Australia/Brisbane">Australia/Brisbane</option>
			<option value="Asia/Vladivostok">Asia/Vladivostok</option>
			<option value="Australia/Sydney">Australia/Sydney</option>
			<option value="Australia/Lord_Howe">Australia/Lord_Howe</option>
			<option value="Asia/Kamchatka">Asia/Kamchatka</option>
			<option value="Pacific/Noumea">Pacific/Noumea</option>
			<option value="Pacific/Norfolk">Pacific/Norfolk</option>
			<option value="Pacific/Auckland">Pacific/Auckland</option>
			<option value="Pacific/Tarawa">Pacific/Tarawa</option>
			<option value="Pacific/Chatham">Pacific/Chatham</option>
			<option value="Pacific/Tongatapu">Pacific/Tongatapu</option>
			<option value="Pacific/Kiritimati">Pacific/Kiritimati</option>
		</select>
		<label for="wx-select-facebook-timezone-time"><?php echo JText::_('WEEVER_TIMEZONE_OF_EVENT_CALENDAR'); ?></label>
	</div>

	
	<div class='wx-add-title wx-calendar-reveal wx-reveal'>
		<input type='text' value='' id='wx-calendar-title' class='wx-title wx-input' name='noname' />
                <label for='wx-calendar-title' id='wx-newcalendar-title' class='wx-calendar-label'><?php echo JText::_('WEEVER_FEED_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-calendar-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_CALENDAR_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
	


</div>