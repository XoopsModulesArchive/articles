<?php
// $Id: catadd.php,v 1.3 2005/04/15 20:57:31 andrew Exp $
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

//
//----------------------------------------------------------------------------//
// Default view
if (!isset($_REQUEST['op']) OR isset($_REQUEST['but_preview'])) {
xoops_cp_header();
admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVINDEX ."</a> &raquo; ". _AM_ART_NAVCATADD ."");


$formaction = "add";
$formtitle = _AM_ART_FRMTTLADDCAT;

include_once("categoryform.inc.php");

admin_artfoot_text();
xoops_cp_footer();		
} //

//
//----------------------------------------------------------------------------//
// Save
if (isset($_REQUEST['but_save'])) {

	if (isset($_REQUEST['formdata'])) { $formdata = $_POST['formdata']; }
		else { $formdata = ""; }
	
	//$cat_parent_id   = $formdata['cat_parent_id'];
	$cat_name        = $myts->addSlashes($formdata['cat_name']);
	$cat_description = $myts->addSlashes($formdata['cat_description']);
	$cat_weight      = $formdata['cat_weight'];
	//$cat_showme      = $formdata['cat_showme'];
	
	
	if (isset($formdata['cat_showme']) AND $formdata['cat_showme'] == "1") { $cat_showme = "1"; }
		else { $cat_showme = "1"; }
		
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
	

	// 0|0|0|0|0 = nohtml|nosmiley|noxcode|noimage|nobr
	$cat_options = $cat_nohtml."|".$cat_nosmiley."|".$cat_noxcode."|".$cat_noimage."|".$cat_nobr;
	
	$newid = $xoopsDB->genId($xoopsDB->prefix("articles_cat")."_id_seq");
	$sql = "INSERT INTO ".$xoopsDB->prefix("articles_cat")." VALUES (
		NULL, 
		0, 
		'$cat_name', 
		'$cat_description', 
		'$cat_weight', 
		'$cat_showme',
		'$cat_options')";
	
	$xoopsDB->query($sql) or $eh->show("0013");
		if ($newid == 0) {
			$newid = $xoopsDB->getInsertId();
		}
		if ($xoopsDB->getAffectedRows($sql)) {
			// Notification doodah.
			$extra_tags = array();
			$extra_tags['CAT_TITLE'] = $cat_name;
			$extra_tags['CAT_URL']   = XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/index.php?cat_id=" . $newid;
			$notification_handler =& xoops_gethandler('notification');
			$notification_handler->triggerEvent('global', 0, 'new_category', $extra_tags);
			redirect_header("catadd.php", 2, _MD_DBUPDATED);
			//echo "entered";
		} else {
			#redirect_header("catadd.php", 2, _MD_DBNOTUPDATED);
			//echo "not entered";
		}
		
} //




?>