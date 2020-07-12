<?php
// $Id: admin.php,v 1.24 2005/07/29 00:31:29 andrew Exp $

// English version.

// Template constant
// define("_AM_ART_*",	"");

// Generic form captions
// Table titles
define("_AM_ART_FRMTTLPRVWEDTS",	"Preview article"); //(for pop-up preview)
define("_AM_ART_FRMTTLPRVWART",		"Preview article"); // for in article form page
define("_AM_ART_FRMTTLPRVWCAT",		"Preview category");
define("_AM_ART_FRMTTLADDART",		"Add article");
define("_AM_ART_FRMTTLADDCAT",		"Add category");
define("_AM_ART_FRMTTLEDTCAT",		"Edit category");
define("_AM_ART_FRMTTLVALART",		"Validate articles");
// Table column headers
define("_AM_ART_FRMCAPHDRID",		"ID");
define("_AM_ART_FRMCAPHDRTTL",		"Title");
define("_AM_ART_FRMCAPHDCATLNG",	"Category");
define("_AM_ART_FRMCAPHDCATSRT",	"Cat");
define("_AM_ART_FRMCAPHDRORDR",		"Order");
// Table side caption
define("_AM_ART_FRMCAPSDTTL",		"Title");
define("_AM_ART_FRMCAPSDCTGRY",		"Category");
define("_AM_ART_FRMCAPSDORDR",		"Order");
define("_AM_ART_FRMCAPSDDSPLY",		"Display");
define("_AM_ART_FRMCAPSDDSCRN",		"Description");
define("_AM_ART_FRMCAPSDCATDSC",	"Category description");
define("_AM_ART_FRMCAPSDARTCL",		"Article text");
// Link captions
define("_AM_ART_FRMCAPLNKPRVW",		"Click for preview");
define("_AM_ART_FRMCAPLNKEDT",		"Click to edit");
define("_AM_ART_FRMCAPLNKDLT",		"Click to delete");
define("_AM_ART_FRMCAPLNKGTFRM",	"Go to form");
define("_AM_ART_FRMCAPLNKVLTSHW",	"Click to validate and publish");
define("_AM_ART_FRMCAPLNKVLTHDE",	"Click to validate and not publish");
// Button caption
define("_AM_ART_FRMBTTNCLS",	"Close window");
define("_AM_ART_FRMBTTNSAVE",	"Save");
define("_AM_ART_FRMBTTNRST",	"Reset");
define("_AM_ART_FRMBTTNCNCL",	"Cancel");
define("_AM_ART_FRMBTTNPRVW",	"Preview");
// Form Element captions
define("_AM_ART_FRMCAPSLCTSHW",		"Select/tick to show article.");
define("_AM_ART_FRMCAPSLCTNOHTML",	"Disable HTML tags (leave unticked when using WYSIWYG editors).");
define("_AM_ART_FRMCAPSLCTNOBR",	"Disable auto line breaks (should be ticked when using WYSIWYG editors).");
define("_AM_ART_FRMCAPSLCTNOSMLY",	"Select to disable XOOPS smiley icons.");
define("_AM_ART_FRMCAPSLCTNOXIMG",	"Select to disable images displayed with XOOPS codes.");
define("_AM_ART_FRMCAPSLCTNOXCDE",	"Select to disable XOOPS codes.");
define("_AM_ART_FRMCAPSLCTCATSHW",	"Select/tick to show category and its related articles.");
// Misc
define("_AM_ART_FRMCAPSLCT",	"Please select a category");
define("_AM_ART_FRMCAPNOVAL",	"There are no articles to validate");
define("_AM_ART_FRMCAPSTTSPUB",	"Status: published");
define("_AM_ART_FRMCAPSTTSHDN",	"Status: hidden");
define("_AM_ART_FRMCAPPGBRK",	"Use <strong>[pagebreak]</strong> to break article into pages.");
// Javascript messages
define("_AM_ART_JVSRPTADDTTL",	"Please enter a title");
define("_AM_ART_JVSRPTSLTCAT",	"Please select a category from the dropdown list");
// Confirmation messages
define("_AM_ART_ERRORNOCATS",	"Please <a href=\"catadd.php\">add a category</a> before an article.");

// Navigation/breadcrumbs/info bar
// Navigation bar
define("_AM_ART_NAVINDEX",		"Index");
define("_AM_ART_NAVARTADD",		"Add article");
define("_AM_ART_NAVARTEDDEL",	"Edit/Del article");
define("_AM_ART_NAVARTEDT",		"Edit article");
define("_AM_ART_NAVCATADD",		"Add category");
define("_AM_ART_NAVCATEDDEL",	"Edit/Del category");
define("_AM_ART_NAVCATEDT",		"Edit category");
define("_AM_ART_NAVVALIDATE",	"Validate");
define("_AM_ART_NAVFRNTPAGE",	"Front page");
define("_AM_ART_NAVABOUT",		"About");
// "Breadcrumbs" bar
define("_AM_ART_NAVBCINDEX",	"Index");
define("_AM_ART_NAVBCARTEDDE",	"Edit/Del article");
define("_AM_ART_NAVBCVALART",	"Validate articles");
// Info bar
define("_AM_ART_NAVINFMOD",		"module");
define("_AM_ART_NAVINFPREF",	"prefs");
define("_AM_ART_NAVINFHELP",	"help");
define("_AM_ART_NAVINFABOUT",	"about");

// artadd.php


// arteddel.php
define("_AM_ART_LISTTITLE",		"Articles");
define("_AM_ART_EDITTITLE",		"Edit article");
define("_AM_ART_FRMCAPNOARTS",	"There are no articles to edit.");

// catadd.php
define("_AM_ART_FRMCAPNOCATS",	"There are no categories to edit.");

// validate.php


// index.php
define("_AM_ART_TTLGENSTATS",		"General stats");
define("_AM_ART_TTLGENVLDT",		"Validation:");
define("_AM_ART_TTLGENVLDTDSC",		"articles are waiting to <a href=\"validate.php\">be validated</a>.");
define("_AM_ART_TTLGENNUMARTS",		"No. articles:");
define("_AM_ART_TTLGENNUMARTSDSC",	"<a href=\"arteddel.php\">articles</a>.");
define("_AM_ART_TTLGENNUMCATS",		"No. categories:");
define("_AM_ART_TTLGENNUMCATSDSC",	"<a href=\"cateddel.php\">categories</a>.");
define("_AM_ART_TTLGENNUMVIEWS",	"No. views:");
define("_AM_ART_TTLGENNUMVIEWSDSC",	"total <a href=\"arteddel.php\">article</a> views.");
define("_AM_ART_TTLGENNUMPUB",		"Published:");
define("_AM_ART_TTLGENNUMPUBDSC",	"<a href=\"arteddel.php\">articles</a> have been published.");
define("_AM_ART_TTLGENNUMHIDDN",	"Hidden:");
define("_AM_ART_TTLGENNUMHIDDNDSC",	"articles are hidden (includes unvalidated <a href=\"arteddel.php\">articles</a>).");


// about.php



?>