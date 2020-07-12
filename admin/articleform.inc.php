<?php
// $Id: articleform.inc.php,v 1.16 2006/01/20 21:19:10 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                         //
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
// Preview new article/changes
//
if (isset($_REQUEST['but_preview'])) {
	//echo "PREVIEW THINGY";
	
		if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
			else { $formdata = ""; }
		
		echo "<br />";
		
		// Set up vars so data appears in form fields below.
		$art_title			= $myts->htmlSpecialChars($myts->stripSlashesGPC($formdata['art_title']));
    	$art_cat_id			= $formdata['art_cat_id'];
    	$art_weight			= $formdata['art_weight'];
    	$art_description	= $myts->htmlSpecialChars($myts->stripSlashesGPC($formdata['art_description']));
    	$art_article_text	= $myts->htmlSpecialChars($myts->stripSlashesGPC($formdata['art_article_text']));
    	
    	if (isset($formdata['art_id'])) { $art_id = $formdata['art_id']; }
    		else { $art_id = NULL; }
    	
    	if (isset($formdata['art_showme'])) { $art_showme = "1"; }
    			else { $art_showme = "0"; }
    	
		if (isset($formdata['art_nohtml'])) { $art_nohtml = "0"; }
			else { $art_nohtml = "1"; }
		if (isset($formdata['art_nosmiley'])) { $art_nosmiley = "0"; }
			else { $art_nosmiley = "1"; }
		if (isset($formdata['art_noxcode'])) { $art_noxcode = "0"; }
			else { $art_noxcode = "1"; }
		if (isset($formdata['art_noimage'])) { $art_noimage = "0"; }
			else { $art_noimage = "1"; }
		if (isset($formdata['art_nobr'])) { $art_nobr = "0"; }
			else { $art_nobr = "1"; }
 	
?>
<a href="#form"><?php echo _AM_ART_FRMCAPLNKGTFRM; ?></a>
<table cellpadding="0" cellspacing="1" style="width: 100%" class="outer">
  <tr>
    <th colspan="2"><?php echo _AM_ART_FRMTTLPRVWART; ?></th>
  </tr>
  <tr>
    <td class="head" style="vertical-align: top; width: 100px;"><?php echo _AM_ART_FRMCAPSDTTL; ?></td>
    <td>
    <?php echo $myts->htmlSpecialChars($myts->stripSlashesGPC($formdata['art_title'])); 
    //$ts->previewTarea($text, $html, $smiley, $xcode); ?>
    </td>
  </tr>
  <tr>
    <td class="head" style="vertical-align: top; width: 100px;"><?php echo _AM_ART_FRMCAPSDDSCRN; ?></td>
    <td>
    <?php echo $myts->previewTarea($formdata['art_description'], $art_nohtml, $art_nosmiley, $art_noxcode, $art_noimage, $art_nobr); ?>
    </td>
  </tr>
  <tr>
    <td class="head" style="vertical-align: top; width: 100px;"><?php echo _AM_ART_FRMCAPSDARTCL; ?></td>
    <td>
    <?php echo $myts->previewTarea($formdata['art_article_text'], $art_nohtml, $art_nosmiley, $art_noxcode, $art_noimage, $art_nobr); ?>
    </td>
  </tr>
</table>		
<?php
	
}
// end preview

//
//----------------------------------------------------------------------------// 
// Take care of some error messages
if(!isset($art_title)) { $art_title = ""; }
if(!isset($art_cat_id)) { $art_cat_id = ""; }
if(!isset($art_description)) { $art_description = ""; }
if(!isset($art_article_text)) { $art_article_text = ""; }
if(!isset($id)) { $id = ""; }
if(!isset($art_author_id)) { $art_author_id = ""; }
if(!isset($art_author_ip)) { $art_author_ip = ""; }
if(!isset($art_posted_datetime)) { $art_posted_datetime = ""; }
if(!isset($art_validated)) { $art_validated = ""; }
if(!isset($art_views)) { $art_views = ""; }

if(isset($art_author_id)) { $art_author_id = !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0; }

// Display 0 or weight of article if editing
if (!isset($art_weight)) { $art_weight = "0"; }


// create space above form
echo "<br />";

// Spit out an error message if there are no categories
if (!cat_check()) {
	echo "<p style=\"color: red; font-weight: bold;\">". _AM_ART_ERRORNOCATS ."</p>";
}

?>

<script type="text/javascript" language="JavaScript">
<!-- //begin/hide

function checkfields() {

	if(document.getElementById("formdata[art_title]").value.length < 1) {
      alert("<?php echo _AM_ART_JVSRPTADDTTL; ?>");
      return false; // 
   }

   if(document.getElementById("formdata[art_cat_id]").value == 0) {
      alert("<?php echo _AM_ART_JVSRPTSLTCAT; ?>");
      return false; // 
   }
   
	return true;
   
} // end function

//-->
</script>
<a name="form"></a>
<?php
//
// start new form
// See for ref -  http://dev.xoops.org/modules/phpwiki/index.php/XoopsFormLibrary
//

$articleform = new XoopsThemeForm($formtitle, "articlesform", xoops_getenv('PHP_SELF'), 'post');
//$articleform->setExtra('onsubmit="return checkfields();"');

//include_once XOOPS_ROOT_PATH . "/class/spaw/formspaw.php";

//
// Title
//
//$title = XoopsFormText( string $caption, string $name, int $size, int $maxlength, string $value = "" );
$title = new XoopsFormText(_AM_ART_FRMCAPSDTTL, 'formdata[art_title]', 40, 255, $art_title);
$articleform->addElement($title);
unset($title);

//
// Category
// new XoopsFormSelect($caption, $name, $value=null, $size=1, $multiple=false)
// addOption($value, $name="")
$catselect = new XoopsFormSelect(_AM_ART_FRMCAPSDCTGRY, 'formdata[art_cat_id]', $art_cat_id, '1', false);
$catselect->addOption('0', _AM_ART_FRMCAPSLCT);
	$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_cat") . " ORDER BY cat_name ASC");
	$result=$xoopsDB->query($sql);
	while($myrow = $xoopsDB->fetchArray($result)) {
		$cat_id    = $myrow['id'];
		$cat_name  = $myrow['cat_name'];
		
		$catselect->addOption($cat_id, $cat_name);	
	} 
$articleform->addElement($catselect);

//
// Article weight/sort order
//
$art_weight = new XoopsFormText(_AM_ART_FRMCAPSDORDR, 'formdata[art_weight]', 4, 4, $art_weight);
$articleform->addElement($art_weight);
unset($art_weight);

//
// Display (checkbox)
// See - http://dev.xoops.org/modules/phpwiki/index.php/XoopsFormCheckBox
// $checkbox1 = new XoopsFormCheckBox(str "form caption", str "form name", int checked);

//if (isset($art_showme) AND $art_showme == "0") { $art_showme_checked = "0"; }
//else { $art_showme_checked = "1"; } 

if (isset($art_showme) AND $art_showme == "0") { $art_showme_checked = "0"; }
else { $art_showme_checked = "1"; } 


$displayedbox = new XoopsFormCheckBox(_AM_ART_FRMCAPSDDSPLY, 'formdata[art_showme]', $art_showme_checked); // checked value here whether will be checked?
$displayedbox->addOption(1, _AM_ART_FRMCAPSLCTSHW); // checked value here what will be sent in form?
$articleform->addElement($displayedbox);
unset($displayedbox);

//
// Description/brief (Text area editor)
// This will either be default xoops, spaw, or whatever
// Various editors now handled in function

	$editordesc = articles_getwysiwygform(_AM_ART_FRMCAPSDDSCRN, 'formdata[art_description]', $art_description, "100%", "250px", '15');
	$editormain = articles_getwysiwygform(_AM_ART_FRMCAPSDARTCL, 'formdata[art_article_text]', $art_article_text, '100%', '450px', '25');	


//$editordesc = new XoopsFormDhtmlTextArea(_AM_FORMCAPTIODESCR, 'art_description', $art_description, "100%", '200px');
//new XoopsSimpleForm('Title of form', 'formname', 'targetpage.php', 'POST');
$articleform->addElement($editordesc);
$articleform->addElement($editormain);
unset($editordesc);
unset($editormain);
unset($default_ed1);
unset($default_ed2);

// 
// Add info on [pagebreak]
$articleform->addElement(new XoopsFormLabel('', _AM_ART_FRMCAPPGBRK));


//
// disable html
//
if (isset($art_nohtml) AND $art_nohtml == "0") { $nohtml_checked = "0"; }
else { $nohtml_checked = "1"; } 
$nohtmlbox = new XoopsFormCheckBox("", 'formdata[art_nohtml]', $nohtml_checked); // checked value here whether will be checked?
$nohtmlbox->addOption(0, _AM_ART_FRMCAPSLCTNOHTML); // checked value here what will be sent in form?

//
// disable auto line breaks
//
if (isset($art_nobr) AND $art_nobr == "0") { $nobr_checked = "0"; }
else { $nobr_checked = "1"; }
$nobrbox = new XoopsFormCheckBox("", 'formdata[art_nobr]', $nobr_checked); // checked value here whether will be checked?
$nobrbox->addOption(0, _AM_ART_FRMCAPSLCTNOBR); // checked value here what will be sent in form?

//
// disable smileys
//
if (isset($art_nosmiley) AND $art_nosmiley == "0") { $nosmiley_checked = "0"; }
else { $nosmiley_checked = "1";}
$smileybox = new XoopsFormCheckBox("", 'formdata[art_nosmiley]', $nosmiley_checked); // checked value here whether will be checked?
$smileybox->addOption(0, _AM_ART_FRMCAPSLCTNOSMLY); // checked value here what will be sent in form?

//
// disable xoops codes
//
if (isset($art_noxcode) AND $art_noxcode == "0") { $noxcode_checked = "0"; }
else { $noxcode_checked = "1"; }
$xcodebox = new XoopsFormCheckBox("", 'formdata[art_noxcode]', $noxcode_checked); // checked value here whether will be checked?
$xcodebox->addOption(0, _AM_ART_FRMCAPSLCTNOXCDE); // checked value here what will be sent in form?

//
// disable xoops images
//
if (isset($art_noimage) AND $art_noimage == "0") { $noimage_checked = "0"; }
else { $noimage_checked = "1"; }
$imgcodebox = new XoopsFormCheckBox("", 'formdata[art_noimage]', $noimage_checked); // checked value here whether will be checked?
$imgcodebox->addOption(0, _AM_ART_FRMCAPSLCTNOXIMG); // checked value here what will be sent in form?


$optionstray = new XoopsFormElementTray('','<br />');
$optionstray->addElement($nohtmlbox);
$optionstray->addElement($nobrbox);
$optionstray->addElement($smileybox);
$optionstray->addElement($xcodebox);
$optionstray->addElement($imgcodebox);
$articleform->addElement($optionstray);
unset($nohtmlbox);
unset($smileybox);
unset($xcodebox);
unset($imgcodebox);
unset($nobrbox);

//
// Submit
//
// new XoopsFormButton('Button Caption', 'button_id', 'Button-Text', 'submit'));
$button_sub = new XoopsFormButton('', 'but_save', _AM_ART_FRMBTTNSAVE, 'submit');
$button_sub->setExtra('onclick="return checkfields();"');
$button_can = new XoopsFormButton('', 'but_reset', _AM_ART_FRMBTTNRST, 'reset');
$button_pre = new XoopsFormButton('', 'but_preview', _AM_ART_FRMBTTNPRVW, 'submit');
$button_pre->setExtra('onclick="return checkfields();"');
//$button_pre->setExtra("preview='1'");

// Hidden control fields
//$articleform->addElement(new XoopsFormHidden($name, $value));
if ($formaction == "edit") {
	$articleform->addElement(new XoopsFormHidden('subop', 'saveeditconfirm'));
	$articleform->addElement(new XoopsFormHidden('op', 'edit'));
	$articleform->addElement(new XoopsFormHidden('formdata[art_id]', $art_id));
} else {
	$articleform->addElement(new XoopsFormHidden('op', '1'));
}

$tray = new XoopsFormElementTray('');
$tray->addElement($button_sub);
$tray->addElement($button_can);
$tray->addElement($button_pre);
$articleform->addElement($tray);
$articleform->display();



?>