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
	<div class='wx-add-item-social wx-add-item-dropdown'>
		<select id='wx-select-social' name='noname' class='wx-component-select'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_SOCIAL_NETWORK_PARENTHESES'); ?></option>
			<option value='twitteruser'><?php echo JText::_('WEEVER_TWITTER_USER_STREAM'); ?></option>
			<option value='twitterhashtag'><?php echo JText::_('WEEVER_TWITTER_HASHTAGS'); ?></option>
			<option value='twitterquery'><?php echo JText::_('WEEVER_TWITTER_QUERY'); ?></option>
			<option value='identi.ca'><?php echo JText::_('WEEVER_INDENTICA_QUERY'); ?></option>
			<option value='facebook'><?php echo JText::_('WEEVER_FACEBOOK_PAGE_WALL'); ?></option>
		</select>
	</div>
	
	<div class='wx-dummy wx-social-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-dummy wx-social-dummy'>
		<input type='text' disabled='disabled' placeholder='<?php echo JText::_('WEEVER_INPUT'); ?>' />
	</div>

	
	<div class='wx-social-value wx-social-reveal wx-reveal'>
		<input type='text' value='' class='wx-input wx-social-input' id='wx-social-value' name='component_behaviour' />
		<label for='wx-social-value' id='wx-twitter-user' class='wx-social-label'><?php echo JText::_('WEEVER_TWITTER_USER'); ?></label>
		<label for='wx-social-value' id='wx-twitter-hashtag' class='wx-social-label'><?php echo JText::_('WEEVER_TWITTER_HASHTAG'); ?></label>
		<label for='wx-social-value' id='wx-twitter-query' class='wx-social-label'><?php echo JText::_('WEEVER_TWITTER_QUERY'); ?></label>
		<label for='wx-social-value' id='wx-identica-query' class='wx-social-label'><?php echo JText::_('WEEVER_IDENTICA_QUERY'); ?></label>
		<label for='wx-social-value' id='wx-facebook-url' class='wx-social-label'><?php echo JText::_('WEEVER_FACEBOOK_URL'); ?></label>
	</div>

	<div class='wx-add-title wx-social-reveal wx-reveal'>
		<input type='text' value='' class='wx-title wx-input wx-social-input' id='wx-social-title' name='noname' />
		<label for='wx-social-title'><?php echo JText::_('WEEVER_SOCIAL_NETWORK_TAB_NAME'); ?></label>
	</div>
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-social-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_SOCIAL_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>

	

</div>