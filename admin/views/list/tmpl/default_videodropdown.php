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

	<div class='wx-add-item-video wx-add-item-dropdown'>
		<select id='wx-select-video' class='wx-component-select' name='noname'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_VIDEO_FEED_PARENTHESES'); ?></option>
			<option value='youtube'><?php echo JText::_('WEEVER_VIDEO_YOUTUBE_CHANNEL'); ?></option>
			<option value='vimeo'><?php echo JText::_('WEEVER_VIDEO_VIMEO_CHANNEL'); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-video-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-video-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>
	
	<div class='wx-add-item-value wx-video-reveal wx-reveal'>
		<input type='text' value='' placeholder='http://' name='component_behaviour' id='wx-video-url' class='wx-input wx-video-input' />
		<label for='wx-video-url' id='wx-vimeo-url' class='wx-video-label'><?php echo JText::_('WEEVER_VIMEO_URL'); ?></label>
		<label for='wx-video-url' id='wx-youtube-url' class='wx-video-label'><?php echo JText::_('WEEVER_YOUTUBE_URL'); ?></label>
	</div>
	

	<div class='wx-add-title wx-video-reveal wx-reveal'>
		<input type='text' value='' id='wx-video-title' class='wx-title wx-input wx-video-input' name='noname' />
		<label for='wx-video-title'><?php echo JText::_('WEEVER_VIDEO_FEED_TITLE'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-video-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_VIDEO_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	

</div>