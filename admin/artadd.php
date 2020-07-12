<?php
// $Id: artadd.php,v 1.3 2005/04/15 20:57:30 andrew Exp $
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
admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVINDEX ."</a> &raquo; ". _AM_ART_NAVARTADD ."");

$formaction = "add";
$formtitle = _AM_ART_FRMTTLADDART;

include_once("articleform.inc.php");

admin_artfoot_text();
xoops_cp_footer();	
} //

//
//----------------------------------------------------------------------------//
// Save 
if (isset($_REQUEST['op']) AND isset($_REQUEST['but_save'])) {

	if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
		else { $formdata = ""; }
		
	$art_cat_id         = $formdata['art_cat_id'];
	$art_title          = $myts->addSlashes($formdata['art_title']);
	$art_description    = $myts->addSlashes($formdata['art_description']);
	$art_article_text   = $myts->addSlashes($formdata['art_article_text']);
	$art_validated      = "1";
	$art_showme         = $formdata['art_showme'];
	$art_views          = "0";
	$art_weight         = $formdata['art_weight'];
	
	// find user id
	if (empty($xoopsUser)) { $art_author_id = 0;} 
		else { $art_author_id = $xoopsUser->getVar('uid'); }
	
	// get ip address
	if (isset($_SERVER['REMOTE_ADDR'])) {
		$art_author_ip = $_SERVER['REMOTE_ADDR'];
	}
	
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
	
	$newid = $xoopsDB->genId($xoopsDB->prefix("articles_main")."_id_seq");
	$sql = "INSERT INTO ".$xoopsDB->prefix("articles_main")." VALUES (
		'$newid', 
		'$art_author_id', 
		'$art_author_ip', 
		'$art_cat_id', 
		'$art_title', 
		'$art_description', 
		'$art_article_text', 
		NOW(), 
		'$art_validated', 
		'$art_showme', 
		'$art_views', 
		NOW(), 
		'$art_author_id', 
		'$art_author_ip', 
		'$art_weight', 
		'$art_nohtml', 
		'$art_nosmiley', 
		'$art_noxcode', 
		'$art_noimage', 
		'$art_nobr' )";
		
		$xoopsDB->query($sql) or $eh->show("0013");
		if ($newid == 0) {
			$newid = $xoopsDB->getInsertId();
		}
		if ($xoopsDB->getAffectedRows($sql)) {
			// Notification doodah.
			$extra_tags = array();
			$extra_tags['ART_TITLE'] = $art_title;
			$extra_tags['ART_URL']   = XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/article.php?id=" . $newid;
			$notification_handler =& xoops_gethandler('notification');
			$notification_handler->triggerEvent('global', 0, 'new_article', $extra_tags);
			redirect_header("artadd.php", 2, _MD_DBUPDATED);
			//echo "entered";
		} else {
			redirect_header("artadd.php", 2, _MD_DBNOTUPDATED);
			//echo "not entered";
		}	
			
} //


?>
