<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.5.1
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

$jOptions = "";

if( comWeeverHelper::componentExists("com_k2") )
{

	$k2Options = "<option value='k2-cat'>".JText::_('WEEVER_ADD_PROXIMITY_FROM_K2_CATEGORY')."</option>
	<option value='k2-tags'>".JText::_('WEEVER_ADD_PROXIMITY_FROM_K2_TAGS')."</option>";

}
else 
{

	$k2Options = "<option value='' disabled='disabled'>K2 must be installed to build maps with Weever</option>";

}

if( comWeeverHelper::joomlaVersion() != "1.5" )
{

	$jOptions = "<option value='joomla-category'>".JText::_('WEEVER_ADD_PROXIMITY_FROM_CATEGORY')."</option>";

}

?>
<div class="wx-add-ui formspacer">
	<div class='wx-add-item-proximity wx-add-item-dropdown'>
		<select id='wx-select-proximity'>
			<option value='0'><?php echo JText::_('WEEVER_ADD_NEW_PROXIMITY_PARENTHESES'); ?></option>
			<?php echo $jOptions; ?>
			<?php echo $k2Options; ?>
			<option value='r3s-url'><?php echo JText::_('WEEVER_ADD_R3S_URL'); ?></option>
		</select>
		<label for="wx-select-proximity" class="key hasTip" style="color: #888888; font-size: 0.75em; padding-left: 4px; text-transform: uppercase;"
		 title="<?php echo JText::_('WEEVER_ADD_PROXIMITY_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_ADD_PROXIMITY_HELP_LABEL'); ?></label>
	</div>
	
	<div class='wx-dummy wx-proximity-dummy'>
		<select disabled='disabled'><option><?php echo JText::_('WEEVER_OPTIONS'); ?></option></select>
	</div>
	
	<div class='wx-add-item-option wx-proximity-reveal wx-reveal'>
		
		<?php if(comWeeverHelper::joomlaVersion() != "1.5") : ?>
		
		<div id='wx-add-proximity-jcategory-item'>
		
			<select name='unnamed' id='wx-add-proximity-jcategory-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_JCATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->contentCategories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_content&view=category&layout=blog&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>
		
		<?php endif; ?>	
		
		<div id='wx-add-proximity-k2-category-item'>
		
			<select name='unnamed' id='wx-add-proximity-k2-category-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->k2Categories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>		
		
		
		<div id="wx-add-proximity-k2-tag">
		<input type='text' value='' id='wx-add-proximity-k2-tag-input' class='wx-input wx-proximity-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_K2_TAG_PLACEHOLDER"); ?>' />
		<label for='wx-add-proximity-k2-tag-input' id='wx-add-proximity-k2-tag-input-label' class='wx-proximity-label'><?php echo JText::_('WEEVER_ADD_PROXIMITY_K2_TAG'); ?></label>
		</div>
	
			
		<div id="wx-add-proximity-r3s-url">
			<input type='text' value='' id='wx-add-proximity-r3s-url-input' class='wx-input wx-proximity-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_R3S_URL_PLACEHOLDER"); ?>' />
			<label for='wx-add-proximity-r3s-url-input' id='wx-add-proximity-r3s-url-input-label' class='wx-proximity-label'><?php echo JText::_('WEEVER_ADD_R3S_URL_LABEL'); ?></label>
		</div>
						
						
	
	</div>
	
	
	<div class='wx-add-submit'>
		<input type='submit' id='wx-proximity-submit' class='wx-submit' value='<?php echo JText::_('WEEVER_ADD_PROXIMITY_SUBMIT'); ?>' name='add' disabled='disabled' />
	</div>
	
	

</div>