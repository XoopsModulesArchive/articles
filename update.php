<?php
// $Id: update.php,v 1.5 2004/10/30 20:53:05 andrew Exp $
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

include_once ('header.php');
include_once ('include/config.php');
include_once ('include/functions.inc.php');

// Some settings
$backupappend = "pre009";

// example sql line
// ALTER TABLE clientphones ADD cp_name CHAR(10);

if (isset($_GET['stage'])) { $stage = $_GET['stage'];	}
if (isset($_GET['formdata'])) { $formdata = $_GET['formdata']; }

if (isset($_SERVER['PHP_SELF'])) { $page = $_SERVER['PHP_SELF']; }	
	
################################################################################
## intro
if (!isset($stage)) {

	if (isset($_SERVER['PHP_SELF'])) {
		$page = $_SERVER['PHP_SELF'];
	}

html_head();

?>

<table class="maintable" align="center">
  <tr>
    <th>Articles database update</th>
  </tr>
  <tr>
    <td>
    
    <p>The latest version of articles provides some new features, some of these
    required database changes, so to be able to use this version of Articles,
    you will need to update your current database by running this script.</p> 
    
    <p>The alternative is to make copies of your articles, uninstall the 
    Articles module from the Xoops admin, install v0.09 and re-enter all your
    category and articles again.</p>
    
    <p>This version updates the Articles database tables from v0.06 to that of 
    v0.09 - this skips v0.07 and v0.08 as they were not publically released.</p>
    
    <div align="center">
    <form method="get" action="<?=$page?>">
      <input type="hidden" name="stage" value="1" />
      <input type="submit" value=" Continue ">
    </form>
    </div>
    
    </td>
  </tr>
</table>
	
<?php
html_foot();
}

################################################################################
## Stage 1, ask to backup table
if (isset($stage) AND $stage == 1) {
html_head();
?>

<table class="maintable" align="center">
  <tr>
    <th>Articles database update - make backups?</th>
  </tr>
  <tr>
    <td>
    
    <p>Do you want to make backups?  This will make a copy of the<br /> 
    <code style="color: green;">"{PREFIX}_articles_main"</code><br />
    table in your database. This can then be copied
    back if something goes wrong.</p>
    
    <div align="center">
    <form method="get" action="<?=$page?>">
      <table>
        <tr>
          <td><input type="radio" name="formdata[backup]" value="1" checked /></td>
          <td>Yes, back up my data.</td>
        </tr>
        <tr>
          <td><input type="radio" name="formdata[backup]" value="0" /></td>
          <td>No, I'll take a chance.</td>
        </tr>
      </table>
      <br />
      <input type="hidden" name="stage" value="2" />
      <input type="submit" value=" Continue " />
    </form>
    </div>
    
    </td>
  </tr>
</table>
	
<?php
html_foot();
}

################################################################################
## Stage 2, backup mySQL table
if (isset($stage) AND $stage == 2 AND $formdata['backup'] == 1) {
	
//include XOOPS_ROOT_PATH.'/header.php';
html_head();
?>

<table class="maintable" align="center">
  <tr>
    <th>Articles database update - backing up...</th>
  </tr>
  <tr>
    <td>
    
    <p>Backing up table <i>articles_main</i> to <i>articles_main_<?=$backupappend?></i></p>
<?php    

//print_r($formdata);
// check if art_noimage field exists
$result = $xoopsDB->queryF("SELECT art_noimage, art_nobr FROM ".$xoopsDB->prefix("articles_main")." ");
if ($result) {
	echo "\"art_noimage\" and \"art_nobr\" fields already exists, no need to update...";	
	exit;
}

// check if backup table already exists
$result = $xoopsDB->queryF("SELECT * FROM ".$xoopsDB->prefix("articles_main_pre009")." ");
if ($result) {
	echo "The backup table already exists...";	
	exit;
}

	
	echo "Creating backup table... ";
	
	// Create backup table
	$result = $xoopsDB->queryF("CREATE TABLE `".$xoopsDB->prefix('articles_main_pre009')."` (
			`id` int(10) NOT NULL AUTO_INCREMENT ,
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
			PRIMARY KEY (id) ) TYPE = MYISAM ");

	// if table created successfully, copy the data
	if ($result) {
		// Say db created OK
		echo "<span style=\"color: green;\">OK</span><br />\n";
		echo "Copying table contents... ";		
		$resultcopy = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("articles_main_pre009")." SELECT * FROM ".$xoopsDB->prefix("articles_main"));
		if ($resultcopy) {
			echo "<span style=\"color: green;\">OK</span><br />\n";
			echo "<form method=\"get\" action=\"$page\">\n<input type=\"hidden\" name=\"stage\" value=\"3\" />\n<input type=\"submit\" value=\" Go ahead and update \" /></form>";
		} 
		else {
			echo "<span style=\"color: red;\">Failed!</span><br />\n";	
		}
	} 
	else {
		echo "<span style=\"color: red;\">Failed!</span><br />\n";	
	}


			
?>    
    </td>
  </tr>
</table>
	
<?php
html_foot();
//include XOOPS_ROOT_PATH.'/footer.php';
}

############################################################################
## Stage make changes
if ((isset($stage) AND $stage == 3) OR ((isset($formdata['backup']) == 0) AND (isset($stage) AND $stage == 2))) {
html_head();
?>	
<table class="maintable" align="center">
  <tr>
    <th>Articles database update - adding new table fields:</th>
  </tr>
  <tr>
    <td>
<?php

	// Add new field "art_noimage"
	echo "Adding new field \"art_noimage\": ";
	$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_main")." ADD art_noimage int(1) NOT NULL default '0' AFTER art_noxcode");
	if (!$result) {
		echo "<span style=\"color: red;\">Failed!</span><br />\n";
	}
	else {
		echo "<span style=\"color: green;\">OK</span><br />\n";
	}
	
	// Add new field "art_nobr"
	echo "Adding new field \"art_nobr\": ";
	$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_main")." ADD art_nobr int(1) NOT NULL default '0' AFTER art_noimage");
	if (!$result) {
		echo "<span style=\"color: red;\">Failed!</span><br />\n";
	}
	else {
		echo "<span style=\"color: green;\">OK</span><br />\n";
	}

## prefs table
// check if backup table already exists
$result = $xoopsDB->queryF("SELECT * FROM ".$xoopsDB->prefix("articles_prefs")." ");
if ($result) {
	echo "The general preferences table already exists...";	
	exit;
}

	echo "Creating general prefs table... ";
	
	// Create backup table
	$result = $xoopsDB->queryF("CREATE TABLE `".$xoopsDB->prefix('articles_prefs')."` (
			`id` int(10) NOT NULL auto_increment,
			`index_display` int(5) NOT NULL default '1',
			`articlebg` varchar(15) NOT NULL default 'white',
			PRIMARY KEY (id) ) TYPE = MYISAM ");

	if ($result) {
		// Say db created OK
		echo "<span style=\"color: green;\">OK</span><br />\n";
		echo "Inserting prefs field 1... ";
		$result = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("articles_prefs")." VALUES (1, 1, 'white')");
			if ($result) {
				echo "<span style=\"color: green;\">OK</span><br />\n";
				//echo "<form method=\"get\" action=\"$page\">\n<input type=\"hidden\" name=\"stage\" value=\"3\" />\n<input type=\"submit\" value=\" Go ahead and update \" /></form>";
			} 
			else {
				echo "<span style=\"color: red;\">Failed!</span><br />\n";	
			}
		echo "Inserting prefs field 1... ";
		$result = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("articles_prefs")." VALUES (2, 1, 'white')");
			if ($result) {
				echo "<span style=\"color: green;\">OK</span><br />\n";
				//echo "<form method=\"get\" action=\"$page\">\n<input type=\"hidden\" name=\"stage\" value=\"3\" />\n<input type=\"submit\" value=\" Go ahead and update \" /></form>";
			} 
			else {
				echo "<span style=\"color: red;\">Failed!</span><br />\n";	
			}
	}
	else {
		echo "<span style=\"color: red;\">Failed!</span><br />\n";	
	}
## 008

?>

	<p><span style=\"color: red;\">Please note:</span> Don't forget to delete 
	this file! You can find it at:<br />
	<span style="color: green;"><?=$_SERVER['PHP_SELF']?></span></p>

    </td>
  </tr>
</table>		
<?php
html_foot();	
} // end




################################################################################
## Functions.  	                                                              ##
################################################################################

###############################################################################
# provides page html header
function html_head() {
?>

<html>
<head>
  <title></title>

  

<style type="text/css">
<!--
body, td {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
}

.maintable {
	width: 500px;
}

-->
</style>
</head>
<body>
<?php
} // end function

################################################################################
# provides page html footer
function html_foot() {
?>

</body>
</html>

<?php
} // end function


?>