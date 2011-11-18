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
<div class="wx-add-ui formspacer">
	<div class='wx-add-item-listingcomponent wx-add-item-dropdown'>
		<select id='wx-select-listingcomponent'>
			<option value='0'>(Add an unsupported component)</option>
			<option value='1'>Add a Joomla component (experimental)</option>
			<option value='2'>Add an eventlist venue</option>
		</select>
	</div>
	
	<div class='wx-add-item-value wx-listingcomponent-reveal wx-reveal'>
		<select class='wx-input'>
			<option value='1'>Option A</option>
			<option value='2'>Option B</option>
		</select>
	</div>
	
	<div class='wx-add-title wx-listingcomponent-reveal wx-reveal'>
		<input type='text' value='' id='wx-listingcomponent-title' class='wx-title wx-input' name='noname' />
	</div>
	
	<div class='wx-add-submit wx-listingcomponent-reveal wx-reveal'>
		<input type='submit' id='wx-listingcomponent-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_LISTINGCOMPONENT_SUBMIT'); ?>' name='add' />
	</div>
	
	<div class='wx-add-item-value-help wx-listingcomponent-reveal wx-reveal'>
	<?php echo JText::_('WEEVER_ADD_LISTINGCOMPONENT_HELP'); ?>
	</div>

</div>