<?php
// $Id: update025.php,v 1.1 2005/06/09 23:05:57 andrew Exp $
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
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with Foobar; if not, write to the Free Software                    //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

include_once ("header.php");
include_once ("include/config.php");
include_once ("include/functions.inc.php");

# Copy and replace pre012 for latest version

//
//----------------------------------------------------------------------------//
//
if (!isset($_REQUEST['op'])) {

?>

<table width="450px" align="center">
<tr>
<td>
<h3 align="center">Articles database update</h3>
<p>This script updates Articles database for version 0.25 and changes
the main text field for articles so it can store articles larger than
16kb. This is not a required update, but if you experience problems
with articles truncating after being submitted, this should cure it.</p>

<p>This may work for earlier releases of Articles.</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="op" value="1">
<input type="submit" value=" Go >> ">
</form>
	
</td>
</tr>
</table>


<?php
} //

//
//----------------------------------------------------------------------------//
//
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "1") {

?>

<table width="450px" align="center">
<tr>
<td>
<!--<h3 align="center">Articles database update</h3>-->
<p><strong>Updating database:</strong></p>

<?php
/*
// check if cat_options exists
$result = $xoopsDB->queryF("SELECT cat_options FROM ".$xoopsDB->prefix("articles_cat")." ");
if ($result) {
	echo "The required fields in <i>{prefix}_articles_cat</i> already exist, no need to update...";	
	exit;
} //

// check if backup table already exists
$result = $xoopsDB->queryF("SELECT * FROM ".$xoopsDB->prefix("articles_cat_pre021")." ");
if ($result) {
	echo "The backup table <p>{prefix}_articles_cat_pre021</p> already exists...";	
	exit;
} //
*/
// If last 2 checks passed, continue.	
echo "Creating backup table... ";

// Create backup table
$result = $xoopsDB->queryF("CREATE TABLE `".$xoopsDB->prefix('articles_main_bak025')."` (
	`id` int(10) NOT NULL auto_increment,
	`art_author_id` int(10) NOT NULL default '0',
	`art_author_ip` varchar(15) NOT NULL default '0',
	`art_cat_id` int(10) NOT NULL default '0',
	`art_title` varchar(100) NOT NULL default '0',
	`art_description` text,
	`art_article_text` text,
	`art_posted_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
	`art_validated` int(5) NOT NULL default '0',
	`art_showme` int(5) NOT NULL default '0',
	`art_views` int(10) NOT NULL default '0',
	`art_last_update` datetime NOT NULL default '0000-00-00 00:00:00',
	`art_last_update_by` int(5) NOT NULL default '0',
	`art_last_update_ip` varchar(15) NOT NULL default '0',
	`art_weight` int(10) NOT NULL default '0',
	`art_nohtml` int(1) NOT NULL default '0',
	`art_nosmiley` int(1) NOT NULL default '0',
	`art_noxcode` int(1) NOT NULL default '0',
	`art_noimage` int(1) NOT NULL default '0',
	`art_nobr` int(1) NOT NULL default '0',
	PRIMARY KEY  (`id`) ) TYPE=MyISAM ");

	if ($result) {
		echo "<span style=\"color: green;\">OK</span><br />\n";
    	echo "Copying table contents... ";
		$resultcopy = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("articles_main_bak025")." SELECT * FROM ".$xoopsDB->prefix("articles_main"));
		if ($resultcopy) {
			echo "<span style=\"color: green;\">OK</span><br />\n";
			//echo "<form method=\"get\" action=\"$page\">\n<input type=\"hidden\" name=\"stage\" value=\"3\" />\n<input type=\"submit\" value=\" Go ahead and update \" /></form>";
		} else {
			echo "<span style=\"color: red;\">Failed!</span><br />\n";	
			echo "MySQL error " . mysql_errno() . ": " . mysql_error();
			exit;
		}
	} else {
		echo "<span style=\"color: red;\">Failed!</span><br />\n";
		echo "MySQL error " . mysql_errno() . ": " . mysql_error();	
		exit;
	}

//
// Change `art_article_text` to mediumtext
// ALTER TABLE t1 CHANGE b b BIGINT NOT NULL;
echo "Changing field type... ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_main")." CHANGE art_article_text art_article_text MEDIUMTEXT"); 
	if ($result) { 
		echo "<span style=\"color: green;\">OK</span><br />\n"; 
	}
	else { 
		echo "<span style=\"color: red;\">Failed!</span><br />\n"; 
		exit;
	}

?>

<p>Done!</p>



<?php
		
} //



?>