/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	1.1
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


function populateCMS(f)
{
	f.name.value=f.cms_feed[f.cms_feed.	selectedIndex].text;
}

function populateComponentID(f)
{
	f.name.value=f.component_id[f.component_id.selectedIndex].text;
}

function strpos (haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}

/**
* Toggles the check state of a group of boxes
*
* Checkboxes must have an id attribute in the form cb0, cb1...
* @param The number of box to 'check'
* @param An alternative field name
*/
function checkAllTab( n, fldName, boxchecked, toggle, start ) {
  if (!fldName) {
     fldName = 'cb';
  }

	var max = n + start;
	var c = toggle.checked;
	var n2 = 0;
	for (i=start; i < max; i++) {
		cb = eval( 'document.getElementById("' + fldName + '' + i + '")');
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		boxchecked.value = n2;
	} else {
		boxchecked.value = 0;
	}
}

function listItemTask( id, task ) {

    var f = document.getElementById("adminForm");
    cb = eval( 'document.getElementById("' + id + '")');
    if (cb) {
        for (i = 0; true; i++) {
            cbx = eval('document.getElementById("'+i+'")');
            if (!cbx) break;
            cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        submitbutton(task);
    }
    return false;
}
