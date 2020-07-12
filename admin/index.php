<?php
// $Id: index.php,v 1.14 2005/04/15 20:57:30 andrew Exp $
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

include ('../../../include/cp_header.php');
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
//
xoops_cp_header();
admin_header("", "<a href=\"". XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/admin/index.php\">". _AM_ART_NAVINDEX ."</a> &raquo; ". _AM_ART_NAVFRNTPAGE ."");
?>
<br />
<table cellpadding="0" cellspacing="1" class="outer" style="width: 100%;">
  <tr>
    <th colspan="2"><?php echo _AM_ART_TTLGENSTATS; ?></th>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_TTLGENVLDT; ?></td>
	<td class="odd"><?php echo wait_validation(); ?> <?php echo _AM_ART_TTLGENVLDTDSC; ?></td>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_TTLGENNUMARTS; ?></td>
	<td class="odd"><?php echo total_arts(); ?> <?php echo _AM_ART_TTLGENNUMARTSDSC; ?></td>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_TTLGENNUMCATS; ?></td>
	<td class="odd"><?php echo total_cats(); ?> <?php echo _AM_ART_TTLGENNUMCATSDSC; ?></td>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_TTLGENNUMVIEWS; ?></td>
	<td class="odd"><?php echo total_views(); ?> <?php echo _AM_ART_TTLGENNUMVIEWSDSC; ?></td>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_TTLGENNUMPUB; ?></td>
	<td class="odd"><?php echo published_arts(); ?> <?php echo _AM_ART_TTLGENNUMPUBDSC; ?></td>
  </tr>
  <tr>
    <td class="head" style="width: 100px;"><?php echo _AM_ART_TTLGENNUMHIDDN; ?></td>
	<td class="odd"><?php echo hidden_arts(); ?> <?php echo _AM_ART_TTLGENNUMHIDDNDSC; ?></td>
  </tr>
</table>

<?php

//
// old stuff
//
/*
?>	
	<h4> <?php echo _AR_INDEX_TITLE; ?> </h4>
	<table width="100%" border="0" cellspacing="1" class="outer">
		<tr>
			<td class="odd">
				<strong><?php echo _AR_TABLE_CAPTION; ?></strong><br />
				<strong>&middot;</strong> <a href="artadd.php">*add article</a><br />
				<strong>&middot;</strong> <a href="articles.php"><?php echo _AR_INDEX_ARTLINK; ?></a> <br />
				<strong>&middot;</strong> <a href="categories.php"><?php echo _AM_INDEX_CATLINK; ?></a> <br />
				<strong>&middot;</strong> <a href="prefs.php"><?php echo _AR_INDEX_PREFLINK; ?></a> <br />
				<strong>&middot;</strong> <a href="validate.php">*Validate</a> (0)<br />
				<strong>&middot;</strong> <a href="tools.php">*Tools</a><br />
				<strong>&middot;</strong> <a href="<?php echo XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar('mid'); ?>"><?php echo _AR_INDEX_PREFLINK2; ?></a>
			</td>
		</tr>
	</table>

<?php                  
*/
admin_artfoot_text();
xoops_cp_footer();
?>
