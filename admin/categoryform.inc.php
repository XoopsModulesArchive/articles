<?php
// $Id: categoryform.inc.php,v 1.9 2006/05/12 14:56:02 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                               //
//	About:  This file is part of the Articles module for Xoops v2.           //
//                                                                           //
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //


//
//----------------------------------------------------------------------------//
// Preview bit
if (isset($_REQUEST['but_preview'])) {

	if (isset($_REQUEST['formdata'])) { $formdata = $_REQUEST['formdata']; }
		else { $formdata = ""; }
		
		//echo "<pre>";
		//var_dump($formdata);
		//echo "</pre>";
		
		$cat_name			= $myts->htmlSpecialChars($myts->stripSlashesGPC($formdata['cat_name']));
		$cat_weight			= $formdata['cat_weight'];
		$cat_showme			= $formdata['cat_showme'];
		$cat_description	= $myts->htmlSpecialChars($myts->stripSlashesGPC($formdata['cat_description']));

		if (isset($formdata['cat_id'])) { $cat_id = $formdata['cat_id']; }
    		else { $cat_id = NULL; }
		
		if (isset($formdata['cat_showme']) AND $formdata['cat_showme'] == "1") {
			$cat_showme = "1";
		} else {
			$cat_showme = "0";
		}
		
		if (isset($formdata['cat_nohtml'])) { $cat_nohtml = "0"; }
			else { $cat_nohtml = "1"; }
		if (isset($formdata['cat_nosmiley'])) { $cat_nosmiley = "0"; }
			else { $cat_nosmiley = "1"; }
		if (isset($formdata['cat_noxcode'])) { $cat_noxcode = "0"; }
			else { $cat_noxcode = "1"; }
		if (isset($formdata['cat_noimage'])) { $cat_noimage = "0"; }
			else { $cat_noimage = "1"; }
		if (isset($formdata['cat_nobr'])) { $cat_nobr = "0"; }
			else { $cat_nobr = "1"; }
	
?>	
<br />
<table cellpadding="1" cellspacing="1" class="outer" style="width: 100%;">
  <tr>
    <th colspan="2"><?php echo _AM_ART_FRMTTLPRVWCAT; ?></th>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_FRMCAPSDTTL; ?></td>
    <td><?php echo $myts->displayTarea($cat_name); ?></td>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_FRMCAPSDCATDSC; ?></td>
    <td><?php echo $myts->displayTarea($cat_description, $cat_nohtml, $cat_nosmiley, $cat_noxcode, $cat_noimage, $cat_nobr); ?></td>
  </tr>
</table>
	
<?php	
}

//
//----------------------------------------------------------------------------//
// set up some vars, and to prevent warning messages

// set a default of zero for category order.
if (!isset($cat_weight)) { $cat_weight = 0; } 
if (!isset($cat_name)) { $cat_name = ""; }
if (!isset($cat_description)) { $cat_description = ""; }

//if (!isset($cat_id)) { $cat_id = ""; } 

//
//----------------------------------------------------------------------------//
// Form stuff
?>
<script type="text/javascript" language="JavaScript">
<!-- //begin/hide

function checkfields() {

	if(document.getElementById("formdata[cat_name]").value.length < 1) {
      alert("<?php echo _AM_ART_JVSRPTADDTTL; ?>");
      return false; // 
   }

	return true;
   
} // end function

//-->
</script>

<?php
// add space above form
echo "<br />";

$catform = new XoopsThemeForm($formtitle, "categoryform", xoops_getenv('PHP_SELF'), 'post');

//
// Title
//
$cat_name = new XoopsFormText(_AM_ART_FRMCAPSDTTL, 'formdata[cat_name]', 40, 255, $cat_name);
$catform->addElement($cat_name);
unset($cat_name);

//
// Order/weight
//
$cat_weight = new XoopsFormText(_AM_ART_FRMCAPSDORDR, 'formdata[cat_weight]', 4, 4, $cat_weight);
$catform->addElement($cat_weight);
unset($cat_weight);


//
// Show/display
//
if (isset($cat_showme) AND $cat_showme == "0") { $cat_showme_checked = "0"; }
else { $cat_showme_checked = "1"; } 

$cat_showme = new XoopsFormCheckBox(_AM_ART_FRMCAPSDDSPLY, 'formdata[cat_showme]', $cat_showme_checked); // checked value here whether will be checked?
$cat_showme->addOption(1, _AM_ART_FRMCAPSLCTCATSHW); // checked value here what will be sent in form?
$catform->addElement($cat_showme);
unset($cat_showme);

//
// Category description
//_AM_FORMCAPTIODESCR
$editordesc = articles_getwysiwygform(_AM_ART_FRMCAPSDCATDSC, 'formdata[cat_description]', $cat_description, "100%", "250px", '15');

/*
$default_ed1 = new XoopsFormDhtmlTextArea(_AM_ART_FRMCAPSDCATDSC, 'formdata[cat_description]', $cat_description, '10', '40');

// Loads XOOPS' default editor
if ($xoopsModuleConfig['articleeditadmin'] == "0") {
	$editordesc = $default_ed1;
} // default
// Spaw
if ($xoopsModuleConfig['articleeditadmin'] == "1") {
	if (is_readable(XOOPS_ROOT_PATH . $xoopsModuleConfig['edspawpath'] . "/formspaw.php")) {
		include_once XOOPS_ROOT_PATH .  $xoopsModuleConfig['edspawpath'] . "/formspaw.php";
		$editordesc = new XoopsFormSpaw(_AM_ART_FRMCAPSDCATDSC, 'formdata[cat_description]', $cat_description, '100%', '150px');
	} else {
		$editordesc = $default_ed1;
	}
} // spaw
// fsk
if ($xoopsModuleConfig['articleeditadmin'] == "2") {
	if (is_readable(XOOPS_ROOT_PATH . $xoopsModuleConfig['edfckpath'] . "/formfckeditor.php")) {
		include_once(XOOPS_ROOT_PATH . $xoopsModuleConfig['edfckpath'] . "/formfckeditor.php");
		$editordesc = new XoopsFormFckeditor(_AM_ART_FRMCAPSDCATDSC, 'formdata[cat_description]', $cat_description, '100%', '250px');
	} else {
		$editordesc = $default_ed1;
	}
} // fck
// htmlarea
if ($xoopsModuleConfig['articleeditadmin'] == "3") {
	if (is_readable(XOOPS_ROOT_PATH . $xoopsModuleConfig['edhtmlpath'] . "/formhtmlarea.php")) {
		include_once(XOOPS_ROOT_PATH . $xoopsModuleConfig['edhtmlpath'] . "/formhtmlarea.php");
		$editordesc = new XoopsFormHtmlarea(_AM_ART_FRMCAPSDCATDSC, 'formdata[cat_description]', $cat_description, '100%', '250px');
	} else {
		$editordesc = $default_ed1;
	}
}// htmlarea
*/
$catform->addElement($editordesc);
unset($editordesc);
unset($default_ed1);

//
// Display options
//
//
// disable html
//
if (isset($cat_nohtml) AND $cat_nohtml == "0") { $nohtml_checked = "0"; }
else { $nohtml_checked = "1"; } 
$nohtmlbox = new XoopsFormCheckBox("", 'formdata[cat_nohtml]', $nohtml_checked); // checked value here whether will be checked?
$nohtmlbox->addOption(0, _AM_ART_FRMCAPSLCTNOHTML); // checked value here what will be sent in form?

//
// disable auto line breaks
//
if (isset($cat_nobr) AND $cat_nobr == "0") { $nobr_checked = "0"; }
else { $nobr_checked = "1"; }
$nobrbox = new XoopsFormCheckBox("", 'formdata[cat_nobr]', $nobr_checked); // checked value here whether will be checked?
$nobrbox->addOption(0, _AM_ART_FRMCAPSLCTNOBR); // checked value here what will be sent in form?

//
// disable smileys
//
if (isset($cat_nosmiley) AND $cat_nosmiley == "0") { $nosmiley_checked = "0"; }
else { $nosmiley_checked = "1";}
$smileybox = new XoopsFormCheckBox("", 'formdata[cat_nosmiley]', $nosmiley_checked); // checked value here whether will be checked?
$smileybox->addOption(0, _AM_ART_FRMCAPSLCTNOSMLY); // checked value here what will be sent in form?

//
// disable xoops codes
//
if (isset($cat_noxcode) AND $cat_noxcode == "0") { $noxcode_checked = "0"; }
else { $noxcode_checked = "1"; }
$xcodebox = new XoopsFormCheckBox("", 'formdata[cat_noxcode]', $noxcode_checked); // checked value here whether will be checked?
$xcodebox->addOption(0, _AM_ART_FRMCAPSLCTNOXCDE); // checked value here what will be sent in form?

//
// disable xoops images
//
if (isset($cat_noimage) AND $cat_noimage == "0") { $noimage_checked = "0"; }
else { $noimage_checked = "1"; }
$imgcodebox = new XoopsFormCheckBox("", 'formdata[cat_noimage]', $noimage_checked); // checked value here whether will be checked?
$imgcodebox->addOption(0, _AM_ART_FRMCAPSLCTNOXIMG); // checked value here what will be sent in form?


$optionstray = new XoopsFormElementTray('','<br />');
$optionstray->addElement($nohtmlbox);
$optionstray->addElement($nobrbox);
$optionstray->addElement($smileybox);
$optionstray->addElement($xcodebox);
$optionstray->addElement($imgcodebox);
$catform->addElement($optionstray);
unset($nohtmlbox);
unset($smileybox);
unset($xcodebox);
unset($imgcodebox);
unset($nobrbox);


//
// Hidden fields
//
//if ($formaction == "add") {
//	$catform->addElement(new XoopsFormHidden('op', 'add'));
//}
if ($formaction == "edit") {
	$catform->addElement(new XoopsFormHidden('subop', 'saveeditconfirm'));
	$catform->addElement(new XoopsFormHidden('op', 'edit'));
	$catform->addElement(new XoopsFormHidden('formdata[cat_id]', $cat_id));
} else {
	$catform->addElement(new XoopsFormHidden('op', '1'));
}

//
// Buttons
//
$button_sub = new XoopsFormButton('', 'but_save', _AM_ART_FRMBTTNSAVE, 'submit');
$button_sub->setExtra('onclick="return checkfields();"');
$button_can = new XoopsFormButton('', 'but_reset', _AM_ART_FRMBTTNRST, 'reset');
$button_pre = new XoopsFormButton('', 'but_preview', _AM_ART_FRMBTTNPRVW, 'submit');
$button_pre->setExtra('onclick="return checkfields();"');

$tray = new XoopsFormElementTray('');
$tray->addElement($button_sub);
$tray->addElement($button_can);
$tray->addElement($button_pre);
$catform->addElement($tray);

// Display form
$catform->display();











/*
echo "
  <tr>
    <td class=\"head\">" . _AM_FORMCAPTIONTITLE . "</td>
    <td class=\"even\"><input type=\"text\" name=\"formdata[cat_name]\" value=\"" . $cat_name . "\" size=\"30\" maxlength=\"50\"></td>
  </tr>
  <tr>
    <td class=\"head\">" . _AM_FORMCAPTIOORDER . "</td>
    <td class=\"even\"><input type=\"text\" name=\"formdata[cat_weight]\" value=\"" . $cat_weight . "\" size=\"2\" maxlength=\"5\"></td>
  </tr>
  <tr>
    <td class=\"head\">" . _AM_FORMCAPTIODISPLAY . "</td>
    <td class=\"even\"><input type=\"checkbox\" name=\"formdata[cat_showme]\" value=\"1\"" . $cat_showme_checked . "></td>
  </tr>
  <tr>
    <td valign=\"top\" class=\"head\">" . _AM_FORMCAPTIODESCR . "</td>
    <td class=\"even\">
      <!-- <textarea name=\"data[cat_description]\" rows=\"10\" cols=\"30\"></textarea> -->
";
// call form text area function
xoopsCodeTarea("cat_description", 60, 10);
// call smilies function.
xoopsSmilies("cat_description");    
echo "    
    </td>
  </tr>
  <tr>
    <td class=\"head\">&nbsp;</td>
    <td class=\"even\">
      <input type=\"hidden\" name=\"op\" value=\"" . $op . "\">
      <input type=\"hidden\" name=\"subop\" value=\"add\">
      <input type=\"hidden\" name=\"formdata[cat_id]\" value=\"" . $cat_id . "\">
      <input type=\"submit\" value=\"" . _AM_FORMBUTTONSUB . "\"> 
      <input type=\"reset\" value=\"" . _AM_FORMBUTTONRES . "\">
    </td>
  </tr>
</table>
</form> 
";
*/
?>