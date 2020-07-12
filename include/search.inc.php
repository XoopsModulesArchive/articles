<?php
// $Id: search.inc.php,v 1.2 2004/01/10 19:32:31 andrew Exp $
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

function articles_search($queryarray, $andor, $limit, $offset, $userid){
	global $xoopsDB;
	$sql = "SELECT id, art_title, art_description, art_article_text, UNIX_TIMESTAMP(art_posted_datetime) AS date FROM ".$xoopsDB->prefix("articles_main")." WHERE art_validated=1 AND art_showme=1";
	if ( $userid != 0 ) {
		$sql .= " AND uid=".$userid." ";
	}
	// because count() returns 1 even if a supplied variable
	// is not an array, we must check if $querryarray is really an array
	if ( is_array($queryarray) && $count = count($queryarray) ) {
		$sql .= " AND ((art_title LIKE '%$queryarray[0]%' OR art_description LIKE '%$queryarray[0]%' OR art_article_text LIKE '%$queryarray[0]%')";
		for($i=1;$i<$count;$i++){
			$sql .= " $andor ";
			$sql .= "(art_title LIKE '%$queryarray[$i]%' OR art_description LIKE '%$queryarray[$i]%' OR art_article_text LIKE '%$queryarray[0]%')";
		}
		$sql .= ") ";
	}
	$sql .= "ORDER BY art_posted_datetime DESC";
	$result = $xoopsDB->query($sql,$limit,$offset);
	$ret = array();
	$i = 0;
 	while($myrow = $xoopsDB->fetchArray($result)){
		$ret[$i]['image'] = "images/forum.gif";
		$ret[$i]['link'] = "article.php?id=" . $myrow['id'] ."";
		$ret[$i]['title'] = $myrow['art_title'];
		$ret[$i]['time'] = $myrow['date'];
		//$ret[$i]['uid'] = $myrow['submitter'];
		$i++;
	}
	return $ret;
}
?>
