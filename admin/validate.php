<?php
// $Id: validate.php,v 1.5 2007/03/27 21:35:34 andrew Exp $
//  ------------------------------------------------------------------------ //
//  This file is part of {NAME/DESCRIPTION}.                                 //
//  Copyright (C) 2003 Andrew Mills <ajmills@sirium.net>               //
//  See http://{URL} for more information.                                   //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with Foobar; if not, write to the Free Software                    //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

include_once ('../../../include/cp_header.php');
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include_once "../language/".$xoopsConfig['language']."/main.php";
} else {
	include_once "../language/english/main.php";
}
include_once ("../include/functions.inc.php");
include_once (XOOPS_ROOT_PATH . "/include/xoopscodes.php");
include_once (XOOPS_ROOT_PATH . "/class/module.errorhandler.php");
include_once (XOOPS_ROOT_PATH . "/class/xoopsformloader.php");
$myts =& MyTextSanitizer::getInstance();

//
//----------------------------------------------------------------------------//
// List
if (!isset($_REQUEST['op'])) {// OR $_REQUEST['op'] == "preview") {
xoops_cp_header();
admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVINDEX ."</a> &raquo; ". _AM_ART_NAVBCVALART ."");
?>	
<br />
<table border="0" cellpadding="0" cellspacing="1" width="100%" class="outer">
  <tr>
    <th colspan="5"><?php echo _AM_ART_FRMTTLVALART; ?></th>
  </tr>
  <tr>
    <td class="head" style="width: 30px;"><?php echo _AM_ART_FRMCAPHDRID; ?></td>
    <td class="head"><?php echo _AM_ART_FRMCAPHDRTTL; ?></td>
    <td class="head" style="width: 20px">&nbsp;</td>
    <td class="head" style="width: 20px">&nbsp;</td>
    <td class="head" style="width: 20px">&nbsp;</td>
  </tr>


<?php	
	
	$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_main") . " WHERE art_validated=0 ORDER BY art_posted_datetime ASC");
	$result=$xoopsDB->query($sql);
	
	if ($xoopsDB->getRowsNum($result) > 0) {
		$rowclass = "even"; // set default call to use for rows
		while($myrow = $xoopsDB->fetchArray($result)) {
			$id			= $myrow['id'];
			$art_title	= $myts->displayTarea($myrow['art_title'], 0, 0, 1, 0, 0);

		if ($rowclass == "even") { $rowclass = "odd"; } else { $rowclass = "even"; }

?>	
<tr>
  <td class="<?php echo $rowclass; ?>" style="text-align: center;"><?php echo $id; ?></td>
  <!-- <td><a href="<?php echo $_SERVER['PHP_SELF']."?op=preview&amp;id=". $id; ?>"><?php echo $art_title; ?></a></td> -->
  <td class="<?php echo $rowclass; ?>"><a href="#" onclick="window.open('<?php echo $_SERVER['PHP_SELF']."?op=preview&amp;id=". $id; ?>', 'preview', 'height=450,width=650,status=yes,scrollbars=yes,toolbar=no,menubar=no,location=yes');" title="<?php echo _AM_ART_FRMCAPLNKPRVW; ?>"><?php echo $art_title; ?></a></td>
  <td class="<?php echo $rowclass; ?>" style="text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=validate&amp;subop=noshow&amp;art_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKVLTHDE; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/ticko.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKVLTHDE; ?>"></a></td>
  <td class="<?php echo $rowclass; ?>" style="text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=validate&amp;subop=show&amp;art_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKVLTSHW; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/tickg.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKVLTSHW; ?>"></a></td>
  <td class="<?php echo $rowclass; ?>" style="text-align: center;"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=delete&amp;art_id=<?php echo $id; ?>" title="<?php echo _AM_ART_FRMCAPLNKDLT; ?>"><img src="<?php echo XOOPS_URL; ?>/modules/<?php echo $xoopsModule->getVar('dirname'); ?>/images/del3.png" width="16" height="16" alt="<?php echo _AM_ART_FRMCAPLNKDLT; ?>"></a></td>
</tr>
<?php			
		} // while
	} else {
		echo "<tr><td colspan=\"5\" class=\"odd\" style=\"text-align: center;\">". _AM_ART_FRMCAPNOVAL ."</td></tr>";
	}
	
	
	
?>

</table>
<?php
admin_artfoot_text();
xoops_cp_footer();
} // sect

//
//----------------------------------------------------------------------------//
// Preview
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "preview") {
	
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

} // sect

//
//----------------------------------------------------------------------------//
// Set validate/show status
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "validate") {
	
	if (isset($_REQUEST['art_id'])) { $art_id = $_REQUEST['art_id']; }
		else { $art_id = "0"; }
	
		// set validated but *not* published
		if (isset($_REQUEST['subop']) AND $_REQUEST['subop'] == "noshow") {
			$sql = ("UPDATE ".$xoopsDB->prefix("articles_main")." SET art_validated=1, art_showme=0 WHERE id=".intval($art_id)." ");

			if ($xoopsDB->queryF($sql)) {
				redirect_header("validate.php", 2, _MD_DBUPDATED);
				//echo "entered";
			} else {
				redirect_header("validate.php", 2, _MD_DBNOTUPDATED);
				//echo "not entered";
			}
		}
		
		// set validated and published
		if (isset($_REQUEST['subop']) AND $_REQUEST['subop'] == "show") {
			$sql = ("UPDATE ".$xoopsDB->prefix("articles_main")." SET art_validated=1, art_showme=1 WHERE id=".intval($art_id)." ");

			if ($xoopsDB->queryF($sql)) {
				redirect_header("validate.php", 2, _MD_DBUPDATED);
				//echo "entered";
			} else {
				redirect_header("validate.php", 2, _MD_DBNOTUPDATED);
				//echo "not entered";
			}
		}
} //

//
//----------------------------------------------------------------------------//
// Delete
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "delete") {
	//

	if (isset($_REQUEST['art_id'])) { $art_id = $_REQUEST['art_id']; }

	// confirm
	if (!isset($_REQUEST['subop'])) {
		xoops_cp_header();
		xoops_confirm(array('op' => 'delete', 'art_id' => $art_id, 'subop' => 'delok'), 'validate.php', _MD_CONFIRMDELETE);
		xoops_cp_footer();
	} //
	// Delete
	if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == "delok") {
	
		$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("articles_main"), $art_id);
	                
		if ($xoopsDB->queryF($sql)) {
			// delete comments for the article being deleted
			//xoops_comment_delete($xoopsModule->getVar('mid'), $cat_id);
			// delete notifications for deleted article
			//xoops_notification_deletebyitem($xoopsModule->getVar('mid'), 'global', $art_id);
			redirect_header("validate.php", 2, _MD_ITEMDELETED);
			//echo "deleted";
		} else {
			redirect_header("validate.php", 2, _MD_ITEMNOTDELETED);
			//echo "not deleted";
		} //
	} //
} //

?>
