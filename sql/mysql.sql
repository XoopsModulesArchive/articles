# $Id: mysql.sql,v 1.8 2005/06/09 19:42:22 andrew Exp $
#
#//  ------------------------------------------------------------------------ //
#//  Author: Andrew Mills                                                     //
#//  Email:  ajmills@the-crescent.net                                         //
#//	 About:  This file is part of the Articles module for Xoops v2.           //
#//                                                                           //
#//  ------------------------------------------------------------------------ //
#//                XOOPS - PHP Content Management System                      //
#//                    Copyright (c) 2000 XOOPS.org                           //
#//                       <http://www.xoops.org/>                             //
#//  ------------------------------------------------------------------------ //
#//  This program is free software; you can redistribute it and/or modify     //
#//  it under the terms of the GNU General Public License as published by     //
#//  the Free Software Foundation; either version 2 of the License, or        //
#//  (at your option) any later version.                                      //
#//                                                                           //
#//  You may not change or alter any portion of this comment or credits       //
#//  of supporting developers from this source code or any supporting         //
#//  source code which is considered copyrighted (c) material of the          //
#//  original comment or credit authors.                                      //
#//                                                                           //
#//  This program is distributed in the hope that it will be useful,          //
#//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
#//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
#//  GNU General Public License for more details.                             //
#//                                                                           //
#//  You should have received a copy of the GNU General Public License        //
#//  along with this program; if not, write to the Free Software              //
#//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
#//  ------------------------------------------------------------------------ //

# --------------------------------------------------------
#
# Table structure for table `articles_cat`
#
CREATE TABLE `articles_cat` (
  `id` int(10) NOT NULL auto_increment,
  `cat_parent_id` int(10) NOT NULL default '0',
  `cat_name` varchar(50) NOT NULL default '0',
  `cat_description` text,
  `cat_weight` int(10) NOT NULL default '0',
  `cat_showme` int(5) NOT NULL default '0',
  `cat_options` varchar(10) NOT NULL default '0|0|0|0|0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
# --------------------------------------------------------
#
# Table structure for table `articles_main`
#
CREATE TABLE `articles_main` (
  `id` int(10) NOT NULL auto_increment,
  `art_author_id` int(10) NOT NULL default '0',
  `art_author_ip` varchar(15) NOT NULL default '0',
  `art_cat_id` int(10) NOT NULL default '0',
  `art_title` varchar(100) NOT NULL default '0',
  `art_description` text,
  `art_article_text` mediumtext,
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
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
# --------------------------------------------------------
#
# Table structure for table `articles_rating`
#
CREATE TABLE `articles_rating` (
  `id` int(10) NOT NULL auto_increment,
  `rate_article_id` int(10) NOT NULL default '0',
  `rate_user_id` int(10) NOT NULL default '0',
  `rate_user_ip` varchar(15) NOT NULL default '0',
  `rate_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

