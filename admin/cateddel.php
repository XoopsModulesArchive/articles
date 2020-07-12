<?php
// $Id: cateddel.php,v 1.5 2007/03/27 21:35:34 andrew Exp $
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
$myts =& MyTextSanitizer::getInstance(); 
$eh = new ErrorHandler;

//
//----------------------------------------------------------------------------//
// Default view
if (!isset($_REQUEST['op'])) {
xoops_cp_header();
admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVINDEX ."</a> &raquo; ". _AM_ART_NAVCATEDDEL ."");
?>
<br />
<table cellpadding="0" cellspacing="1" class="outer" style="width: 100%;">
  <tr>
    <th colspan="6"><?php echo _AM_ART_FRMTTLEDTCAT; ?></th>
  </tr>
  <tr>
    <td class="head" style="width: 30px; text-align: center;"><?php echo _AM_ART_FRMCAPHDRID; ?></td>
	<td class="head" style="text-align: center;"><?php echo _AM_ART_FRMCAPHDRTTL; ?></td>
	<td class="head" style="width: 30px; text-align: center;"><?php echo _AM_ART_FRMCAPHDRORDR; ?></td>
	<td class="head" style="width: 18px; text-align: center;"></td>
	<td class="head" style="width: 20px; text-align: center;"></td>
	<td class="head" style="width: 20px; text-align: center;"></td>
  </tr>
  
<?php  

	$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_cat") . " ");//ORDER BY $sqlorder $orderby");
	//$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_main") . " "); // ORDER BY $sqlorder $orderby");
	$result=$xoopsDB->query($sql);
	
	if ($xoopsDB->getRowsNum($result) > 0) {
		$rowclass = "even"; // set default call to use for rows
		while($myrow = $xoopsDB->fetchArray($result)) {
			$id 					= $myrow['id'];
			$cat_name				= $myts->htmlSpecialChars($myts->stripSlashesGPC($myrow['cat_name'], 0, 0, 1, 0, 0));
			//$art_cat_id				= $myrow['art_cat_id'];
			$cat_weight				= $myrow['cat_weight'];
			
			if ($rowclass == "even") { $rowclass = "odd"; } else { $rowclass = "even"; }
			
			// stuff
?>

  <tr>
    <td class="<?php echo $rowclass; ?>" style="width: 30px; text-align: center;"><?php echo $id; ?></td>
	<td class="<?php echo $rowclass; ?>"><?php echo $cat_name; ?></td>
	<td class="<?php echo $rowclass; ?>" style="width: 30px; text-align: center;"><?php echo $cat_weight; ?></td>
	<td class="<?php echo $rowclass; ?>" style="width: 18px; text-align: center;"><?php echo pub_status($id, "cat"); ?></td>
	<td class="<?php echo $rowclass; ?>" style="width: 20px; text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=edit&amp;cat_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKEDT; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/edit3.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKEDT; ?>"></a></td>
	<td class="<?php echo $rowclass; ?>" style="width: 20px; text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=delete&amp;cat_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKDLT; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/del3.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKDLT; ?>"></a></td>
  </tr>

<?php
		} // while  
	} else {
		echo "<td colspan=\"6\" class=\"odd\" style=\"text-align: center;\">" . _AM_ART_FRMCAPNOCATS . "</td>";
	}
?>  
</table>

<?php
admin_artfoot_text();
xoops_cp_footer();	
} //

//
//----------------------------------------------------------------------------//
//
if (isset($_REQUEST['op']) && $_REQUEST['op'] == "edit") {
	
	if (!isset($_REQUEST['but_save'])) {
		xoops_cp_header();
		admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVINDEX ."</a> &raquo; ". _AM_ART_NAVCATEDT ."");
		
		// If not preview, get details from db
		if (!isset($_POST['formdata'])) {
			if (isset($_GET['cat_id'])) { $cat_id = $_GET['cat_id']; }
				else { $cat_id = "0"; }
	
				$result = $xoopsDB->query("SELECT id, cat_name, cat_description, cat_weight, cat_showme, cat_options FROM " .$xoopsDB->prefix('articles_cat') . " WHERE id=".intval($cat_id)." LIMIT 1");
				list($id, $cat_name, $cat_description, $cat_weight, $cat_showme, $cat_options) = $xoopsDB->fetchRow($result);
				
				$cat_name			= $myts->htmlSpecialChars($cat_name);
				$cat_description	= $myts->htmlSpecialChars($cat_description);
										
				// 0|0|0|0|0 = nohtml|nosmiley|noxcode|noimage|nobr
				//$cat_options = $cat_nohtml."|".$cat_nosmiley."|".$cat_noxcode."|".$cat_noimage."|".$cat_nobr;
			
				$optpieces = explode("|", $cat_options);
				$cat_nohtml		= $optpieces[0];
				$cat_nosmiley	= $optpieces[1];
				$cat_noxcode	= $optpieces[2];
				$cat_noimage	= $optpieces[3];
				$cat_nobr		= $optpieces[4];
			} //
			
		$formaction = "edit";
		$formtitle = _AM_ART_FRMTTLEDTCAT;
		include_once("categoryform.inc.php");

		admin_artfoot_text();
		xoops_cp_footer();	
	} // not but_save
	//
	// Save modifications.
	//
	if (isset($_REQUEST['but_save'])) {
		//xoops_cp_header();

		if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
			else { $formdata = ""; }

		$cat_id				= intval($formdata['cat_id']);
	    $cat_name			= $myts->addSlashes($formdata['cat_name']);
		$cat_description	= $myts->addSlashes($formdata['cat_description']);
		$cat_weight			= intval($formdata['cat_weight']);
		
		if (isset($formdata['cat_showme'])) { $cat_showme = "1"; }
    			else { $cat_showme = "0"; }
		
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

		$cat_options = $cat_nohtml."|".$cat_nosmiley."|".$cat_noxcode."|".$cat_noimage."|".$cat_nobr;
		
		$sql = ("UPDATE ".$xoopsDB->prefix("articles_cat")." SET 
			id = '$cat_id', 
			cat_parent_id = 0, 
			cat_name = '$cat_name', 
			cat_description = '$cat_description', 
			cat_weight = '$cat_weight', 
			cat_showme = '$cat_showme', 
			cat_options = '$cat_options' 
			WHERE id=$cat_id");
			
			$result=$xoopsDB->query($sql) or $eh->show("0013");

			if ($xoopsDB->query($sql)) {
				redirect_header("cateddel.php", 2, _MD_DBUPDATED);
				//echo "entered";
			} else {
				redirect_header("cateddel.php", 2, _MD_DBNOTUPDATED);
				//echo "not entered";
			}
			
	} // save
	
} //

//
//----------------------------------------------------------------------------//
// Delete
if (isset($_REQUEST['op']) && $_REQUEST['op'] == "delete") {

	if (isset($_REQUEST['cat_id'])) { $cat_id = $_REQUEST['cat_id']; }

	// confirm
	if (!isset($_REQUEST['subop'])) {
		xoops_cp_header();
		xoops_confirm(array('op' => 'delete', 'cat_id' => $cat_id, 'subop' => 'delok'), 'cateddel.php', _MD_CONFIRMDELETE);
		xoops_cp_footer();
	} //
	// Delete
	if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == "delok") {
	
		$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("articles_cat"), $cat_id);
	                
		if ($xoopsDB->queryF($sql)) {
			// delete comments for the article being deleted
			//xoops_comment_delete($xoopsModule->getVar('mid'), $cat_id);
			// delete notifications for deleted article
			xoops_notification_deletebyitem($xoopsModule->getVar('mid'), 'global', $cat_id);
			redirect_header("cateddel.php", 2, _MD_ITEMDELETED);
			//echo "deleted";
		} else {
			redirect_header("cateddel.php", 2, _MD_ITEMNOTDELETED);
			//echo "not deleted";
		} //
	} //

} //



?>