<?php
// $Id: update021.php,v 1.1 2005/04/16 01:17:04 andrew Exp $
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
<p>This script updates Articles database for versions between 0.12 and 0.18a
to v0.20 and later. This is a required update, if it is not carried out, 
categories display will not work as intended, nor will category admin.</p>

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
$result = $xoopsDB->queryF("CREATE TABLE `".$xoopsDB->prefix('articles_cat_pre021')."` (
	`id` int(10) NOT NULL auto_increment,
	`cat_parent_id` int(10) NOT NULL default '0',
	`cat_name` varchar(50) NOT NULL default '0',
	`cat_description` text,
	`cat_weight` int(10) NOT NULL default '0',
	`cat_showme` int(5) NOT NULL default '0',
	PRIMARY KEY  (`id`) ) TYPE=MyISAM ");

	if ($result) {
		echo "<span style=\"color: green;\">OK</span><br />\n";
    	echo "Copying table contents... ";
		$resultcopy = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("articles_cat_pre021")." SELECT * FROM ".$xoopsDB->prefix("articles_cat"));
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
// Add new field "email_allow"
echo "Adding new field \"cat_showme\"... ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_cat")." ADD cat_options varchar(10) NOT NULL default '0|0|0|0|0' AFTER cat_showme"); 
	if ($result) { echo "<span style=\"color: green;\">OK</span><br />\n"; }
	else { 
		echo "<span style=\"color: red;\">Failed!</span><br />\n"; 
		exit;
	}

?>

<p>Please check your categories and articles - due to some changes in the
code, they may need their display settings re-setting.</p>

<p><strong>Optional:</strong></p>
<p>The preferences have now been integrated within XOOPS, this is to
allow easier updating of features in future releases. As a result, the
preferences table <em>{prefix}_articles_prefs</em> is no longer needed
and can be removed.</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="op" value="2">
<input type="submit" value=" Delete prefs table >> ">
</form>

</td>
</tr>
</table>

<?php
		
} //

//
//----------------------------------------------------------------------------//
// Delete prefs table
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "2") {
?>
<table width="450px" align="center">
<tr>
<td>

<p><strong>Removing uneeded tables:</strong></p>
<?php

echo "Deleting prefs table... ";
$result = $xoopsDB->queryF("DROP TABLE ".$xoopsDB->prefix("articles_prefs")." "); 
	if ($result) { 
		echo "<span style=\"color: green;\">OK</span><br />\n"; 
	} else { 
		echo "<span style=\"color: red;\">Unable to remove!</span><br />\n"; 

	}
?>

<p>Done! Please remove this file from your web space.</p>

</td>
</tr>
</table>
<?php	
}

?>