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
<div class="wx-add-ui">
	<div class='wx-add-item-photo wx-add-item-dropdown'>
		<select id='wx-select-photo' class='wx-component-select' name='noname'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_PHOTO_FEED_PARENTHESES'); ?></option>
			<option value='flickr'><?php echo JText::_('WEEVER_FLICKR_FEED'); ?></option>
			<option value='google.picasa'><?php echo JText::_('WEEVER_GOOGLE_PICASA_FEED'); ?></option>
			<option value='foursquare'><?php echo JText::_('WEEVER_FOURSQUARE_VENUE_FEED'); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-photo-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-photo-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>
	
	
	<div class='wx-add-photo-value wx-photo-reveal wx-reveal'>
		<input type='text' value='' id='wx-photo-url' class='wx-input wx-photo-input' name='url' />
		<label for='wx-photo-url' id='wx-foursquare-url' class='wx-photo-label'><?php echo JText::_('WEEVER_FOURSQUARE_URL'); ?></label>
		<label for='wx-photo-url' id='wx-flickr-url' class='wx-photo-label'><?php echo JText::_('WEEVER_FLICKR_URL'); ?></label>
		<label for='wx-photo-url' id='wx-google-picasa-email' class='wx-photo-label'><?php echo JText::_('WEEVER_GOOGLE_PICASA_EMAIL'); ?></label>
	</div>
	
	<div class='wx-add-title wx-photo-reveal wx-reveal'>
		<input type='text' value='' id='wx-photo-title' class='wx-title wx-input wx-photo-input' name='noname' />
		<label for='wx-photo-title'><?php echo JText::_('WEEVER_FEED_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-photo-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_PHOTO_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	
   
	

</div>