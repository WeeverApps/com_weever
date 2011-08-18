<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	0.9.2
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

$option = JRequest::getCmd('option');
JHTML::_('behavior.tooltip');

jimport('joomla.html.pane');

$document = &JFactory::getDocument();

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery.js' );
$document->addCustomTag ('<script type="text/javascript">jQuery.noConflict();</script>');

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-ui.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-impromptu.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/weever.js' );

$cssFile = JURI::base(true).'/components/com_weever/assets/css/ui-lightness/jquery-ui.css';
	$document->addStyleSheet($cssFile, 'text/css', null, array());

$cssFile = JURI::base(true).'/components/com_weever/assets/css/jquery-impromptu.css';
	$document->addStyleSheet($cssFile, 'text/css', null, array());
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list.js' );

$this->loadTemplate($row->component.'base64images');

jimport('joomla.filter.output');


$child_html = "";
$k = 0; // for alternating shaded rows
$iii = 0; // for making checkboxes line up right
$tabsUnpublished = 0;
$onlineSpan = "";
$offlineSpan = "";

if($this->appEnabled)
	$offlineSpan = 'class="wx-app-hide-status"';
else 
	$onlineSpan = 'class="wx-app-hide-status"';

?>

<div id="wx-app-status-button"><img id="wx-app-status-img" src="../media/com_weever/icon_live.png?nocache=<?php echo microtime(); ?>" /><br /><span id="wx-app-status-online" <?php echo $onlineSpan; ?>>Online</span><span id="wx-app-status-offline" <?php echo $offlineSpan; ?>>Offline</span></div>

<div id="listTabs">
<ul id="listTabsSortable" style="padding-right: 50%">

<?php 

for($i=0, $n=count($this->tabRows); $i < $n; $i++)
{
	$row = &$this->tabRows[$i];
	$componentRowsName = $row->component . 'Rows';
	$componentRows = $this->{$componentRowsName};
	$tabActive = 0;
	
	for($ii=0, $nn=count($componentRows); $ii<$nn; $ii++)
	{
	
		$subrow = &$componentRows[$ii];
		
		if($subrow->published)
			$tabActive = 1;
	
	}
	
	
	$componentRowsCount = count($componentRows);
	$tabIcon = $row->component . "Icon";
	
	if(!$componentRowsCount || $tabActive == 0)
		echo '<li id="'. $row->component . 'TabID" class="wx-nav-tabs" rel="unpublished" style="float:right;" style="float:center;"><a href="#'. $row->component . 'Tab" class="wx-tab-sortable"><div class="'.$row->icon.' wx-grayed-out wx-nav-icon" rel="'.$this->site_key.'" style="height:32px;width:auto;min-width:32px;text-align:center" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.$this->theme->{$tabIcon}.'" /></div><div class="wx-nav-label wx-grayed-out" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';	

	else
		echo '<li id="'. $row->component . 'TabID" class="wx-nav-tabs" ><a href="#'. $row->component . 'Tab" class="wx-tab-sortable"><div class="'.$row->icon.' wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" rel="'.$this->site_key.'" title="'.$row->component.'"><img class="wx-nav-icon-img" src="data:image/png;base64,'.$this->theme->{$tabIcon}.'" /></div><div class="wx-nav-label" title="ID #'.$row->id.'">'.$row->name.'</div></a></li>';	
	

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

	$link = JFilterOutput::ampReplace('index.php?option=' . $option . '&task=edit&layout=tab&cid[]='.$row->id);
	
	$componentRowsName = $row->component . 'Rows';
	$componentRows = $this->{$componentRowsName};
	
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
	
	<?php echo $this->loadTemplate($row->component.'dropdown'); ?>

	<input type="hidden" name="boxchecked<?php echo $row->component; ?>" id="boxchecked<?php echo $row->component; ?>" value="0" />
	<table class='adminlist'>
	<thead>
	<tr>
	<th width='20'>
		<input type='checkbox' name='toggle<?php echo $row->component; ?>' id='toggle<?php echo $row->component; ?>' value='' onclick='checkAllTab(<?php echo count($componentRows); ?>, "cb", document.getElementById("boxchecked<?php echo $row->component; ?>"), document.getElementById("toggle<?php echo $row->component; ?>"), <?php echo $iii; ?> + 1);' />
	</th>
	
	<th class='title'><?php echo JHTML::_('grid.sort', JText::_('NAME'), 'name', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	<th width='8%' nowrap='nowrap'><?php echo JHTML::_('grid.sort', JText::_('PUBLISHED'), 'published', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	<th width='8%' nowrap='nowrap'><?php echo JHTML::_('grid.sort', JText::_('ORDER'), 'ordering', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	<th width='5%' nowrap='nowrap'><?php echo JHTML::_('grid.sort', JText::_('ID'), 'id', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	<th width='8%' nowrap='nowrap'><?php echo JText::_('WEEVER_CAP_D_DELETE'); ?></th>
	</tr>
	</thead>
	
	<?php

	$k = 1 - $k;
	$sub = 0;
	
	for($ii=0, $nn=count($componentRows); $ii<$nn; $ii++)
	{
	
		$iii++; $sub++;
		$row = &$componentRows[$ii];			
	
		
		?>
		
		<tr class='<?php echo "row$k"; ?>'>
		<td>
			<?php echo JHTML::_('grid.id', $iii, $row->id); ?>
		</td>
		
		<td>
			<a href='#' title="ID #<?php echo $row->id; ?>" class="wx-subtab-link"><?php echo $row->name; ?></a>
		</td>
		<td align='center'>
			 <a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-publish"<?php echo ($row->published ? 'rel="1"><img src="components/com_weever/assets/icons/tick.png" border="0" alt="Published">' : 'rel="0"><img src="components/com_weever/assets/icons/publish_x.png" border="0" alt="Unpublished">'); ?></a>
		</td>
		<td align="center">
			<a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-down" rel="<?php echo $row->type; ?>"><img src="components/com_weever/assets/icons/downarrow.png" width="16" height="16" border="0" alt="Move Down"></a>
			<a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-up" rel="<?php echo $row->type; ?>"><img src="components/com_weever/assets/icons/uparrow.png" width="16" height="16" border="0" alt="Move Up"></a>
			(<?php echo floor($row->ordering); ?>)
		</td>
		<td align='center'>
			<?php echo $row->id; ?>
		</td>
		<td align='center'><a href="#" title="ID #<?php echo $row->id; ?>" class="wx-subtab-delete" rel="<?php echo $row->type; ?>" alt=" <?php echo JText::_('WEEVER_DELETE'); ?> &quot;<?php echo htmlentities($row->name); ?>&quot;"><img src="components/com_weever/assets/icons/wx-delete-mark.png" /></a></td>
		
		</tr>
		
		<?php
		$k = 1 - $k;
		
	}
	
	if(!count($componentRows))
	{
	
		echo "<tr><td colspan='6'>".JText::_('WEEVER_NO_ITEMS_IN_TAB')."</td></tr>";
	
	}
	
	?>
	
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

