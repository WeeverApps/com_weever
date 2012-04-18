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

$option = JRequest::getCmd('option');
JHTML::_('behavior.mootools');
jimport('joomla.html.pane');

if(comWeeverHelper::joomlaVersion() != '1.5')  // ### non-1.5 only
	$jsJoomla = "Joomla.";
else 
	$jsJoomla = "";

$pane = &JPane::getInstance('tabs');

$plugin_html_enabled = "";
$plugin_html_disabled = "";
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

if(comWeeverHelper::isWebKit())
	$dashWebKit = "-webkit";
else 
	$dashWebKit = "";

?>

<?php if($this->account->tier_number == 1) : ?>
	<div class="wx-promotion-basic<?php echo $dashWebKit; ?>">
	<span class="wx-promotion-basic-title"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION'); ?></span>
	<span class="wx-promotion-basic-link"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION_LEARN_MORE'); ?></span></div>

<?php elseif($this->account->tier_number == 2.1) : ?>
	<span class="wx-promotion-trial<?php echo $dashWebKit; ?>"><a href="http://weeverapps.com/pricing" class="wx-promotion-trial-button" id="headerbutton"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BUTTON'); ?></a><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_CALL'); ?><br><span class="wx-promotion-trial-byline"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BYLINE'); ?></span></span>
	
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

		
		
		<p>If you are new to Weever Apps — <a href="http://support.weeverapps.com/" title="Weever Apps Support" target="_blank">http://support.weeverapps.com</a> is <em>the</em> place to start. Ask questions, find answers and request new features!</p>
		
		
		
		
		
		
		
		<ul class="supportlistarrow segmentedlist"><strong>New!</strong> — Weever Apps Tutorial Videos
		<li class="none"><a href="http://support.weeverapps.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#social" target="_blank">How to add Social Media</a><br>(YouTube, Flickr, etc.) to your app.</li>
		<li><a href="http://support.weeverapps.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#publishing" target="_blank">How to Choose Mobile Devices</a><br>you wish to display your app on.</li>
		<li><a href="http://support.weeverapps.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#icons" target="_blank">Editing App-Navigation Icons</a><br>aka, 'tab bar icons' to change the image and text-label</li>
		</ul>
		<ul class="supportlistarrow segmentedlist">
		<li><a href="http://support.weeverapps.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps#staging" target="_blank">Staging Mode</a><br>- a separate 'sandbox' for your app!</li>
		<li><a href="http://support.weeverapps.com/entries/20531627-new-support-tutorial-videos-now-available-for-weever-apps" target="_blank">View all videos</a></li>
		</ul>	
		
		
		
		
		
		</div>
		        
		        
	</fieldset>
	<fieldset class='adminForm'>
	
    	<legend><?php echo JText::_('WEEVER_APPS_NEWS'); ?></legend>
    	
    	<div style="margin:0 1em 1em 1.25em;">

		
		
		<p>We add new features all the time!<br/><br/>&bull; <a href="http://weeverapps.com/mobile/tour" target="_blank">Latest Features</a><br/>&bull; <a href="http://weeverapps.com/pricing">Plans & Pricing</a></p>
		
		
		
		
		
		
		
		<ul class="supportliststar segmentedlist"><strong>Connect with us!</strong>
		<li>Follow <a href="http://twitter.com/weeverapps">@WeeverApps</a> on Twitter</li>
		<li>Like us on <a href="http://www.facebook.com/pages/Weever-Apps/116527295103220">Facebook</a></li>
		<li><a href="http://weeverapps.com/blog">Read our blog</a> on Joomla!, Wordpress and Mobile</li>
		</ul>	
		
		
		
		
		
		</div>
        
	</fieldset>
    
    
    	<fieldset class='adminForm'>
    	<legend><?php echo JText::_('WEEVER_FAQ'); ?></legend>
    	
    	 <div style="margin:0 1em 1em 1.25em;">


		
		<p>For more quesitons and answers, please visit our <a href="http://support.weeverapps.com">support site</a>.</p>
		<br/>
		
		
		<ul class="supportlistarrow"><a href="http://weeverapps.com/pricing">Premium &amp; Pro</a> Features
		<li>How do I make a <strong><a href="http://support.weeverapps.com/entries/20611136-how-do-i-make-a-weever-map">Weever Map?</a></strong></li>
		<li>How do I setup a <a href="http://support.weeverapps.com/entries/20394158-how-do-i-use-my-own-domain-name-web-site-address-url-with-weever-apps">app.yoursitename.com address</a> for my app?</li>
		<li>Can I change the 'Powered by' message on launch?<br/>Yes, just go to 'Mobile Publishing' in the plugin settings.  You'll need a "Reseller Account" to rebrand the 'powered by' message.  View <a href="http://weeverapps.com/reseller" target="_blank">our reseller page</a> or <a href="http://weeverapps.com/pricing" target="_blank">reseller pricing</a> for more info.</li>
		</ul>	
		<br/>
		
		
		<ul class="supportlistarrow">Marketing &amp; Sales
		<li>Do Weever Apps Install?<br/>Yes! You can also 'Prompt to install' when a visitor loads the app for the first time.</li>
		<li>Can I setup a 'landing page' in my app?<br/>Yes! The latest Weever Apps releases include the options to use a single landing page, or to select content from your site for a 'landing page app slideshow'</li>
		<li>How much data do you store on your servers?<br/><a href="http://support.weeverapps.com/entries/20315147-where-does-the-code-stays">Almost none</a>. Your privacy and security is important to us.</li>
		</ul>
		<br/>
		<ul class="supportlistarrow">Technical / Advanced
		<li>Can I style the app with CSS? - <em>Sure!</em><br/>Just go to 'logo, images and theme' and select 'Custom CSS and HTML'.</li>
		</ul>
		
		
		
		
		
		</div>
        
</fieldset>
    
    
    
</div>
</div>
