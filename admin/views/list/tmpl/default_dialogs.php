<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.7
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

<div style="clear:both;" id="wx-hidden-dialogs">&nbsp;</div>

<div id="wx-add-blog-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-page-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-panel-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-map-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-video-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-photo-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-calendar-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-social-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-form-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-contact-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-directory-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-aboutapp-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-audio-type-dialog" class="wx-jquery-dialog wx-hide"></div>
<div id="wx-add-product-type-dialog" class="wx-jquery-dialog wx-hide"></div>

<div id="wx-add-joomla_contact-dialog" class="wx-jquery-dialog wx-hide">

	<div>
	
		<select name='component_id' id='wx-add-contact-joomla-select' class='wx-component-id-select'>
			<option value='0'><?php echo JText::_('WEEVER_CHOOSE_CONTACT_PARENTHESES'); ?></option>
			
			<?php $hidden_array = ""; $hidden = ""; ?>
			
			<?php foreach( (object) $this->contactItems as $k=>$v ) : ?>
				
				<option value='<?php echo $v->id; ?>'><?php echo $v->name; ?></option>
				
				<?php $hidden = "<input type='hidden' name='contact_name[]' value='".$v->name."' />"; ?>
				<?php $hidden_array .= $v->id.","; ?>
			
			<?php endforeach; ?>
			
			<?php $hidden_array = rtrim($hidden_array,","); ?>
			<?php $hidden .= "<input type='hidden' name='comp_array' value='".$hidden_array."' />"; ?>
		
		</select>
		
		<?php echo $hidden; ?>
		
	</div>

</div>


<div id="wx-add-k2-blog-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">

	<div>
	
		<select name='unnamed' id='wx-add-k2-blog-select' class='wx-cms-feed-select'>
			<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_PARENTHESES'); ?></option>
			
			<?php foreach( (object) $this->menuK2Blogs as $k=>$v ) : ?>
				
				<option value='<?php echo $v->link; ?>&template=weever_cartographer&Itemid=<?php echo $v->id; ?>'><?php echo $v->name; ?></option>
			
			<?php endforeach; ?>
		
		</select>
	
	</div>

</div>



<div id="wx-add-title-tab-dialog" class="wx-jquery-dialog wx-hide">

	<h2>Give this content a title</h2>
	
	<p id="wx-add-title-use"></p>

	<input type="text" id="wx-add-title-tab-item" class="wx-input" />	

</div>


<div id="wx-add-k2-category-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">


		<div>
		
			<select name='unnamed' id='wx-add-k2-category-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->k2Categories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>
		


</div>


<div id="wx-add-easyblog-category-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">


		
		<div>
		
			<select name='unnamed' id='wx-add-blog-k2-category-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->k2Categories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>

</div>


<div id="wx-add-k2-item-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">

	<div id='wx-add-panel-k2-item'>
					
		<div class="button2-left">
		
			<div class="blank">
				<a class="modal" title="<?php echo JText::_('WEEVER_PANEL_SELECT_K2_ITEM'); ?>"  href="index.php?option=com_k2&amp;view=items&amp;task=element&amp;tmpl=component&amp;object=k2item" rel="{handler: 'iframe', size: {x: 700, y: 450}}">&nbsp;&nbsp;<?php echo JText::_('WEEVER_PANEL_SELECT'); ?>&nbsp;&nbsp;</a>
			</div>
		
		
			<input type="text" id="k2item_name" placeholder="Select content..." class='wx-dialog-input wx-panel-input wx-panel-content-name' disabled="disabled" />

			<input type="hidden" id="k2item_id wx-add-k2-item-select" class="wx-panel-input" name="urlparams[id]" value="0" />
		
		</div>

	</div>		
		
</div>


<div id="wx-add-k2-tag-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">

	<div id="wx-add-blog-k2-tag">
	
		<input type='text' value='' id='wx-add-blog-k2-tag-input' class='wx-dialog-input wx-blog-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_K2_TAG_PLACEHOLDER"); ?>' />
		<label for='wx-add-blog-k2-tag-input' id='wx-add-k2-tag-select' class='wx-blog-label  wx-jqui-label'><?php echo JText::_('WEEVER_ADD_BLOG_K2_TAG'); ?></label>
		
	</div>	

</div>


<div id="wx-add-joomla-blog-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">
		
		<div id='wx-add-blog-menu-item'>
		
			<select id='wx-add-joomla-blog-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->menuJoomlaBlogs as $k=>$v ) : ?>
					
					<option value='<?php echo $v->link; ?>&template=weever_cartographer&Itemid=<?php echo $v->id; ?>'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>

</div>


<div id="wx-add-joomla-category-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">
		
	<div id='wx-add-blog-jcategory-item'>
	
		<select id='wx-add-joomla-category-select' class='wx-cms-feed-select'>
			<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_JCATEGORY_PARENTHESES'); ?></option>
			
			<?php foreach( (object) $this->contentCategories as $k=>$v ) : ?>
			
				<?php $link = "index.php?option=com_content&view=category&layout=blog&id=".$v->id; ?>
				
				<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
			
			<?php endforeach; ?>
		
		</select>
	
	</div>

</div>


<div id="wx-add-joomla-article-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">

	<?php 
	
	if( comWeeverHelper::joomlaVersion() == '1.5' )  // ### 1.5 only
	{
		$link = 'index.php?option=com_content&amp;task=element&amp;tmpl=component&amp;object=jarticle';
	}
	else 
	{
		$link = 'index.php?option=com_content&amp;task=element&amp;tmpl=component&amp;layout=modal&amp;function=jSelectArticleNew&amp;object=jarticle';  
	}

	?>

	<div id='wx-add-panel-content-joomla'>
	
		<div class="button2-left">
		
			<div class="blank">
				<a class="modal" title="<?php echo JText::_('WEEVER_PANEL_SELECT_JOOMLA_ARTICLE'); ?>" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 450}}">&nbsp;&nbsp;<?php echo JText::_('WEEVER_PANEL_SELECT'); ?>&nbsp;&nbsp;</a>
			</div>
			
			<input type="text" id="jarticle_name" placeholder="Select content..." class='wx-dialog-input wx-panel-input wx-panel-content-name' disabled="disabled" />
			
			<input type="hidden" id="jarticle_id wx-add-joomla-article-select" class="wx-panel-input" name="urlparams[id]" value="0" />
			
		</div>
		
	</div>

</div>


<div id="wx-add-twitter-user-dialog" class="wx-jquery-dialog wx-hide wx-service-twitter wx-choose-content">

	<div>

		<input type='text' value='' class='wx-dialog-input wx-social-input' id='wx-twitter-user-value' name='component_behaviour' placeholder='@mytwittername' />
		<label for='wx-twitter-user-value' id='wx-twitter-user' class='wx-social-label  wx-jqui-label'><?php echo JText::_('WEEVER_TWITTER_USER'); ?></label>			
		
	</div>

</div>

<div id="wx-add-twitter-hashtag-dialog" class="wx-jquery-dialog wx-hide wx-service-twitter wx-choose-content">

	<div>

		<input type='text' value='' class='wx-dialog-input wx-social-input' id='wx-twitter-hashtag-value' name='component_behaviour' placeholder='#MyHashtag' />
		<label for='wx-twitter-hashtag-value' id='wx-twitter-hashtag' class='wx-social-label  wx-jqui-label'><?php echo JText::_('WEEVER_TWITTER_HASHTAG'); ?></label>		
		
	</div>

</div>

<div id="wx-add-twitter-search-dialog" class="wx-jquery-dialog wx-hide wx-service-twitter wx-choose-content">

	<div>

		<input type='text' value='' class='wx-dialog-input wx-social-input' id='wx-twitter-search-value' name='component_behaviour' placeholder='Enter a Search Term' />
		<label for='wx-twitter-search-value' id='wx-twitter-query' class='wx-social-label  wx-jqui-label'><?php echo JText::_('WEEVER_TWITTER_QUERY'); ?></label>		
		
	</div>

</div>


<div id="wx-add-facebook-dialog" class="wx-jquery-dialog wx-hide wx-service-facebook wx-choose-content">

	<div>

		<input type='text' value='' class='wx-dialog-input wx-social-input' id='wx-facebook-user-value' name='component_behaviour' placeholder='http://facebook.com/MyPage' />
		<label for='wx-facebook-stream-value' id='wx-facebook-url' class='wx-social-label  wx-jqui-label'><?php echo JText::_('WEEVER_FACEBOOK_URL'); ?></label>
		
	</div>

</div>


<div id="wx-add-youtube-channel-dialog" class="wx-jquery-dialog wx-hide wx-service-youtube wx-choose-content">

	<div>
		
		
		<input type='text' value='' name='component_behaviour' id='wx-youtube-channel-url' class='wx-dialog-input wx-video-input' placeholder='MyChannelName' />
		<label for='wx-youtube-channel-url' id='wx-youtube-url' class='wx-video-label wx-jqui-label'><?php echo JText::_('WEEVER_YOUTUBE_URL'); ?></label>
				
				
	</div>

</div>



<div id="wx-add-youtube-playlist-dialog" class="wx-jquery-dialog wx-hide wx-service-youtube wx-choose-content">

	<div>
		
		
		<input type='text' value='' placeholder='http://youtube.com/playlist?list=abcd1234' name='component_behaviour' id='wx-youtube-playlist-url' class='wx-dialog-input wx-video-input' />
		<label for='wx-youtube-playlist-url' id='wx-youtube-playlist-url-label' class='wx-video-label wx-jqui-label'><?php echo JText::_('WEEVER_YOUTUBE_PLAYLIST_URL'); ?></label>
				
				
	</div>

</div>


<div id="wx-add-vimeo-dialog" class="wx-jquery-dialog wx-hide wx-service-vimeo wx-choose-content">

	<div>
		
		
		<input type='text' value='' placeholder='https://vimeo.com/user1234' name='component_behaviour' id='wx-vimeo-channel-url' class='wx-dialog-input wx-video-input' />
		<label for='wx-vimeo-channel-url' id='wx-vimeo-url' class='wx-video-label wx-jqui-label'><?php echo JText::_('WEEVER_VIMEO_URL'); ?></label>
				
				
	</div>

</div>


<div id="wx-add-wufoo-dialog" class="wx-jquery-dialog wx-hide wx-service-wufoo wx-choose-content">

	<div>
		
		<input type='text' id='wx-wufoo-form-url' class='wx-dialog-input wx-form-input' name='url' />
		<label for='wx-form-url' class='wx-jqui-label'><?php echo JText::_('WEEVER_WUFOO_FORM_URL'); ?></label>
		
		<input type='text' id='wx-wufoo-form-api-key' class='wx-dialog-input wx-form-input' name='api_key' />
		<label for='wx-form-api-key' class='wx-jqui-label'><?php echo JText::_('WEEVER_WUFOO_API_KEY'); ?></label>
				
	</div>

</div>


<div id="wx-add-foursquare-dialog" class="wx-jquery-dialog wx-hide wx-service-foursquare wx-choose-content">

	<div>
		
		<input type='text' value='' placeholder='http://foursquare.com/v/your-venue/abcd123456' id='wx-foursquare-photo-url' class='wx-dialog-input wx-photo-input' name='url' />
		<label for='wx-foursquare-photo-url' id='wx-foursquare-url' class='wx-photo-label wx-jqui-label'><?php echo JText::_('WEEVER_FOURSQUARE_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-picasa-dialog" class="wx-jquery-dialog wx-hide wx-service-picasa wx-choose-content">

	<div>
		
		<input type='text' value='' placeholder='your.email@gmail.com' id='wx-picasa-photo-url' class='wx-dialog-input wx-photo-input' name='url' />
		<label for='wx-picasa-photo-url' id='wx-google-picasa-email' class='wx-photo-label wx-jqui-label'><?php echo JText::_('WEEVER_GOOGLE_PICASA_EMAIL'); ?></label>
				
	</div>

</div>


<div id="wx-add-google_calendar-dialog" class="wx-jquery-dialog wx-hide wx-service-google_calendar wx-choose-content">

	<div>
		
		<input type='text' placeholder='abs123@group.calendar.google.com' id='wx-google-calendar-email' class='wx-calendar-input wx-dialog-input' name='email' />
		<label for='wx-google-calendar-email' id='wx-google-calendar-email-label' class='wx-jqui-label'><?php echo JText::_('WEEVER_GOOGLE_CALENDAR_EMAIL_ID'); ?></label>
				
	</div>

</div>

<div id="wx-add-blogger-dialog" class="wx-jquery-dialog wx-hide wx-service-blogger wx-choose-content">

	<div>
		
		<input type='text' value='' id='wx-add-blog-blogger-url-input' class='wx-dialog-input wx-blog-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_BLOGGER_URL_PLACEHOLDER"); ?>' />
		<label for='wx-add-blog-blogger-url-input' id='wx-add-blog-blogger-url-input-label' class='wx-blog-label wx-jqui-label'><?php echo JText::_('WEEVER_ADD_BLOGGER_URL_LABEL'); ?></label>
				
	</div>

</div>


<div id="wx-add-tumblr-dialog" class="wx-jquery-dialog wx-hide wx-service-tumblr wx-choose-content">

	<div>
		
		<input type='text' value='' id='wx-add-blog-tumblr-url-input' class='wx-dialog-input wx-blog-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_TUMBLR_URL_PLACEHOLDER"); ?>' />
		<label for='wx-add-blog-tumblr-url-input' id='wx-add-blog-tumblr-url-input-label' class='wx-blog-label wx-jqui-label'><?php echo JText::_('WEEVER_ADD_TUMBLR_URL_LABEL'); ?></label>
				
	</div>

</div>


<div id="wx-add-google_plus-dialog" class="wx-jquery-dialog wx-hide wx-service-google_plus wx-choose-content">

	<div>
		
		<input type='text' value='' id='wx-add-google_plus-url-input' class='wx-dialog-input wx-social-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_GOOGLE_PLUS_URL_PLACEHOLDER"); ?>' />
		<label for='wx-add-google_plus-url-input' id='wx-add-google_plus-url-input-label' class='wx-social-label wx-jqui-label'><?php echo JText::_('WEEVER_ADD_GOOGLE_PLUS_URL_LABEL'); ?></label>
				
	</div>

</div>


<div id="wx-add-identica-dialog" class="wx-jquery-dialog wx-hide wx-service-identica wx-choose-content">

	<div>
		
		<input type='text' value='' class='wx-dialog-input wx-social-input' id='wx-identica-social-value' name='component_behaviour' placeholder='Enter a Search Query' />
		<label for='wx-identica-social-value' id='wx-identica-query' class='wx-social-label wx-jqui-label'><?php echo JText::_('WEEVER_IDENTICA_QUERY'); ?></label>

	</div>

</div>


<div id="wx-add-flickr-photostream-dialog" class="wx-jquery-dialog wx-hide wx-service-flickr wx-choose-content">

	<div>
		
		
		<input type='text' value='' id='wx-flickr-photostream-photo-url' class='wx-dialog-input wx-photo-input' name='url' placeholder='http://flickr.com/photos/123456@N01' />
		<label for='wx-flickr-photostream-photo-url' id='wx-flickr-photostream-url' class='wx-photo-label wx-jqui-label'><?php echo JText::_('WEEVER_FLICKR_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-flickr-photosets-dialog" class="wx-jquery-dialog wx-hide wx-service-flickr wx-choose-content">

	<div>
		
		
		<input type='text' value='' placeholder='http://flickr.com/photos/123456@N01' id='wx-flickr-photosets-photo-url' class='wx-dialog-input wx-photo-input' name='url' />
		<label for='wx-flickr-photosets-photo-url' id='wx-flickr-photosets-url' class='wx-photo-label wx-jqui-label'><?php echo JText::_('WEEVER_FLICKR_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-soundcloud-set-dialog" class="wx-jquery-dialog wx-hide wx-service-soundcloud wx-choose-content">

	<div>
		
		
		<input type='text' value='' id='wx-soundcloud-set-audio-url' class='wx-dialog-input wx-audio-input' name='url' />
		<label for='wx-soundcloud-set-audio-url' id='wx-soundcloud-set-url' class='wx-audio-label wx-jqui-label'><?php echo JText::_('WEEVER_SOUNDCLOUD_SET_URL'); ?></label>
				
	</div>

</div>

<div id="wx-add-soundcloud-user-dialog" class="wx-jquery-dialog wx-hide wx-service-soundcloud wx-choose-content">

	<div>
		
		
		<input type='text' value='' id='wx-soundcloud-user-audio-url' class='wx-dialog-input wx-audio-input' name='url' />
		<label for='wx-soundcloud-user-audio-url' id='wx-soundcloud-user-url' class='wx-audio-label wx-jqui-label'><?php echo JText::_('WEEVER_SOUNDCLOUD_USER_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-bandcamp-band-dialog" class="wx-jquery-dialog wx-hide wx-service-bandcamp wx-choose-content">

	<div>
		
		
		<input type='text' value='' id='wx-bandcamp-band-audio-url' class='wx-dialog-input wx-audio-input' name='url' />
		<label for='wx-bandcamp-band-audio-url' id='wx-bandcamp-band-url' class='wx-audio-label wx-jqui-label'><?php echo JText::_('WEEVER_BANDCAMP_BAND_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-bandcamp-album-dialog" class="wx-jquery-dialog wx-hide wx-service-bandcamp wx-choose-content">

	<div>
		
		
		<input type='text' value='' id='wx-bandcamp-album-audio-url' class='wx-dialog-input wx-audio-input' name='url' />
		<label for='wx-bandcamp-album-audio-url' id='wx-bandcamp-album-url' class='wx-audio-label wx-jqui-label'><?php echo JText::_('WEEVER_BANDCAMP_ALBUM_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-r3s-dialog" class="wx-jquery-dialog wx-hide wx-choose-content">

	<p>Add an R3S Object URL</p>
	
	<div id="wx-add-page-r3s-url">
	
		<input type='text' value='' id='wx-add-page-r3s-url-input' class='wx-dialog-input wx-page-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_R3S_URL_PLACEHOLDER"); ?>' />
		<label for='wx-add-page-r3s-url-input' id='wx-add-page-r3s-url-input-label' class='wx-page-label wx-jqui-label'><?php echo JText::_('WEEVER_ADD_R3S_URL_LABEL'); ?></label>
		
	</div>

</div>


<div id="wx-upgrade-notice" class="wx-jquery-dialog wx-hide">

	<div>
	
	<h2>This is a pro feature...</h2>
	
	<p>You'll need to <a href="http://weeverapps.com/upgrade" target="_blank">upgrade your subscription</a> to add this feature..</p>
		
	</div>

</div>


<div id="wx-add-suggestion-dialog" class="wx-jquery-dialog wx-hide">

	<div>
	
	<h2>Something you don't see here?</h2>
	
	<p>Let us know on the support forums, we'd love to hear from you!<p>
	
	<p><a href="http://support.weeverapps.com/forums/20413397-feature-requests" target="_blank">Click to visit the Feature Request Forum</a>.</p>
		
	</div>

</div>