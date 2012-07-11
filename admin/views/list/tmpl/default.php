<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	1.8
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

$extraScript	= '';

JHTML::_('behavior.tooltip');
JHTML::_('behavior.mootools');
JHTML::_('behavior.modal', 'a.modal');

jimport('joomla.html.pane');

if(comWeeverHelper::joomlaVersion() == '1.5')  // ### 1.5 only
	$js_close = "document.getElementById('sbox-window').close();";
else 
	$js_close = "window.parent.SqueezeBox.close();";
	
if( !comWeeverHelper::componentExists("com_k2") )
	$extraScript .= "var wxComK2	= false;";
else 
	$extraScript .= "var wxComK2	= true;";
	
if( !comWeeverHelper::componentExists("com_easyblog") )
	$extraScript .= "var wxComEasyBlog	= false;";
else 
	$extraScript .= "var wxComEasyBlog	= true;";
	
if( JRequest::getVar('swipe_page') )
	$js_swipe_page = " wx.swipe.slide( " . JRequest::getVar('swipe_page') . ", 400 ); ";
else 
	$js_swipe_page = "";

$document->addCustomTag ('<script type="text/javascript">

				function jSelectItem(id, title, object) {
			
                    jQuery(\'#wx-add-k2-item-url\').val(\'index.php?option=com_k2&view=item&id=\' + id);
                    jQuery(\'#wx-add-k2-item-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectItem(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-item-url\').val(\'index.php?option=com_easyblog&view=entry&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-item-name\').val(title);
                   '.$js_close.'
                       
                }

				function jSelectCategory(id, title, object) {
			
                    jQuery(\'#wx-add-k2-category-url\').val(\'index.php?option=com_k2&view=itemlist&layout=category&task=category&template=weever_cartographer&id=\' + id);
                    jQuery(\'#wx-add-k2-category-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectCategory(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-category-url\').val(\'index.php?option=com_easyblog&view=categories&layout=listings&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-category-name\').val(title);
                   '.$js_close.'
                       
                }

				function jSelectTag(id, title, object) {
			
                    jQuery(\'#wx-add-k2-tag-url\').val(\'index.php?option=com_k2&view=itemlist&task=tag&template=weever_cartographer&tag=\' + title);
                    jQuery(\'#wx-add-k2-tag-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectTag(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-tag-url\').val(\'index.php?option=com_easyblog&view=tags&layout=tag&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-tag-name\').val(title);
                   '.$js_close.'
                       
                }
                
                function jSelectArticle(id, title, object) {
                
            		jQuery(\'#wx-add-joomla-article-name\').val(title);
            		jQuery(\'#wx-add-joomla-article-url\').val(\'index.php?option=com_content&view=article&id=\' + id);
            		'.$js_close.'
                		
                }
                
                function jSelectArticleNew(id, title, catid, object) {
					
					jQuery(\'#wx-add-joomla-article-name\').val(title);
					jQuery(\'#wx-add-joomla-article-url\').val(\'index.php?option=com_content&view=article&id=\' + id);
					'.$js_close.'
					
                }
                
                jQuery( document ).ready( function() {
                
                	'.$js_swipe_page.'
                	
                	jQuery(\'html, body\').animate({scrollTop:0}, \'fast\');
                
                });
                
                '.$extraScript.'
                
                </script>
                
	');
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list_icons.js?v='.comWeeverConst::VERSION );
//99$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list.js?v='.comWeeverConst::VERSION );

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.tabtypes.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.features.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.swipepages.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.tabcomponents.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/wx.build.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/wx.list.joomla.ini.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jq.list.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/swipe.js?v='.comWeeverConst::VERSION );

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
			<a href="http://weeverapps.com/pricing"><?php echo JText::_('WEEVER_PLANS_AND_PRICING'); ?></a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps"><?php echo JText::_('WEEVER_FOLLOW_TWITTER'); ?></a> &nbsp; </a>

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

<div id="wx-list-workspace">

<div id="listTabs">

<ul id="listTabsSortable" style="padding-right: 5%">

	<li id="addTabID" class="wx-nav-tabs wx-nosort"><a href="#addTab" class="wx-tab-sortable"><div class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="Add"><span style="display: block; margin: 0pt auto; position: relative; font-weight: bold; font-size: 2.75em; line-height: normal;">+</span></div><div class="wx-nav-label">New Feature</div></a></li>

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
		
	if($componentRowsCount && $tabActive == 0)
		echo '<li id="' . $row->component . 'TabID" class="wx-nav-tabs wx-sort" rel="unpublished" style="float:center;">
				<a href="#' . $row->component . 'Tab" class="wx-tab-sortable' . $trialClass.'">
				
					<div id="wx-nav-icon-' . $row->id . '" ref="' . $row->id . '" class="wx-grayed-out wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="' . $row->component . '">
					
						<img class="wx-nav-icon-img" src="data:image/png;base64,' . @$this->theme->{$tabIcon} . '" />
						
					</div>
					
					<div id="wx-nav-label-' . $row->id . '" class="wx-nav-label wx-grayed-out" ref="' . $row->id . '" title="ID #' . $row->id . '">' . $row->name . '</div>
					
				</a>
				
			</li>';	
	
	else if(!$componentRowsCount)
		echo '<li id="' . $row->component . 'TabID" class="wx-nav-tabs" rel="unpublished" style="float:right;display:none" style="float:center;">
				<a href="#'. $row->component . 'Tab" class="wx-tab-sortable'.$trialClass.'">
				
					<div id="wx-nav-icon-' . $row->id . '" ref="' . $row->id . '" class="wx-grayed-out wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="'.$row->component.'">
					
						<img class="wx-nav-icon-img" src="data:image/png;base64,'.@$this->theme->{$tabIcon}.'" />
						
					</div>
					
					<div id="wx-nav-label-' . $row->id . '" class="wx-nav-label wx-grayed-out" ref="' . $row->id . '" title="ID #'.$row->id.'">'.$row->name.'</div>
					
				</a>
				
			</li>';

	else
		echo '<li id="'. $row->component . 'TabID" class="wx-nav-tabs wx-sort">
					<a href="#'. $row->component . 'Tab" class="wx-tab-sortable'.$trialClass.'">
					
						<div id="wx-nav-icon-' . $row->id . '" ref="' . $row->id . '" class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="'.$row->component.'">
						
							<img class="wx-nav-icon-img" src="data:image/png;base64,'.@$this->theme->{$tabIcon}.'" />
						
						</div>
						
						<div id="wx-nav-label-' . $row->id . '" ref="' . $row->id . '" class="wx-nav-label" title="ID #'.$row->id.'">'.$row->name.'</div>
						
					</a>
				</li>';	
	
}

 ?>
 
 </ul>
 
 <div id="addTab">

    <div id="wx-add-content-to-app">
    
    <div id="wx-add-content-nav">
    
    <button id='wx-content-nav-0' class="wxui-btn red large radius3 wx-floatleft" onclick="wx.swipe.slide(0, 300)">1. Add Site Content</button><span class="wx-rightarrow">&#x27A6;</span>
    <button id='wx-content-nav-1' class="wxui-btn white large radius3 wx-floatleft" onclick="wx.swipe.slide(1, 300)">2. Add Social Media</button><span class="wx-rightarrow">&#x27A6;</span>
    <button id='wx-content-nav-2' class="wxui-btn white large radius3 wx-floatleft" onclick="wx.swipe.slide(2, 300)">3. Add Audio, Video & Photos</button><span class="wx-rightarrow">&#x27A6;</span>
    <button id='wx-content-nav-3' class="wxui-btn white large radius3 wx-floatleft" onclick="wx.swipe.slide(3, 300)">4. Add Events & Forms</button><span class="wx-rightarrow">&#x27A6;</span>
    <button id='wx-content-nav-4' class="wxui-btn white large radius3 wx-floatleft" onclick="wx.swipe.slide(4, 300)">Done!</button>

    
    </div>
 		
 		<div id="wx-swipe" class="swipe">
 		
 		<div id="wx-swipe-wrap" class="swipe-wrap">
 				
 		</div>
 			
        </div>
 		
    </div>
    
 	
</div>
 
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
		
		<?php //echo $this->loadTemplate($row->component.'dropdown'); ?>
		
		<div class="wx-tab-top-buttons-container">
		
			<button class="wxui-btn white medium radius3 wx-add-source-icon" style="margin-right:1.5em;" ref="add-<?php echo $row->component; ?>-type">+ &nbsp;Add More Content</button>
			<button class="wxui-btn white medium radius3 wx-nav-label" style="margin-right:1.5em;" ref="<?php echo $row->id; ?>">&bull; &nbsp;Change Tab Name</button>
			<button class="wxui-btn white medium radius3 wx-nav-icon" style="margin-right:1.5em;" ref="<?php echo $row->id; ?>" title="<?php echo $row->component; ?>">&bull; &nbsp;Change Tab Icon</button>
			
			<?php if( $row->component == "panel" || $row->component == "aboutapp" || $row->component == "map" ) : ?>
			
				<button class="wxui-btn white medium radius3 wx-tab-settings" rel="<?php echo $row->component; ?>">&bull; &nbsp;Change Tab Settings</button>
				
			<?php endif; ?>
		
		</div>
		
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
</div>

<?php echo $this->loadTemplate('dialogs'); ?>

