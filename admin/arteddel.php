<?php
// $Id: arteddel.php,v 1.7 2007/03/27 21:35:34 andrew Exp $
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

include_once ('../../../include/cp_header.php');
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include "../language/".$xoopsConfig['language']."/main.php";
} else {
	include "../language/english/main.php";
}
include_once ("../include/functions.inc.php");
include_once (XOOPS_ROOT_PATH . "/include/xoopscodes.php");
include_once (XOOPS_ROOT_PATH . "/class/module.errorhandler.php");
include_once (XOOPS_ROOT_PATH . "/class/xoopsformloader.php");
$myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object

//
//----------------------------------------------------------------------------//
// Default thing
if (!isset($_REQUEST['op'])) {
xoops_cp_header();
admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVBCINDEX ."</a> &raquo; ". _AM_ART_NAVBCARTEDDE ."");

// order colums ("o" = order)
if(empty($_GET['o'])) { 
	$orderby = "ASC"; 
	$colorder = "d";
}
if(isset($_GET['o']) && $_GET['o'] == "a") { 
	$orderby = "ASC"; 
	$colorder = "d";
}
if(isset($_GET['o']) && $_GET['o'] == "d") { 
	$orderby = "DESC"; 
	$colorder = "a";
}

// "s" = sort by which column
if(!isset($_GET['s'])) { $sqlorder = "art_cat_id, art_weight"; } // default
if(isset($_GET['s']) && $_GET['s'] == "id")		{ $sqlorder = "id"; } // order by ID
if(isset($_GET['s']) && $_GET['s'] == "title")	{ $sqlorder = "art_title"; } // order by title
if(isset($_GET['s']) && $_GET['s'] == "cat")	{ $sqlorder = "art_cat_id"; } // order by category
if(isset($_GET['s']) && $_GET['s'] == "desc")	{ $sqlorder = "art_description"; } // order by description
if(isset($_GET['s']) && $_GET['s'] == "order")	{ $sqlorder = "art_weight"; } // order by weight

?>
<br />
<table border="0" cellpadding="0" cellspacing="1" class="outer" style="width: 100%;">
  <tr>
    <th colspan="7"><?php echo _AM_ART_LISTTITLE; ?></th>
  </tr>
  <tr>
    <td class="head" style="width: 30px; text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?s=id&amp;o=<?php echo $colorder; ?>"><?php echo _AM_ART_FRMCAPHDRID; ?></a></td>
    <td class="head" style="text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?s=title&amp;o=<?php echo $colorder; ?>"><?php echo _AM_ART_FRMCAPHDRTTL; ?></a></td>
    <td class="head" style="text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?s=cat&amp;o=<?php echo $colorder; ?>"><?php echo _AM_ART_FRMCAPHDCATLNG; ?></a></td>
    <td class="head" style="width: 35px; text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?s=order&amp;o=<?php echo $colorder; ?>"><?php echo _AM_ART_FRMCAPHDRORDR; ?></a></td>
    <td class="head" style="width: 18px; text-align: center;"></td>
    <td class="head" style="width: 20px; text-align: center;"></td>
    <td class="head" style="width: 20px; text-align: center;"></td>
  </tr>

<?php

	$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_main") . " WHERE art_validated=1 ORDER BY $sqlorder $orderby");
	//$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_main") . " "); // ORDER BY $sqlorder $orderby");
	$result=$xoopsDB->query($sql);
	
	if ($xoopsDB->getRowsNum($result) > 0) {
		$rowclass = "even"; // set default call to use for rows
		while($myrow = $xoopsDB->fetchArray($result)) {
			$id 					= $myrow['id'];
			$art_title				= $myts->htmlSpecialChars($myts->stripSlashesGPC($myrow['art_title']));
			$art_cat_id				= $myrow['art_cat_id'];
			$art_weight				= $myrow['art_weight'];
			
			if ($rowclass == "even") { $rowclass = "odd"; } else { $rowclass = "even"; }
			
			// stuff
?>

  <tr>
    <td class="<?php echo $rowclass; ?>" style="width: 30px; text-align: center;"><?php echo $id; ?></td>
    <td class="<?php echo $rowclass; ?>"><a href="javascript:;" onclick="javascript:window.open('<?php echo $_SERVER['PHP_SELF']; ?>?op=preview&amp;id=<?php echo $id; ?>', 'preview', 'height=500,width=650,status=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');" title="<?php echo _AM_ART_FRMCAPLNKPRVW; ?>"><?php echo $art_title; ?></a></td>
    <td class="<?php echo $rowclass; ?>"><?php echo  match_cats($art_cat_id); ?></td>
    <td class="<?php echo $rowclass; ?>" style="width: 35px; text-align: center;"><?php echo $art_weight; ?></td>
    <td class="<?php echo $rowclass; ?>" style="width: 18px; text-align: center;"><?php echo pub_status($id, "art"); ?></td>
    <td class="<?php echo $rowclass; ?>" style="width: 20px; text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=edit&amp;art_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKEDT; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/edit3.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKEDT; ?>"></a></td>
    <td class="<?php echo $rowclass; ?>" style="width: 20px; text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=delete&amp;art_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKDLT; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/del3.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKDLT; ?>"></a></td>
  </tr>

<?php
		} // while
	} else {
		echo "<td colspan=\"7\" class=\"odd\" style=\"text-align: center;\">" . _AM_ART_FRMCAPNOCATS . "</td>";
	}


?>  
</table>

<?php

admin_artfoot_text();
xoops_cp_footer();	
} //

//
//---------------------------------------------------------------------------//
// Preview
if (isset($_REQUEST['op']) && $_REQUEST['op'] == "preview") {
	
	if (isset($_GET['id'])) { $art_id = $_GET['id']; }
		else { $art_id = "0"; }
	
	$result = $xoopsDB->query("SELECT art_title, art_description, art_article_text, art_nohtml, art_nosmiley, art_noxcode, art_noimage, art_nobr FROM " .$xoopsDB->prefix('articles_main') . " WHERE id=".intval($art_id)." LIMIT 1");
	list($art_title, $art_description, $art_article_text, $art_nohtml, $art_nosmiley, $art_noxcode, $art_noimage, $art_nobr) = $xoopsDB->fetchRow($result);
	
?>	
<!DOCTYPE html PUBLIC '//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html>
<head>

<link rel="stylesheet" type="text/css" media="all" href="http://xoops/xoops.css" />
<link rel="stylesheet" type="text/css" media="all" href="http://xoops/modules/system/style.css" />
</head>
<body>
<div style="text-align: center;"><input type="button" value="<?php echo _AM_ART_FRMBTTNCLS; ?>" onclick="window.close();" /></div>
  <table cellpadding="0" cellspacing="1" class="outer" style="width: 90%;" align="center">
    <tr>
	  <th colspan="2"><?php echo $art_title; ?></th>
	</tr>
	
    <tr>
	  <td class="head" style="vertical-align: top; width: 100px;"><?php echo _AM_ART_FRMCAPSDDSCRN; ?></td>
	  <td><?php echo $myts->previewTarea($art_description, $art_nohtml, $art_nosmiley, $art_noxcode, $art_noimage, $art_nobr); ?></td>
    </tr>
	<tr>
	  <td class="head" style="width: 100px; height: 8px;"></td>
	  <td></td>
	</tr>
	<tr>
	  <td class="head" style="vertical-align: top; width: 100px;"><?php echo _AM_ART_FRMCAPSDARTCL; ?></td>
	  <td><?php echo $myts->previewTarea($art_article_text, $art_nohtml, $art_nosmiley, $art_noxcode, $art_noimage, $art_nobr); ?></td>
    </tr>
  </table>
<div style="text-align: center;"><input type="button" value="<?php echo _AM_ART_FRMBTTNCLS; ?>" onclick="window.close();" /></div>
  
</body>
</html>  
<?php	

} //

//
//---------------------------------------------------------------------------//
// Edit
if (isset($_REQUEST['op']) && $_REQUEST['op'] == "edit") {

	if (!isset($_REQUEST['but_save'])) {
		xoops_cp_header();
		admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVBCINDEX ."</a> &raquo; ". _AM_ART_NAVARTEDT ."");
		
		//
		// We don't want to collect data from the DB if we want the preview.
		//
		if (!isset($_POST['formdata'])) {
			if (isset($_GET['art_id'])) { $art_id = $_GET['art_id']; }
				else { $art_id = "0"; }
	
				$result = $xoopsDB->query("SELECT id, art_author_id, art_author_ip, art_cat_id, art_title, art_description, art_article_text, art_posted_datetime, art_validated, art_showme, art_views, art_last_update, art_last_update_by, art_last_update_ip, art_weight, art_nohtml, art_nosmiley, art_noxcode, art_noimage, art_nobr FROM " .$xoopsDB->prefix('articles_main') . " WHERE id=".intval($art_id)." LIMIT 1");
				list($id, $art_author_id, $art_author_ip, $art_cat_id, $art_title, $art_description, $art_article_text, $art_posted_datetime, $art_validated, $art_showme, $art_views, $art_last_update, $art_last_update_by, $art_last_update_ip, $art_weight, $art_nohtml, $art_nosmiley, $art_noxcode, $art_noimage, $art_nobr) = $xoopsDB->fetchRow($result);
				
				$art_title			= $myts->htmlSpecialChars($art_title);
				$art_description	= $myts->htmlSpecialChars($art_description);
				$art_article_text	= $myts->htmlSpecialChars($art_article_text);
				
		} //
		//
		// If it is for the preview, get the data from the form.
		// Preview area code in articleform.inc/php

		$formaction = "edit";
		$formtitle = _AM_ART_EDITTITLE;

		include_once("articleform.inc.php");
		
		admin_artfoot_text();
		xoops_cp_footer();
	} 
	//
	// Save modifications.
	//
	if (isset($_REQUEST['but_save'])) {
		//xoops_cp_header();

		if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
			else { $formdata = ""; }
		
		$art_id              = intval($formdata['art_id']);
		$art_cat_id          = intval($formdata['art_cat_id']);
	    $art_title           = $myts->addSlashes($formdata['art_title']);
		$art_description     = $myts->addSlashes($formdata['art_description']);
		$art_article_text    = $myts->addSlashes($formdata['art_article_text']);
		$art_validated      = "1";
		$art_weight         = $formdata['art_weight'];
		
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
		
		
		// find user id
		if (empty($xoopsUser)) { $art_last_update_by = 0;} 
			else { $art_last_update_by = $xoopsUser->getVar('uid'); }
	
		// get ip address
		if (isset($_SERVER['REMOTE_ADDR'])) {
			$art_last_update_ip = $_SERVER['REMOTE_ADDR']; }
			
		
			//$sql = ("UPDATE ".$xoopsDB->prefix("articles_main")." SET id = '$art_id', art_author_id = '$art_author_id', art_author_ip = '$art_author_ip', art_cat_id = '$art_cat_id', art_title = '$art_title', art_description = '$art_description', art_article_text = '$art_article_text', art_posted_datetime = '$art_posted_datetime', art_validated = '$art_validated', art_showme = '$art_showme', art_views = '$art_views', art_last_update = NOW(), art_last_update_by = '$art_last_update_by', art_last_update_ip = '$art_last_update_ip', art_weight = '$art_weight', art_nohtml = '$art_nohtml', art_nosmiley = '$art_nosmiley', art_noxcode = '$art_noxcode', art_noimage = '$art_noimage', art_nobr = '$art_nobr' WHERE id=$art_id");
			
			$sql = ("UPDATE ".$xoopsDB->prefix("articles_main")." SET 
				id = '$art_id', 
				art_cat_id = '$art_cat_id', 
				art_title = '$art_title', 
				art_description = '$art_description', 
				art_article_text = '$art_article_text', 
				art_validated = '1', 
				art_showme = '$art_showme', 
				art_last_update = NOW(), 
				art_last_update_by = '$art_last_update_by', 
				art_last_update_ip = '$art_last_update_ip', 
				art_weight = '$art_weight', 
				art_nohtml = '$art_nohtml', 
				art_nosmiley = '$art_nosmiley', 
				art_noxcode = '$art_noxcode', 
				art_noimage = '$art_noimage', 
				art_nobr = '$art_nobr' 
				WHERE id=$art_id");
			
			$result=$xoopsDB->query($sql);

			if ($xoopsDB->query($sql)) {
				redirect_header("arteddel.php", 2, _MD_DBUPDATED);
				//echo "entered";
			} else {
				redirect_header("arteddel.php", 2, _MD_DBNOTUPDATED);
				//echo "not entered";
			}

	} //

} //

//
//----------------------------------------------------------------------------//
// Delete
if (isset($_REQUEST['op']) && $_REQUEST['op'] == "delete") {

	if (isset($_REQUEST['art_id'])) { $art_id = $_REQUEST['art_id']; }

	// confirm
	if (!isset($_REQUEST['subop'])) {
		xoops_cp_header();
		xoops_confirm(array('op' => 'delete', 'art_id' => $art_id, 'subop' => 'delok'), 'arteddel.php', _MD_CONFIRMDELETE);
		xoops_cp_footer();
	} //
	// Delete
	if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == "delok") {
	
		$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("articles_main"), $art_id);
	                
		if ($xoopsDB->queryF($sql)) {
			// delete comments for the article being deleted
			xoops_comment_delete($xoopsModule->getVar('mid'), $art_id);
			// delete notifications for deleted article
			xoops_notification_deletebyitem($xoopsModule->getVar('mid'), 'global', $art_id);
			redirect_header("arteddel.php", 2, _MD_ITEMDELETED);
			//echo "deleted";
		} else {
			redirect_header("arteddel.php", 2, _MD_ITEMNOTDELETED);
			//echo "not deleted";
		} //
	} //

} //


?>
