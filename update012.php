<?php
// $Id: update012.php,v 1.3 2004/10/30 20:53:05 andrew Exp $
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

# Copy and replace pre012 for latest version

// Some settings
$backupappend = "pre012";

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
    
    <p>This script updates the Articles database from version 0.09 to version
    0.12, this is to save you time and hassle re-installing the whole module
    and its articles from scratch.</p>

    <p>If you are updating from a version older than 0.09, you will have to 
    apply any relevant update scripts for that version first.</p>
    
    <div align="center">
    <form method="get" action="<?=$page?>">
      <input type="hidden" name="stage" value="1" />
      <input type="submit" value=" Start &gt;&gt; ">
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
    
    <p>Do you want to make backups?  This will make a copy of the
    altered tables in your database. This can then be copied
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
      <input type="submit" value=" Next &gt;&gt; " />
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
    
    <p>Backing up table <i>articles_prefs</i> to <i>articles_prefs_<?=$backupappend?></i></p>
<?php    

//print_r($formdata);
// Check articles_prefs in case new fields already exists.
$result = $xoopsDB->queryF("SELECT email_allow, email_loggedin, email_allowown, email_subject, email_text, email_maxchars, art_reads, art_posted, index_reads FROM ".$xoopsDB->prefix("articles_prefs")." ");
if ($result) {
	echo "The required fields in <i>articles_prefs</p> already exist, no need to update...";	
	exit;
}

// check if backup table already exists
$result = $xoopsDB->queryF("SELECT * FROM ".$xoopsDB->prefix("articles_prefs_pre012")." ");
if ($result) {
	echo "The backup table <p>articles_prefs_pre012</p> already exists...";	
	exit;
}


// If last 2 checks passed, continue.	
echo "Creating backup table... ";
	
// Create backup table
$result = $xoopsDB->queryF("CREATE TABLE `".$xoopsDB->prefix('articles_prefs_pre012')."` (
    `id` int(10) NOT NULL auto_increment,
    `index_display` int(5) NOT NULL default '1',
    `articlebg` varchar(15) NOT NULL default 'white',
     PRIMARY KEY  (`id`) ) TYPE = MYISAM ");

// if table created successfully, copy the data
if ($result) {
    // Say db created OK
    echo "<span style=\"color: green;\">OK</span><br />\n";
    echo "Copying table contents... ";		

    $resultcopy = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("articles_prefs_pre012")." SELECT * FROM ".$xoopsDB->prefix("articles_prefs"));
        //if (mysql_errno()) { echo "MySQL error " . mysql_errno() . ": " . mysql_error(); }
        if ($resultcopy) {
            echo "<span style=\"color: green;\">OK</span><br />\n";
            echo "<form method=\"get\" action=\"$page\">\n<input type=\"hidden\" name=\"stage\" value=\"3\" />\n<input type=\"submit\" value=\" Go ahead and update \" /></form>";
        } 
        else {
            echo "<span style=\"color: red;\">Failed!</span><br />\n";	
            echo "MySQL error " . mysql_errno() . ": " . mysql_error();
        }
	} 
	else {
		echo "<span style=\"color: red;\">Failed!</span><br />\n";
		echo "MySQL error " . mysql_errno() . ": " . mysql_error();	
	}


			
?>    
    </td>
  </tr>
</table>
	
<?php
html_foot();
//include XOOPS_ROOT_PATH.'/footer.php';
}

################################################################################
## Stage make changes
if ((isset($stage) AND $stage == 3) OR (($formdata['backup'] == 0) AND (isset($stage) AND $stage == 2))) {
html_head();
?>	
<table class="maintable" align="center">
  <tr>
    <th>Articles database update - adding new table fields:</th>
  </tr>
  <tr>
    <td>
<?php
#******************************************************************************#
# Add new fields

// Add new field "email_allow"
echo "Adding new field \"email_allow\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD email_allow int(1) NOT NULL default '1' AFTER articlebg");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }

#**
// Add new field "email_loggedin"
echo "Adding new field \"email_loggedin\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD email_loggedin int(1) NOT NULL default '1' AFTER email_allow");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }

#**
// email_allowown
echo "Adding new field \"email_allowown\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD email_allowown int(1) NOT NULL default '0' AFTER email_loggedin");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		

#**
// email_subject
echo "Adding new field \"email_subject\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD email_subject varchar(100) NOT NULL default '0' AFTER email_allowown");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		

#**	
// email_text
echo "Adding new field \"email_text\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD email_text text NOT NULL AFTER email_subject");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		

#**	
// email_maxchars	
echo "Adding new field \"email_maxchars\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD email_maxchars varchar(5) NOT NULL default '200' AFTER email_text");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		

#**	
// art_reads	
echo "Adding new field \"art_reads\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD art_reads int(1) NOT NULL default '1' AFTER email_maxchars");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		
	
#**	
// art_posted	
echo "Adding new field \"art_posted\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD art_posted int(1) NOT NULL default '1' AFTER art_reads");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		

#**	
// index_reads	
echo "Adding new field \"index_reads\": ";
$result = $xoopsDB->queryF("ALTER TABLE ".$xoopsDB->prefix("articles_prefs")." ADD index_reads int(1) NOT NULL default '1' AFTER art_posted");
	if (!$result) {	echo "<span style=\"color: red;\">Failed!</span><br />\n"; }
	else { echo "<span style=\"color: green;\">OK</span><br />\n"; }		

#******************************************************************************#		
# Update data into new fields

// Grab existing user defined data for prefs, and add new.
$sql = ("SELECT index_display, articlebg FROM " . $xoopsDB->prefix("articles_prefs") . " WHERE id =1 LIMIT 1");
$result=$xoopsDB->query($sql);
$myrow = $xoopsDB->fetchArray($result);	

    $id             = 1;
    $index_display  = $myrow['index_display'];
    $articlebg      = $myrow['articlebg']; 
    $email_allow    = 1; 
    $email_loggedin = 1;
    $email_allowown = 0; 
    $email_subject  = "A friend recommended this Article";
    $email_text     = "Hello,\r\n\r\nA user of {SITE_NAME} feels that the following page may be of interest to you.\r\n\r\n{ARTICLE_URL}\r\n\r\nTheir message below:\r\n\r\n**\r\n\r\n{USER_MESSAGE}\r\n\r\n**\r\n\r\nSecurity information:\r\nIf this e-mail has been sent inappropriately, please forward the complete e-mail to {ADMIN_EMAIL}.\r\nUser\'s IP address: {USER_IP}\r\nUser\'s Browser: {USER_BROWSER}\r\nTime sent: {USER_TIME}\r\n\r\n-- \r\n {SITE_NAME}\r\n {SITE_URL}\r\n";
    $email_maxchars = "200";
    $art_reads      = 1;
    $art_posted     = 1;
    $index_reads    = 1;

echo "\n<br />Updating new fields:<br />\n";

//id = '$id', index_display = '$index_display', articlebg = '$articlebg', email_allow = '$email_allow', email_loggedin = '$email_loggedin', email_allowown = '$email_allowown', email_subject = '$email_subject', email_text = '$email_text', email_maxchars = '$email_maxchars', art_reads = '$art_reads', art_posted = '$art_posted', index_reads = '$index_reads'

// Insert user prefs (row id 1)
echo "Inserting new prefs field data: ";
$result = $xoopsDB->queryF("UPDATE ".$xoopsDB->prefix("articles_prefs")." SET id = '$id', index_display = '$index_display', articlebg = '$articlebg', email_allow = '$email_allow', email_loggedin = '$email_loggedin', email_allowown = '$email_allowown', email_subject = '$email_subject', email_text = '$email_text', email_maxchars = '$email_maxchars', art_reads = '$art_reads', art_posted = '$art_posted', index_reads = '$index_reads' WHERE id=1");
    if ($result) { echo "<span style=\"color: green;\">OK</span><br />\n"; } 
    else { 
        echo "<span style=\"color: red;\">Failed!</span><br />\n";
        echo "MySQL error " . mysql_errno() . ": " . mysql_error(); 
    }

// Insert default prefs (row id 2)
$id            = 2;
$index_display = 1;
$articlebg     = "white"; 
echo "Inserting new (default) prefs field data: ";
$result = $xoopsDB->queryF("UPDATE ".$xoopsDB->prefix("articles_prefs")." SET id = '$id', index_display = '$index_display', articlebg = '$articlebg', email_allow = '$email_allow', email_loggedin = '$email_loggedin', email_allowown = '$email_allowown', email_subject = '$email_subject', email_text = '$email_text', email_maxchars = '$email_maxchars', art_reads = '$art_reads', art_posted = '$art_posted', index_reads = '$index_reads' WHERE id=2");
    if ($result) { echo "<span style=\"color: green;\">OK</span><br />\n"; } 
    else { 
        echo "<span style=\"color: red;\">Failed!</span><br />\n"; 
        echo "MySQL error " . mysql_errno() . ": " . mysql_error();
    }

#******************************************************************************#
	

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