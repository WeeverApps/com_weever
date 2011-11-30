<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
*	Version: 	1.3
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
JHTML::_('behavior.mootools');
jimport('joomla.html.pane');

$document = &JFactory::getDocument();

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery.js' );
$document->addCustomTag ('<script type="text/javascript">jQuery.noConflict();</script>');

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-ui.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jquery-impromptu.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/weever.js' );
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/account.js' );

$joomla = comWeeverHelper::joomlaVersion();

if(substr($joomla,0,3) != '1.5')  // ### non-1.5 only
	$jsJoomla = "Joomla.";
else 
	$jsJoomla = "";


$pane = &JPane::getInstance('tabs');

$plugin_html_enabled = "";
$plugin_html_disabled = "";

if(!$this->site_key)
{

	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_NO_SITEKEY'));

}

$onlineSpan = "";
$offlineSpan = "";

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

?>

<?php if($this->account->tier_number == 1) : ?>
	<div style="position:absolute; right:10px; top:136px; margin:0 1em;">
	<span style="float: right; font-size: 10px;"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION'); ?></span>
	<span style="float:right; line-height: 1.25em; font-size: 1em; text-align: right; margin:1px 1.5em 0 0;"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION_LEARN_MORE'); ?></span></div>

<?php elseif($this->account->tier_number == 2.1) : ?>
	<span style="font-size: 1.5em; position: absolute; right: 10px; line-height: 1.25em; min-width: 420px; text-align: left; margin: 0pt; top: 136px;"><a href="http://weeverapps.com/pricing" style="float: left; margin: 0pt 1em;" id="headerbutton"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BUTTON'); ?></a><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_CALL'); ?><br><span style="font-size: 0.75em; margin: 0pt;"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BYLINE'); ?></span></span>
	
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

<div class="supportlist">

<div>
	<fieldset class='adminForm'>
		<legend>How to Build Your App</legend>
		
		
        <div style="margin:0 1em 1em 1.25em;">



<p>If you are new to Weever Apps — <a href="http://weeverapps.zendesk.com/" title="Weever Apps Support" target="_blank">http://weeverapps.zendesk.com</a> is <em>the</em> place to start. Ask questions, find answers and request new features!</p>







<ul class="supportlistarrow segmentedlist"><strong>New!</strong> — Weever Apps Tutorial Videos
<li class="none"><a href="http://weeverapps.zendesk.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#social">How to add Social Media</a><br>(YouTube, Flickr, etc.) to your app.</li>
<li><a href="http://weeverapps.zendesk.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#publishing">How to Choose Mobile Devices</a><br>you wish to display your app on.</li>
<li><a href="http://weeverapps.zendesk.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#icons">Editing App-Navigation Icons</a><br>aka, 'tab bar icons' to change the image and text-label</li>
</ul>
<ul class="supportlistarrow segmentedlist">
<li><a href="http://weeverapps.zendesk.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#staging">Staging Mode</a><br>- a separate 'sandbox' for your app!</li>
<li><a href="http://weeverapps.zendesk.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps&quot;">View all videos</a></li>
</ul>	





</div>
        
        
	</fieldset>
	<fieldset class='adminForm'>
    	<legend><?php echo JText::_('WEEVER_APPS_NEWS'); ?></legend>
    	
    	 <div style="margin:0 1em 1em 1.25em;">



<p>We add new features all the time! &nbsp;View <a href="http://weeverapps.com/pricing">plans &amp; pricing</a></p>






<ul class="supportliststar segmentedlist"><strong>Latest News...</strong>
<li><a href="http://weeverapps.com/pricing">Mobile Maps</a> for Joomla! Sites - Wordpress soon!</li>
<li>Weever Apps <a href="http://weeverapps.com/blog/item/136-weever-apps-wins-lions-lair">wins the "Lion's Lair" TV Contest</a></li>
<li>Latest Featured App: <a href="http://weeverapps.com/apps/item/143-souls-harbour">Souls Harbour, UK</a></li>
</ul>
<ul class="supportliststar segmentedlist"><strong>Connect with us!</strong>
<li>Follow <a href="http://twitter.com/weeverapps">@WeeverApps</a> on Twitter</li>
<li><a href="http://eepurl.com/fP-oD">Subcribe to our newsletter</a> for product updates</li>
<li>Visit Weever Apps on <a href="http://www.facebook.com/pages/Weever-Apps/116527295103220">Facebook</a></li>
<li><a href="http://weeverapps.com/blog">Read our blog</a> on Joomla!, Wordpress and Mobile</li>
</ul>	





</div>
        
	</fieldset>
    
    
    	<fieldset class='adminForm'>
    	<legend><?php echo JText::_('WEEVER_FAQ'); ?></legend>
    	
    	 <div style="margin:0 1em 1em 1.25em;">



<p>For more quesitons and answers, please visit our <a href="http://weeverapps.zendesk.com">support site</a>.</p>
<br/>


<ul class="supportlistarrow"><a href="http://weeverapps.com/pricing">Premium &amp; Pro</a> Features
<li>How do I make a <strong><a href="http://weeverapps.zendesk.com/entries/20611136-how-do-i-make-a-weever-map">Weever Map?</a></strong></li>
<li>How do I setup a <a href="http://weeverapps.zendesk.com/entries/20394158-how-do-i-use-my-own-domain-name-web-site-address-url-with-weever-apps">app.yoursitename.com address</a> for my app?</li>
<li>Can I change the 'Powered by' message on launch?<br/>Yes, just go to 'Mobile Publishing' in the plugin settings.</li>
</ul>	
<br/>


<ul class="supportlistarrow">Marketing &amp; Sales
<li>Do Weever Apps Install?<br/>Yes! - See the end of <a href="http://weeverapps.com">this video</a> for an example.  'Prompt to install' is coming soon!</li>
<li>Can I setup a 'landing page' in my app?<br/>Yes! The latest Weever Apps releases include the options to use a single landing page, or to select content from your site for a 'landing page app slideshow'</li>
<li>How much data do you store on your servers?<br/><a href="http://weeverapps.zendesk.com/entries/20315147-where-does-the-code-stays">Almost none</a>. Your privacy and security is important to us.</li>
</ul>
<br/>
<ul class="supportlistarrow">Technical / Advanced
<li>Can I style the app with CSS? - <em>Sure!</em><br/>Just go to 'logo, images and theme' and select 'advanced'.</li>
<li>What is 'Staging Mode'?<br/>Staging mode creates a separate copy of your Weever App in a test environment.  It's a 'sandbox' mode for you to try new features</li>
</ul>





</div>
        
	</fieldset>
    
    
    
</div>
</div>
