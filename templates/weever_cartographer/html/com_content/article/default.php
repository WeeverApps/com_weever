<?php
/*
*
*	Weever Cartographer R3S Output Template for Joomla
*	(c) 2010-2011 Weever Inc. <http://www.weever.ca/>
*
*	Author: 	Robert Gerald Porter (rob@weeverapps.com)
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
*
*
 * ORIGINAL COPYRIGHTS BELOW
 *
 *
 * @version		$Id: default.php 20817 2011-02-21 21:48:16Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport( 'joomla.environment.uri' );

require_once(JPATH_THEMES . DS . 'weever_cartographer' . DS . 'simpledom' . DS . 'simpledom.php');
require_once(JPATH_THEMES . DS . 'weever_cartographer' . DS . 'classes' . DS . 'r3s.php');

$document =& JFactory::getDocument();
header('Content-type: application/json');		
header('Cache-Control: no-cache, must-revalidate');

$callback = JRequest::getVar('callback');

// specs @ https://github.com/WeeverApps/r3s-spec



$conf =& JFactory::getConfig();
$lang =& JFactory::getLanguage();

$jsonHtml = new R3SHtmlContentDetailsMap;

$jsonHtml->language = $lang->_default;
$jsonHtml->publisher = $conf->getValue('config.sitename');

$version = new JVersion;
$joomla = $version->getShortVersion();


if(substr($joomla,0,3) == '1.5')  // ### 1.5 only
{

	$jsonHtml->name = $this->article->title;
	
	$author =  $this->article->author;
	$author = ($this->article->created_by_alias ? $this->article->created_by_alias : $author);
	
	$jsonHtml->author = $author;
	$jsonHtml->datetime["published"] = $this->article->created;
	$jsonHtml->datetime["modified"] = $this->article->modified;

	?>
	<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
		<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</div>
	<?php endif; ?>
	<?php if ($canEdit || $this->params->get('show_title')) : ?>
	<table class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<tr>
		<?php if ($this->params->get('show_title')) : ?>
		<td class="contentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>" width="100%">
			<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
			<a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
				<?php echo $this->escape($this->article->title); ?></a>
			<?php else : ?>
				<?php echo $this->escape($this->article->title); ?>
			<?php endif; ?>
		</td>
		<?php endif; ?>
		
	</tr>
	</table>
	<?php endif; ?>
	
	<?php  if (!$this->params->get('show_intro')) :
		echo $this->article->event->afterDisplayTitle;
	endif; ?>
	<?php echo $this->article->event->beforeDisplayContent; ?>
	<table class="contentpaneopen<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
	<tr>
		<td valign="top">
			<span class="small">
				<?php JText::printf( 'Written by', ($this->escape($this->article->created_by_alias) ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author)) ); ?>
			</span>
			&nbsp;&nbsp;
		</td>
	</tr>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_create_date')) : ?>
	<tr>
		<td valign="top" class="createdate">
			<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr>
	<td valign="top">
	<?php if (isset ($this->article->toc)) : ?>
		<?php echo $this->article->toc; ?>
	<?php endif; ?>
	<?php echo $this->article->text; ?>
	</td>
	</tr>
	
	<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
	<tr>
		<td class="modifydate">
			<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</td>
	</tr>
	<?php endif; ?>
	</table>
	<span class="article_separator">&nbsp;</span>
	<?php echo $this->article->event->afterDisplayContent; ?>

	<?php	
	
	$jsonHtml->html = ob_get_clean();
	
	$jsonHtml->image = null;
	

	$html = SimpleHTMLDomHelper::str_get_html($jsonHtml->html);
	
	foreach(@$html->find('img') as $vv)
	{
		if($vv->src)
			$jsonHtml->image = JURI::root().$vv->src;
	}
	
	if(!$v->image)
		$jsonHtml->image = JURI::root()."media/com_weever/icon_live.png";

	
	// Mask external links so we leave only internal ones to play with.
	$jsonHtml->html = str_replace("href=\"http://", "hrefmask=\"weever://", $jsonHtml->html);
	
	// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
	$jsonHtml->html = str_replace("target=\"_blank\"", "", $jsonHtml->html);
	$jsonHtml->html = str_replace("href=\"", "target=\"_blank\" href=\"".JURI::root(), $jsonHtml->html);
	$jsonHtml->html = str_replace("src=\"/", "src=\"".JURI::root(), $jsonHtml->html);
	$jsonHtml->html = str_replace("src=\"images", "src=\"".JURI::root()."images", $jsonHtml->html);
	
	// Restore external links, ensure target="_blank" applies
	$jsonHtml->html = str_replace("hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);
	$jsonHtml->html = str_replace("<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
										"<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html);
	
	$jsonOutput = new jsonOutput;
	$jsonOutput->results[] = $jsonHtml;
	$output = json_encode($jsonOutput);
	
	if($callback)
		$json = $callback."(".$output.")";
	else 
		$json = $output;
	
	
	print_r($json);
	
	jexit();

}

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');


$jsonHtml->name = $this->item->title;

$author =  $this->item->author;
$author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);

$jsonHtml->author = $author;
$jsonHtml->datetime["published"] = $this->item->created;
$jsonHtml->datetime["modified"] = $this->item->modified;



// Create shortcuts to some parameters.
$params		= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
?>
<div class="item-page<?php echo $this->pageclass_sfx?>">

<h1 class="wx-article-title">
	<?php echo $this->escape($this->item->title); ?>
</h1>

<?php  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php $useDefList = (($params->get('show_author')) OR ($params->get('show_category')) OR ($params->get('show_parent_category'))
	OR ($params->get('show_create_date')) OR ($params->get('show_modify_date')) OR ($params->get('show_publish_date'))
	OR ($params->get('show_hits'))); ?>

<?php if ($useDefList) : ?>
	<dl class="article-info">
	<dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
	<dd class="parent-category-name">
	<?php	$title = $this->escape($this->item->parent_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : ?>
		<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
	<dd class="category-name">
	<?php 	$title = $this->escape($this->item->category_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_category') AND $this->item->catslug) : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
	<dd class="create">
	<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
	<dd class="modified">
	<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
	<dd class="published">
	<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<dd class="createdby"> 
	<?php $author =  $this->item->author; ?>
	<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

	<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
		<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' , 
		 JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>

	<?php else :?>
		<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>	
<?php if ($params->get('show_hits')) : ?>
	<dd class="hits">
	<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
	</dd>
<?php endif; ?>
<?php if ($useDefList) : ?>
	</dl>
<?php endif; ?>

<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<?php if ($params->get('access-view')):?>
	<?php echo $this->item->text; ?>
	
	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs);  ?> 
		<?php 
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
			    echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?></a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>
</div>


<?php 

$jsonHtml->html =  ob_get_clean();

$jsonHtml->image = null;


	$html = SimpleHTMLDomHelper::str_get_html($jsonHtml->html);
	
	foreach(@$html->find('img') as $vv)
	{
		if($vv->src)
			$jsonHtml->image = JURI::root().$vv->src;
	}
	
	if(!$v->image)
		$jsonHtml->image = JURI::root()."media/com_weever/icon_live.png";


// Mask external links so we leave only internal ones to play with.
$jsonHtml->html = str_replace("href=\"http://", "hrefmask=\"weever://", $jsonHtml->html);

// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
$jsonHtml->html = str_replace("target=\"_blank\"", "", $jsonHtml->html);
$jsonHtml->html = str_replace("href=\"", "target=\"_blank\" href=\"".JURI::root(), $jsonHtml->html);
$jsonHtml->html = str_replace("src=\"/", "src=\"".JURI::root(), $jsonHtml->html);
$jsonHtml->html = str_replace("src=\"images", "src=\"".JURI::root()."images", $jsonHtml->html);

// Restore external links, ensure target="_blank" applies
$jsonHtml->html = str_replace("hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);
$jsonHtml->html = str_replace("<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
									"<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html);

$jsonOutput = new jsonOutput;
$jsonOutput->results[] = $jsonHtml;
$output = json_encode($jsonOutput);

if($callback)
	$json = $callback."(".$output.")";
else 
	$json = $output;

print_r($json);

jexit();
