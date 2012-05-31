<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
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

	echo '
    <fieldset class="adminForm" style="margin:1.5em;">
    <legend>'.JText::_('WEEVER_QR_TEST_CODE').'</legend>

        <a href="'.$googleQRUrlHD.$privateUrl.'" class="popup" rel=\'{handler: "iframe", size: {x: 480, y: 480} }\'><img src="'.$googleQRUrl.$privateUrl.'"  class="wx-qr-imgprev" /></a>
        <p>'.JText::_('WEEVER_QR_SCAN_PRIVATE').'<br/>
        QR Link: '.JText::_('WEEVER_QR_DIRECT_ADDRESS').'<a href="'.$privateUrl.'">'.$privateUrl.'</a></p>
        <p>'.JText::_('WEEVER_QR_ADDITIONAL_TEST').'</p>
    
	</fieldset>
   
	';
	
	if(!$staging)
		echo '<fieldset class="adminForm" style="margin:1.5em;">
        			<legend style="background:#ECF4E6;">'.JText::_('WEEVER_QR_PUBLIC_CODE').'</legend>

                <a href="'.$googleQRUrlHD.$publicUrl.'" class="popup" rel=\'{handler: "iframe", size: {x: 480, y: 480} }\'><img src="'.$googleQRUrl.$publicUrl.'"  class= "wx-qr-imgprev"  /></a>

              <p>'.JText::_('WEEVER_QR_PUBLIC_CODE_SHARE').' <a href="'.$publicUrl.'">'.$publicUrl.'</a></p>
<p>'.JText::_('WEEVER_QR_PUBLIC_CODE_SHARE_SUGGEST').'</p>
             </fieldset>';
	else
		echo '<fieldset class="adminForm"  style="margin:1.5em;">
        			<legend style="background:#ECF4E6;">'.JText::_('WEEVER_QR_PUBLIC_CODE').'</legend>
<p>'.JText::_('WEEVER_QR_STAGING_UNAVAILABLE').'</p>
    </fieldset>
	
	';
	
	echo '<div style="clear:both;"></div></div>';