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

$option 		= JRequest::getCmd('option');
$document 		= &JFactory::getDocument();

JHTML::_('behavior.tooltip');
JHTML::_('behavior.mootools');
JHTML::_('behavior.modal', 'a.modal');

jimport('joomla.html.pane');

if(comWeeverHelper::joomlaVersion() == '1.5')  // ### 1.5 only
	$js_close = "document.getElementById('sbox-window').close();";
else 
	$js_close = "window.parent.SqueezeBox.close();";

$document->addCustomTag ('<script type="text/javascript">

				function jSelectItem(id, title, object) {
                        document.getElementById(object + \'_id\').value = id;
                        document.getElementById(object + \'_name\').value = title;
                       '.$js_close.'
                }
                
                function jSelectArticle(id, title, object) {
                		document.getElementById(object + \'_id\').value = id;
                		document.getElementById(object + \'_name\').value = title;
                		'.$js_close.'
                		
                }
                
                function jSelectArticleNew(id, title, catid, object) {
                		document.getElementById(\'id_id\').value = id;
                		document.getElementById(\'id_name\').value = title;
                		'.$js_close.'
                                        
                }
                
                </script>
                
	');
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list_icons.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list.js?v='.comWeeverConst::VERSION );

$this->loadTemplate('base64images');

jimport('joomla.filter.output');


$child_html 		= "";
$k 					= 0; // for alternating shaded rows
$iii 				= 0; // for making checkboxes line up right
$tabsUnpublished 	= 0;
$onlineSpan 		= "";
$offlineSpan 		= "";

if($this->appEnabled)
{

	$offlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "";
	
}
else 
{

	$onlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
	
}

if(comWeeverHelper::isWebKit())
	$dashWebKit = "-webkit";
else 
	$dashWebKit = "";

?>

<?php if( $newDownload = JRequest::getVar("upgrade") ) : ?>

	<?php 
	if(comWeeverHelper::joomlaVersion() != '1.5') 
	{ 
	
		$newDownload = "index.php?option=com_installer&view=update"; 
		$updateText = JText::_('WEEVER_JOOMLA_UPDATE_AVAILABLE_BYLINE');
					
	} 
	else 
	{
	
		$updateText = JText::_('WEEVER_JOOMLA_UPDATE_AVAILABLE_BYLINE_15');
		
	}
	?>

	<span class="wx-download-update<?php echo $dashWebKit; ?>"><a href="<?php echo $newDownload; ?>" class="wx-download-button" id="headerbutton"><?php echo JText::_('WEEVER_JOOMLA_UPDATE_BUTTON'); ?></a><?php echo JText::_('WEEVER_JOOMLA_UPDATE_AVAILABLE')." ".JRequest::getVar("upgradeVersion"); ?><br><span class="wx-download-byline"><?php echo $updateText; ?></span></span>
	
<?php else : ?> 

	<?php if($this->tier == 1) : ?>
		<div class="wx-promotion-basic<?php echo $dashWebKit; ?>">
		<span class="wx-promotion-basic-title"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION'); ?></span>
		<span class="wx-promotion-basic-link"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION_LEARN_MORE'); ?></span></div>
			
	<?php elseif($this->tier == 2.1) : ?>
		<span class="wx-promotion-trial<?php echo $dashWebKit; ?>"><a href="http://weeverapps.com/pricing" class="wx-promotion-trial-button" id="headerbutton"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BUTTON'); ?></a><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_CALL'); ?><br><span class="wx-promotion-trial-byline"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BYLINE'); ?></span></span>
		
	<?php endif; ?>
	
<?php endif; ?>
	

<span id="wx-admin-topbar-left" class="wx-admin-topbar">
			<a href="http://weeverapps.com/pricing"><?php echo JText::_('WEEVER_PLANS_AND_PRICING'); ?></a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps"><?php echo JText::_('WEEVER_FOLLOW_TWITTER'); ?></a> &nbsp; | &nbsp; <a href="http://eepurl.com/fP-oD"><?php echo JText::_('WEEVER_NEWSLETTER'); ?></a>

</span>
    

<div id="wx-admin-topbar-right" class="wx-admin-topbar">

<span <?php echo $offlineStatusClass; ?> id="wx-app-status-button">
    
  <span <?php echo $onlineSpan; ?> id="wx-app-status-online">
	<span id="wx-status-current"><?php echo JText::_('WEEVER_APP_STATUS'); ?></span>
    <span id="wx-status-boldonline"><strong><?php echo JText::_('WEEVER_ONLINE'); ?></strong></span>
    <span id="wx-status-current"><?php echo JText::_('WEEVER_FOR_MOBILE_VISITORS'); ?></span>
	<span id="wx-status-takeoffline"><?php echo JText::_('WEEVER_TAKE_OFFLINE'); ?></span>
  </span>
    
  <span <?php echo $offlineSpan; ?> id="wx-app-status-offline">
    <span id="wx-status-current"><?php echo JText::_('WEEVER_APP_STATUS'); ?></span>
    <span id="wx-status-boldoffline"><strong><?php echo JText::_('WEEVER_OFFLINE'); ?></strong></span>
    <span id="wx-status-current"><?php echo JText::_('WEEVER_FOR_MOBILE_VISITORS'); ?></span>
	<span id="wx-status-turnonline"><?php echo JText::_('WEEVER_TURN_APP_ONLINE'); ?></span>
  </span>

</span>
</div>



<div id="listTabs">
<ul id="listTabsSortable" style="padding-right: 5%">

<li id="addTab" class="wx-nav-tabs"><a href="#addTab" class="wx-tab-sortable"><div class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="Add"><img class="wx-nav-icon-img" src="data:image/png;base64,<?php echo $this->theme->addIcon; ?>" /></div><div class="wx-nav-label">+</div></a></li>

<?php 

for($i=0, $n=count($this->tabRows); $i < $n; $i++)
{

	$row 				= &$this->tabRows[$i];
	$componentRowsName 	= $row->component . 'Rows';
	$componentRows 		= @$this->{$componentRowsName}; // no error for experimental tabs
	$tabActive 			= 0;
	
	$row->id 			= $row->cloud_tab_id;
	
	for($ii=0, $nn=count($componentRows); $ii<$nn; $ii++)
	{
	
		$subrow = &$componentRows[$ii];
		
		if($subrow->published)
			$tabActive = 1;
	
	}
	
	if($this->tier == 2.1 && $row->tier > 1)
		$trialClass = " trial-feature";
	else 
		$trialClass = "";
	
	$componentRowsCount = count($componentRows);
	$tabIcon = $row->component . "Icon";
	
	$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list/select/'.$row->component.'.select.js?v='.comWeeverConst::VERSION );
	$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list/submit/'.$row->component.'.submit.js?v='.comWeeverConst::VERSION );	
	if(!$componentRowsCount || $tabActive == 0)
		echo '<li id="'. $row->component . 'TabID" class="wx-nav-tabs" rel="unpublished" style="float:right;" style="float:center;"><a href="#'. $row->component . 'Tab" class="wx-tab-sortable'.$trialClass.'"><div class="wx-grayed-out wx-nav-icon" rel="'.$this->site_key.'" style="height:32px;width:auto;min-width:32px;text-align:center" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.@$this->theme->{$tabIcon}.'" /></div><div class="wx-nav-label wx-grayed-out" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';	

	else
		echo '<li id="'. $row->component . 'TabID" class="wx-nav-tabs"><a href="#'. $row->component . 'Tab" class="wx-tab-sortable'.$trialClass.'"><div class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" rel="'.$this->site_key.'" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.@$this->theme->{$tabIcon}.'" /></div><div class="wx-nav-label" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';	
	
}
	
 ?>
 
 </ul>
 
<div id="wx-overlay-drag"><div id="wx-overlay-unpublished"><?php echo JText::_('WEEVER_ICON_HAS_NO_PUB_ITEMS'); ?></div><img id="wx-overlay-drag-img" src="components/com_weever/assets/icons/drag.png" /><div><?php echo JText::_('WEEVER_DOUBLE_CLICK_EDIT'); ?></div></div>

<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>



	<form action='<?php echo JRoute::_( 'index.php' );?>' method='post' name='adminForm' id='adminForm'>
	
<?php
	
	
for($i=0, $n=count($this->tabRows); $i < $n; $i++)
{
	
	$row = &$this->tabRows[$i];
	
	$row->id = $row->cloud_tab_id;

	$link = JFilterOutput::ampReplace('index.php?option=' . $option . '&task=edit&layout=tab&cid[]='.$row->id);
	
	$componentRowsName = $row->component . 'Rows';
	$componentRows = @$this->{$componentRowsName};
	
	switch($row->component)
	{
	
		case "blog":
			$componentName = JText::_('WEEVER_TYPE_BLOG');
			$componentHelp = JText::_('WEEVER_LIST_BLOG_HELP');
			break;
			
		case "page":
			$componentName = JText::_('WEEVER_TYPE_ARTICLE');
			$componentHelp = JText::_('WEEVER_LIST_ARTICLE_HELP');
			break;
			
		case "contact":
			$componentName = JText::_('WEEVER_TYPE_CONTACT');
			$componentHelp = JText::_('WEEVER_LIST_CONTACT_HELP');
			break;
			
		case "component":
			$componentName = JText::_('WEEVER_TYPE_COMPONENT');
			$componentHelp = JText::_('WEEVER_LIST_COMPONENT_HELP');
			break;
			
		case "listingcomponent":
			$componentName = JText::_('WEEVER_TYPE_COMPONENT_LIST');
			$componentHelp = JText::_('WEEVER_LIST_COMPONENT_LIST_HELP');
			break;
			
		case "video":
			$componentName = JText::_('WEEVER_TYPE_VIDEO_FEED');
			$componentHelp = JText::_('WEEVER_LIST_VIDEO_HELP');
			break;
			
		case "social":
			$componentName = JText::_('WEEVER_TYPE_SOCIAL_NETWORK');
			$componentHelp = JText::_('WEEVER_LIST_SOCIAL_NETWORK_HELP');
			break;
			
		case "photo":
			$componentName = JText::_('WEEVER_TYPE_PHOTO_FEED');
			$componentHelp = JText::_('WEEVER_LIST_PHOTO_FEED_HELP');
			break;
			
	}
	
	if(count($componentRows))
	{
		
		$published = JHTML::_('grid.published', $row, $iii);
		$checked = JHTML::_('grid.id', $iii, $row->id);
		
		if($row->published == 0)
			$tabsUnpublished++;
			
	}
	else
	{
	
		$published = JText::_('WEEVER_NOT_APPLICABLE');
		$checked = null;
		$tabsUnpublished++;
		
	}

	?>
	
	<div id="<?php echo $row->component . 'Tab' ?>">
	
	<?php if ( comWeeverHelper::typeIsSupported($row->component) ) : ?>
		
		<?php echo $this->loadTemplate($row->component.'dropdown'); ?>
		
		<?php if($row->component == "panel") : ?>
		
			<?php $options = json_decode($row->var); ?>
		
			<input type="hidden" id="wx-panel-headers" value="<?php echo $options->content_header; ?>" />
			<input type="hidden" id="wx-panel-animate" value="<?php echo $options->animation->type; ?>" />
			<input type="hidden" id="wx-panel-animate-duration" value="<?php echo $options->animation->duration; ?>" />
			<input type="hidden" id="wx-panel-timeout" value="<?php echo $options->animation->timeout; ?>" />
			<input type="hidden" id="wx-panel-tab-id" value="<?php echo $row->id; ?>" />
		
		<?php elseif($row->component == "aboutapp") : ?>
		
			<?php $options = json_decode($row->var); ?>
		
			<input type="hidden" id="wx-aboutapp-headers" value="<?php echo $options->content_header; ?>" />
			<input type="hidden" id="wx-aboutapp-animate" value="<?php echo $options->animation->type; ?>" />
			<input type="hidden" id="wx-aboutapp-animate-duration" value="<?php echo $options->animation->duration; ?>" />
			<input type="hidden" id="wx-aboutapp-timeout" value="<?php echo $options->animation->timeout; ?>" />
			<input type="hidden" id="wx-aboutapp-tab-id" value="<?php echo $row->id; ?>" />
			
		<?php elseif($row->component == "map") : ?>
		
			<?php $options = json_decode($row->var); ?>
		
			<input type="hidden" id="wx-map-start-latitude" value="<?php echo $options->start->latitude; ?>" />
			<input type="hidden" id="wx-map-start-longitude" value="<?php echo $options->start->longitude; ?>" />
			<input type="hidden" id="wx-map-start-zoom" value="<?php echo $options->start->zoom; ?>" />
			<input type="hidden" id="wx-map-marker" value="<?php echo $options->marker; ?>" />
			<input type="hidden" id="wx-map-tab-id" value="<?php echo $row->id; ?>" />
		
		<?php endif; ?>
	
	<?php else : ?>
		
		<?php echo "<p class='wx-warning'>".JText::_('WEEVER_UNSUPPORTED_FEATURE')."</p>"; ?>
		
	<?php endif; ?>

	<input type="hidden" name="boxchecked<?php echo $row->component; ?>" id="boxchecked<?php echo $row->component; ?>" value="0" />
	
	<table class='adminlist' id='wx-adminlist-<?php echo $row->component; ?>'>
	
	<thead>
		<tr>
			<th width='20'>
				<input type='checkbox' name='toggle<?php echo $row->component; ?>' id='toggle<?php echo $row->component; ?>' value='' onclick='checkAllTab(<?php echo count($componentRows); ?>, "cb", document.getElementById("boxchecked<?php echo $row->component; ?>"), document.getElementById("toggle<?php echo $row->component; ?>"), <?php echo $iii; ?> + 1);' />
			</th>
			
			<th class='title'><?php echo JHTML::_('grid.sort', JText::_('WEEVER_NAME'), 'name', $this->lists['order_Dir'], $this->lists['order']); ?> &nbsp; (<a target="_blank" href="http://weeverapps.com/mobile-app-layout" style="color:#1C94C4;">?</a>)</th>
			<th width='9%' nowrap='nowrap'><?php echo JHTML::_('grid.sort', JText::_('WEEVER_PUBLISHED'), 'published', $this->lists['order_Dir'], $this->lists['order']); ?></th>
			<th width='9%' nowrap='nowrap'><?php echo JText::_('WEEVER_DELETE_TH'); ?></th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<td colspan='5'>
				<div class="wx-list-actions">
	
					<div class="wx-button-option" style="margin:0; padding:0;width: 110px;">
						<img  style="margin:0;" src="components/com_weever/assets/icons/arrow_leftup.png" />
						<span style="float:right; margin-top:.75em;">with selected:</span>
					</div>
					
					<div class="wx-button-option" id='wx-toolbar-publish'>
						<a href="#" onclick="javascript:if(document.getElementById('boxchecked<?php echo $row->component; ?>')==0){alert('Please make a selection from the list to publish');}else{  submitbutton('publish')}" class="toolbar">
						<img class="wx-button-option-icon" src="components/com_weever/assets/icons/tick.png" id="wx-publish-selected" title="Publish" /><?php echo JText::_('WEEVER_PUBLISH'); ?></a>
					</div>
					
					<div class="wx-button-option" id='wx-toolbar-unpublish'>
						<a href="#" onclick="javascript:if(document.getElementById('boxchecked<?php echo $row->component; ?>')==0){alert('Please make a selection from the list to unpublish');}else{  submitbutton('unpublish')}" class="toolbar">
						<img class="wx-button-option-icon" src="components/com_weever/assets/icons/publish_x.png" id="wx-unpublish-selected" title="Unpublish" /><?php echo JText::_('WEEVER_UNPUBLISH'); ?>
						</a>
					</div>
					
					<div  class="wx-button-option" id="wx-toolbar-delete">
						<a href="#" onclick="javascript:if(document.getElementById('boxchecked<?php echo $row->component; ?>')==0){alert('Please make a selection from the list to delete');}else{if(confirm('Are you sure you want to delete these tabs? (Note that navigation tabs selected will not be deleted.)')){submitbutton('remove');}}" class="toolbar">
							<img class="wx-button-option-icon" src="components/com_weever/assets/icons/wx-delete-mark.png" id="wx-delete-selected" title="Delete" /><?php echo JText::_('WEEVER_DELETE_TH'); ?>
						</a>
					</div>
				</div>
			</td>
		</tr>
	</tfoot>

	<?php

	$k = 1 - $k;
	$sub = 0;
	?>
	
	<tbody class="wx-table-sort" id='wx-table-<?php echo $row->component; ?>'>
	
	<?php
	
	for($ii=0, $nn=count($componentRows); $ii<$nn; $ii++)
	{
	
		$iii++; $sub++;
		$row = &$componentRows[$ii];	
		
		$row->id = $row->cloud_tab_id;		
		
		?>
		
		<tr id='<?php echo $row->id; ?>' class='<?php echo "row$k"; ?>'>
		
			<td>
				<?php echo JHTML::_('grid.id', $iii, $row->id); ?>
			</td>
			
			<td>
				<img class="wx-sort-icon" title="Drag to sort the order of items" src="components/com_weever/assets/icons/sort.png" /> <a href='#' title="ID #<?php echo $row->id; ?>" class="wx-subtab-link"><?php echo $row->name; ?></a>
			</td>
			<td align='center'>
				 <a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-publish"<?php echo ($row->published ? 'rel="1"><img src="components/com_weever/assets/icons/tick.png" border="0" alt="Published">' : 'rel="0"><img src="components/com_weever/assets/icons/publish_x.png" border="0" alt="Unpublished">'); ?></a>
			</td>
			<td align='center'><a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-delete" rel="<?php echo $row->type; ?>" alt=" <?php echo JText::_('WEEVER_DELETE'); ?> &quot;<?php echo htmlentities($row->name); ?>&quot;"><img src="components/com_weever/assets/icons/wx-delete-mark.png" /></a></td>
			
		</tr>
		
		
		
		<?php
		$k = 1 - $k;
		
	}
	
	if(!count($componentRows))
	{
	
		echo "<tr><td colspan='5'>".JText::_('WEEVER_NO_ITEMS_IN_TAB')."</td></tr>";
	
	}
	
	?>
	
	</tbody>
	
	</table>
	</div>
	
	<?php

}

?>
<div id="addTab">

<div class="wx-add-item-prompt">What would you like to add to your app today?</div>
	
<div>
	
	<div style="clear:left;"><p>From Your Joomla Site...</p>
	
		<div id="add-joomla" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/Joomla_NoCircle.png" />
		<span>Joomla Content</span>
		</div>
		
		<div id="add-joomla_contact" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Joomla_NoCircle.png" />
		<span>Joomla Contact</span>
		</div>
		
		<div id="add-k2" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/K2_Square.png" />
		<span>K2 Content</span>
		</div>
		
		<div id="add-easyblog" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/cloud5.png" />
		<span>EasyBlog Content</span>
		</div>
		
		<div id="add-virtuemart" class="wx-add-source-icon wx-unavailable">
		<img src="components/com_weever/assets/icons/sources/cloud5.png" />
		<span>VirtueMart</span>
		</div>
		
	</div>
	
	<div style="clear:left; text-align: left;"><p>From Third-Party Services...</p>
	
		<div id="add-twitter" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/TwitterBird_NoCircle.png" />
		<span>Twitter</span>
		</div>
		
		<div id="add-facebook" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/Facebook_Square.png" />
		<span>Facebook</span>
		</div>
		
		<div id="add-google_plus" class="wx-add-source-icon wx-unavailable">
		<img src="components/com_weever/assets/icons/sources/GooglePlus.png" />
		<span>Google+</span>
		</div>
		
		<div id="add-youtube" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/Youtube_NoCircle.png" />
		<span>YouTube</span>
		</div>
		
		<div id="add-vimeo" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Vimeo_NoCircle.png" />
		<span>Vimeo</span>
		</div>
		
		<div id="add-wufoo" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Wufoo_NoCircle.png" />
		<span>Wufoo Forms</span>
		</div>
		
		<div id="add-flickr" class="wx-add-source-icon">
		<img src="components/com_weever/assets/icons/sources/Flickr_Circle.png" />
		<span>Flickr</span>
		</div>
		
		<div id="add-picasa" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Picasa_NoCircle.png" />
		<span>Picasa</span>
		</div>
		
		<div id="add-foursquare" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Foursquare_NoCircle.png" />
		<span>Foursquare</span>
		</div>
		
		<div id="add-soundcloud" class="wx-add-source-icon wx-unavailable">
		<img src="components/com_weever/assets/icons/sources/Soundcloud_NoCircle_White.png" />
		<span>SoundCloud</span>
		</div>
		
		<div id="add-bandcamp" class="wx-add-source-icon wx-unavailable">
		<img src="components/com_weever/assets/icons/sources/Bandcamp_ShapeLetters.png" />
		<span>BandCamp</span>
		</div>
		
		<div id="add-google_calendar" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/calendar.png" />
		<span>Google Calendar</span>
		</div>
		
		<div id="add-blogger" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Blogger_NoCircle.png" />
		<span>Blogger</span>
		</div>
		
		<div id="add-identica" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/Indentica_NoCircle.png" />
		<span>Identi.ca</span>
		</div>
		
	</div>
	
	<div style="clear:both;"><p>From Anywhere... (advanced)</p>

		<div id="add-r3s" class="wx-add-source-icon wx-add-single">
		<img src="components/com_weever/assets/icons/sources/cloud5.png" />
		<span>R3S Feeds</span>
		</div>
		
	</div>
	
</div>	

<div style="clear:both;">&nbsp;</div>

<div id="wx-add-joomla-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Your Joomla Site...</p>
		
		<div id="add-joomla-category" class="wx-add-item-icon wx-add-joomla-dialog-item">
			<img src="components/com_weever/assets/icons/sources/Joomla_NoCircle.png" />
			<span>+ Blog or Category</span>
		</div>
		
		<div id="add-joomla-article" class="wx-add-item-icon wx-add-joomla-dialog-item">
			<img src="components/com_weever/assets/icons/sources/Joomla_NoCircle.png" />
			<span>+ Article</span>
		</div>
		
		<div id="add-joomla-menu" class="wx-add-item-icon wx-add-joomla-dialog-item wx-unavailable">
			<img src="components/com_weever/assets/icons/sources/Joomla_NoCircle.png" />
			<span>+ Content from Menu</span>
		</div>
		
	</div>

</div>


<div id="wx-add-joomla_contact-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Your Joomla Contacts</p>
		
		<div id='wx-add-contact-joomla'>
		
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
		
		<label><?php echo JText::_('WEEVER_CONTACT_CHOOSE'); ?></label>
		
	</div>

</div>



<div id="wx-add-k2-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Your Joomla Site...</p>
		
		<div id="add-k2-category" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/K2_Square.png" />
			<span>+ Blog or Category</span>
		</div>
		
		<div id="add-k2-article" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/K2_Square.png" />
			<span>+ Item</span>
		</div>
		
		<div id="add-k2-tag" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/K2_Square.png" />
			<span>+ Tag</span>
		</div>
		
		<div id="add-k2-menu" class="wx-add-item-icon wx-unavailable">
			<img src="components/com_weever/assets/icons/sources/K2_Square.png" />
			<span>+ Content from Menu</span>
		</div>
		
	</div>

</div>


<div id="wx-add-easyblog-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Your Joomla Site...</p>
		
		<div id="add-easyblog-category" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/cloud5.png" />
			<span>+ Category</span>
		</div>
		
		<div id="add-easyblog-article" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/cloud5.png" />
			<span>+ Article</span>
		</div>
		
		<div id="add-easyblog-tag" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/cloud5.png" />
			<span>+ Tag</span>
		</div>
		
		<div id="add-easyblog-menu" class="wx-add-item-icon wx-unavailable">
			<img src="components/com_weever/assets/icons/sources/cloud5.png" />
			<span>+ Content from Menu</span>
		</div>
		
	</div>

</div>


<div id="wx-add-k2-category-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Choose a K2 Content Category</p>
		
		<div id='wx-add-blog-k2-category-item'>
		
			<select name='unnamed' id='wx-add-blog-k2-category-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->k2Categories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>
		
	</div>

</div>


<div id="wx-add-easyblog-category-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Choose a EasyBlog Category</p>
		
		<div id='wx-add-blog-k2-category-item'>
		
			<select name='unnamed' id='wx-add-blog-k2-category-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_K2_CATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->k2Categories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_k2&view=itemlist&layout=blog&task=category&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>
		
	</div>

</div>


<div id="wx-add-k2-article-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Select a K2 Item</p>


		<div id='wx-add-panel-k2-item'>
						
			<div class="button2-left">
				<div class="blank">
					<a class="modal" title="<?php echo JText::_('WEEVER_PANEL_SELECT_K2_ITEM'); ?>"  href="index.php?option=com_k2&amp;view=items&amp;task=element&amp;tmpl=component&amp;object=k2item" rel="{handler: 'iframe', size: {x: 700, y: 450}}"><?php echo JText::_('WEEVER_PANEL_SELECT'); ?></a>
				</div>
			</div>
			
			<input type="text" id="k2item_name" placeholder="Select content..." class='wx-input wx-panel-input wx-panel-content-name' disabled="disabled" />

			<input type="hidden" id="k2item_id" class="wx-panel-input" name="urlparams[id]" value="0" />
			<label id="urlparamsid-lbl" for="urlparamsid" class="hasTip" title="<?php echo JText::_('WEEVER_PANEL_SELECT_ARTICLE_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_PANEL_SELECT_CONTENT'); ?></label>

		</div>		
		
	</div>

</div>



<div id="wx-add-k2-tag-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Type in the K2 Tag</p>


		<div id="wx-add-blog-k2-tag">
		
			<input type='text' value='' id='wx-add-blog-k2-tag-input' class='wx-input wx-blog-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_K2_TAG_PLACEHOLDER"); ?>' />
			<label for='wx-add-blog-k2-tag-input' id='wx-add-blog-k2-tag-input-label' class='wx-blog-label'><?php echo JText::_('WEEVER_ADD_BLOG_K2_TAG'); ?></label>
			
		</div>	
		
	</div>

</div>




<div id="wx-add-joomla-category-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Choose a Joomla Content Category</p>
		
		<div id='wx-add-blog-jcategory-item'>
		
			<select name='unnamed' id='wx-add-blog-jcategory-item-select' class='wx-cms-feed-select'>
				<option><?php echo JText::_('WEEVER_CHOOSE_BLOG_JCATEGORY_PARENTHESES'); ?></option>
				
				<?php foreach( (object) $this->contentCategories as $k=>$v ) : ?>
				
					<?php $link = "index.php?option=com_content&view=category&layout=blog&id=".$v->id; ?>
					
					<option value='<?php echo $link; ?>&template=weever_cartographer'><?php echo $v->name; ?></option>
				
				<?php endforeach; ?>
			
			</select>
		
		</div>
		
	</div>

</div>



<div id="wx-add-joomla-article-dialog" class="wx-jquery-dialog wx-hide">

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

	<div><p>Select a Joomla Article</p>


		<div id='wx-add-panel-content-joomla'>
		
			<div class="button2-left">
				<div class="blank">
					<a class="modal" title="<?php echo JText::_('WEEVER_PANEL_SELECT_JOOMLA_ARTICLE'); ?>" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 450}}"><?php echo JText::_('WEEVER_PANEL_SELECT'); ?></a>
				</div>
				
				<input type="text" id="jarticle_name" placeholder="Select content..." class='wx-input wx-panel-input wx-panel-content-name' disabled="disabled" />
				
				<input type="hidden" id="jarticle_id" class="wx-panel-input" name="urlparams[id]" value="0" />
				
			</div>
			
		</div>
		
		
	</div>

</div>


<div id="wx-add-twitter-user-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Type in your username</p>

		<input type='text' value='' class='wx-input wx-social-input' id='wx-twitter-user-value' name='component_behaviour' />
		<label for='wx-twitter-user-value' id='wx-twitter-user' class='wx-social-label'><?php echo JText::_('WEEVER_TWITTER_USER'); ?></label>			
		
	</div>

</div>

<div id="wx-add-twitter-hashtag-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Type in your username</p>

		<input type='text' value='' class='wx-input wx-social-input' id='wx-twitter-hashtag-value' name='component_behaviour' />
		<label for='wx-twitter-hashtag-value' id='wx-twitter-hashtag' class='wx-social-label'><?php echo JText::_('WEEVER_TWITTER_HASHTAG'); ?></label>		
		
	</div>

</div>

<div id="wx-add-twitter-search-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Type in your username</p>

		<input type='text' value='' class='wx-input wx-social-input' id='wx-twitter-search-value' name='component_behaviour' />
		<label for='wx-twitter-search-value' id='wx-twitter-query' class='wx-social-label'><?php echo JText::_('WEEVER_TWITTER_QUERY'); ?></label>		
		
	</div>

</div>


<div id="wx-add-facebook-stream-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Enter your Facebook page URL</p>

		<input type='text' value='' class='wx-input wx-social-input' id='wx-facebook-stream-value' name='component_behaviour' />
		<label for='wx-facebook-stream-value' id='wx-facebook-url' class='wx-social-label'><?php echo JText::_('WEEVER_FACEBOOK_URL'); ?></label>
		
	</div>

</div>


<div id="wx-add-facebook-albums-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Enter your Facebook page URL</p>

		<input type='text' value='' class='wx-input wx-social-input' id='wx-facebook-albums-value' name='component_behaviour' />
		<label for='wx-facebook-albums-value' id='wx-facebook-url' class='wx-social-label'><?php echo JText::_('WEEVER_FACEBOOK_URL'); ?></label>
		
	</div>

</div>


<div id="wx-add-facebook-events-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Enter your Facebook page URL</p>

		<input type='text' value='' class='wx-input wx-social-input' id='wx-facebook-events-value' name='component_behaviour' />
		<label for='wx-facebook-events-value' id='wx-facebook-url' class='wx-social-label'><?php echo JText::_('WEEVER_FACEBOOK_URL'); ?></label>
		
	</div>

</div>


<div id="wx-add-twitter-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Twitter...</p>
		
		<div id="add-twitter-user" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/TwitterBird_NoCircle.png" />
			<span>Twitter User</span>
		</div>
		
		<div id="add-twitter-hashtag" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/TwitterBird_NoCircle.png" />
			<span>Hash Tag</span>
		</div>
		
		<div id="add-twitter-search" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/TwitterBird_NoCircle.png" />
			<span>Search Term</span>
		</div>
		
	</div>

</div>


<div id="wx-add-facebook-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Facebook Pages...</p>
		
		<div id="add-facebook-stream" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Facebook_Square.png" />
			<span>Status Stream</span>
		</div>
		
		<div id="add-facebook-albums" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Facebook_Square.png" />
			<span>Photo Albums</span>
		</div>
		
		<div id="add-facebook-events" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Facebook_Square.png" />
			<span>Events</span>
		</div>
		
	</div>

</div>



<div id="wx-add-youtube-channel-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Youtube Channel / User...</p>
		
		
		<input type='text' value='' placeholder='http://' name='component_behaviour' id='wx-youtube-channel-url' class='wx-input wx-video-input' />
		<label for='wx-youtube-channel-url' id='wx-youtube-url' class='wx-video-label'><?php echo JText::_('WEEVER_YOUTUBE_URL'); ?></label>
				
				
	</div>

</div>



<div id="wx-add-youtube-playlist-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Youtube Playlist...</p>
		
		
		<input type='text' value='' placeholder='http://' name='component_behaviour' id='wx-youtube-playlist-url' class='wx-input wx-video-input' />
		<label for='wx-youtube-playlist-url' id='wx-youtube-playlist-url-label' class='wx-video-label'><?php echo JText::_('WEEVER_YOUTUBE_PLAYLIST_URL'); ?></label>
				
				
	</div>

</div>


<div id="wx-add-youtube-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Youtube...</p>
		
		<div id="add-youtube-channel" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Youtube_NoCircle.png" />
			<span>Channel / User</span>
		</div>
		
		<div id="add-youtube-playlist" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Youtube_NoCircle.png" />
			<span>Playlist</span>
		</div>
		
	</div>

</div>


<div id="wx-add-vimeo-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Vimeo User or Channel...</p>
		
		
		<input type='text' value='' placeholder='http://' name='component_behaviour' id='wx-vimeo-channel-url' class='wx-input wx-video-input' />
		<label for='wx-vimeo-channel-url' id='wx-vimeo-url' class='wx-video-label'><?php echo JText::_('WEEVER_VIMEO_URL'); ?></label>
				
				
	</div>

</div>


<div id="wx-add-wufoo-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Add your Wufoo Forms...</p>
		
		<input type='text' id='wx-form-url' class='wx-input wx-form-input' name='url' />
		<label for='wx-form-url'><?php echo JText::_('WEEVER_WUFOO_FORM_URL'); ?></label>
		
		<input type='text' id='wx-form-api-key' class='wx-input wx-form-input' name='api_key' />
		<label for='wx-form-api-key'><?php echo JText::_('WEEVER_WUFOO_API_KEY'); ?></label>
				
	</div>

</div>


<div id="wx-add-foursquare-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Add your Foursquare Venue Photos...</p>
		
		<input type='text' value='' id='wx-foursquare-photo-url' class='wx-input wx-photo-input' name='url' />
		<label for='wx-foursquare-photo-url' id='wx-foursquare-url' class='wx-photo-label'><?php echo JText::_('WEEVER_FOURSQUARE_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-picasa-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Add your Picasa Albums...</p>
		
		<input type='text' value='' id='wx-picasa-photo-url' class='wx-input wx-photo-input' name='url' />
		<label for='wx-picasa-photo-url' id='wx-google-picasa-email' class='wx-photo-label'><?php echo JText::_('WEEVER_GOOGLE_PICASA_EMAIL'); ?></label>
				
	</div>

</div>


<div id="wx-add-google_calendar-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Add your Google Calendar...</p>
		
		<input type='text' value='yourname@email.com' id='wx-google-calendar-email' class='wx-calendar-input wx-input' name='email' />
		<label for='wx-google-calendar-email' id='wx-google-calendar-email-label'><?php echo JText::_('WEEVER_GOOGLE_CALENDAR_EMAIL_ID'); ?></label>
				
	</div>

</div>

<div id="wx-add-blogger-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Add your Blogger...</p>
		
		<input type='text' value='' id='wx-add-blog-blogger-url-input' class='wx-input wx-blog-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_BLOGGER_URL_PLACEHOLDER"); ?>' />
		<label for='wx-add-blog-blogger-url-input' id='wx-add-blog-blogger-url-input-label' class='wx-blog-label'><?php echo JText::_('WEEVER_ADD_BLOGGER_URL_LABEL'); ?></label>
				
	</div>

</div>


<div id="wx-add-identica-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>Add your Identi.ca...</p>
		
		<input type='text' value='' class='wx-input wx-social-input' id='wx-identica-social-value' name='component_behaviour' />
		<label for='wx-identica-social-value' id='wx-identica-query' class='wx-social-label'><?php echo JText::_('WEEVER_IDENTICA_QUERY'); ?></label>

	</div>

</div>


<div id="wx-add-flickr-photostream-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Flickr PhotoStream...</p>
		
		
		<input type='text' value='' id='wx-flickr-photostream-photo-url' class='wx-input wx-photo-input' name='url' />
		<label for='wx-flickr-photostream-photo-url' id='wx-flickr-url' class='wx-photo-label'><?php echo JText::_('WEEVER_FLICKR_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-flickr-photosets-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Flickr Photosets...</p>
		
		
		<input type='text' value='' id='wx-flickr-photosets-photo-url' class='wx-input wx-photo-input' name='url' />
		<label for='wx-flickr-photosets-photo-url' id='wx-flickr-url' class='wx-photo-label'><?php echo JText::_('WEEVER_FLICKR_URL'); ?></label>
				
	</div>

</div>


<div id="wx-add-flickr-dialog" class="wx-jquery-dialog wx-hide">

	<div><p>From Flickr...</p>
		
		<div id="add-flickr-photostream" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Flickr_Circle.png" />
			<span>PhotoStream (latest only)</span>
		</div>
		
		<div id="add-flickr-photosets" class="wx-add-item-icon">
			<img src="components/com_weever/assets/icons/sources/Flickr_Circle.png" />
			<span>All Photosets</span>
		</div>
		
	</div>

</div>

<div id="wx-add-r3s-dialog" class="wx-jquery-dialog wx-hide">

	<p>Add an R3S Feed Directly...</p>
	
	<div id="wx-add-page-r3s-url">
	
		<input type='text' value='' id='wx-add-page-r3s-url-input' class='wx-input wx-page-input' name='unnamed' placeholder='<?php echo JText::_("WEEVER_R3S_URL_PLACEHOLDER"); ?>' />
		<label for='wx-add-page-r3s-url-input' id='wx-add-page-r3s-url-input-label' class='wx-page-label'><?php echo JText::_('WEEVER_ADD_R3S_URL_LABEL'); ?></label>
		
	</div>

</div>

</div>


<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $this->site_key; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="view" value="list" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<?php echo JHTML::_('form.token'); ?>
</form>
</div>

