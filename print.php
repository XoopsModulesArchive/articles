<?php
// $Id: print.php,v 1.13 2007/03/27 21:35:09 andrew Exp $
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

include_once('header.php');
include_once('include/functions.inc.php');
$myts =& MyTextSanitizer::getInstance();

//
//----------------------------------------------------------------------------//
// check if print feature is allowed.
if ($xoopsModuleConfig['allowprintable'] != 1) {
	redirect_header(XOOPS_URL ."/modules/". $xoopsModule->getVar('dirname') ."/index.php", 2, _MD_NOACCESSHERE);
	exit();
}

//
//----------------------------------------------------------------------------//
//
if (isset($_GET['id'])) {
		$id = $_GET['id'];

// put html here
html_header(); 
?>

<table class="maintbl">
  <tr>
    <td>
    

<?php
	$sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_main") . " WHERE id=" . intval($id) . " AND art_validated=1 AND art_showme=1 ORDER BY id LIMIT 1");
	$result=$xoopsDB->query($sql);
	while($myrow = $xoopsDB->fetchArray($result)) {
    
		//$article 	= array();
		$article_id				= $myrow['id'];
		$article_title			= $myts->htmlSpecialChars($myts->stripSlashesGPC($myrow['art_title']));
		$article_description	= $myts->displayTarea($myrow['art_description'], $myrow['art_nohtml'], $myrow['art_nosmiley'], $myrow['art_noxcode'], $myrow['art_noimage'], $myrow['art_nobr']);
        

		// fetch config switches for article display
		$article_text			= $myts->displayTarea($myrow['art_article_text'], $myrow['art_nohtml'], $myrow['art_nosmiley'], $myrow['art_noxcode'], $myrow['art_noimage'], $myrow['art_nobr']);
        $posted                 = post_date($myrow['art_posted_datetime'], $xoopsModuleConfig['dateformatprint']);

        // strip [pagebreak] tags - not needed in printable version
        $article_text = str_replace("[pagebreak]", " ", $article_text); 
        
?>	
	
<table border="0">
  <tr>
    <td><strong><?php echo _MD_ARTPRINTTITLE; ?></strong> &nbsp;</td>
    <td><?php echo $article_title; ?></td>
  </tr>
  <tr>
    <td><strong><?php echo _MD_ARTPRINTPOSTED; ?></strong> &nbsp;</td>
    <td><?php echo $posted; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo _MD_ARTPRINTDESCRIP; ?></strong> &nbsp;</td>
    <td><?php echo $article_description; ?></td>
  </tr>
</table>
<table>
  <tr><td height="5"></td></tr>
  <tr>
    <td>
      <strong><?php echo _MD_ARTPRINTTEXT; ?></strong><br />
      <?php echo $article_text; ?>
    </td>
  </tr>
  <tr><td height="5"></td></tr>
</table>
<table>
  <tr>
    <td colspan="2"><strong><?php echo _MD_ARTPRINTPUB; ?></strong></td>
  </tr>
  <tr>
    <td width="100"><strong><?php echo _MD_ARTPRINTSITENAME; ?></strong></td>
    <td><?php echo $xoopsConfig['sitename']; ?></td>
  </tr>
  <tr>
    <td><strong><?php echo _MD_ARTPRINTSITEURL; ?></strong></td>
    <td><a href="<?php echo XOOPS_URL;?>/modules/articles/article.php?id=<?php echo intval($id); ?>"><?php echo  XOOPS_URL;?>/modules/articles/article.php?id=<?php echo intval($id); ?></a></td>
  </tr>
</table>

<?php

	}	
?>	

    </td>
  </tr>
</table>

<?php

// html footer
html_footer();
} // end if


################################################################################
# functions
# 
function html_header() {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 TRANSITIONAL//EN">
<html>
<head>
	<title></title>
<style type="text/css">
	<!--
	body {
		font-family: "Times New Roman", Times, serif;
		font-size: 12pt;
		color: Black;
	}

	table.maintbl {
		border-style: solid;
		border-width: 1px;
		border-color: Black;
		width: 90%;
		margin-left: 5%;
		margin-right: 5%;
	}
	-->
</style>

<script language="Javascript1.2" type="text/javascript">
<!--
function printpage() {
window.print();  
}
//-->
</script>

</head>
<body onload="printpage()">

<?php

} // end function

################################################################################
#
function html_footer() {
?>

</body>
</html>
<?php
} // end function


#include XOOPS_ROOT_PATH.'/include/comment_view.php';
#include XOOPS_ROOT_PATH.'/footer.php';
?>