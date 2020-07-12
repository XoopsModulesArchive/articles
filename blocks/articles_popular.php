<?php
// $Id: articles_popular.php,v 1.2 2004/04/18 21:57:47 andrew Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
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

function articles_popular_show($options) {
    global $xoopsDB, $xoopsModule, $xoopsUser;
    $myts =& MyTextSanitizer::getInstance();
    $block = array();
    $sql = "SELECT * FROM ".$xoopsDB->prefix("articles_main")." WHERE art_validated=1 and art_showme=1 ORDER BY art_views DESC LIMIT $options[0]";

    $result = $xoopsDB->query($sql);
        while ($myrow = $xoopsDB->fetchArray($result)) {
            $title = $myts->makeTboxData4Show($myrow['art_title']);
            if (!XOOPS_USE_MULTIBYTES) {
                if (strlen($myrow['art_title']) >= $options[1]) {
                    $title = $myts->makeTboxData4Show(substr($myrow['art_title'], 0, ($options[1] - 1))) . "...";
                } 
            }
            
            $artspop['title']       = $title;
            $artspop['id']          = $myrow['id'];
            $artspop['art_views']   = $myrow['art_views'];
            //$artspop['dir']         = $xoopsModule->dirname();
            
		    $block['artspop'][] = $artspop;
        }
    
    return $block;

}


function articles_popular_edit($options) {

	$form  = "&nbsp;" . _MB_ART_SHOW . "&nbsp;<input type=\"text\" name=\"options[]\" value=\"" . $options[0] . "\" size=\"5\" />&nbsp;" . _MB_ART_NUMBERS . "<br />";
	$form .= "&nbsp;" . _MB_ART_SHOW . "&nbsp;<input type=\"text\" name=\"options[]\" value=\"" . $options[1] . "\" size=\"5\" />&nbsp;" . _MB_ART_CHARS . "";

	return $form;    
}


?>