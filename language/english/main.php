<?php
// $Id: main.php,v 1.17 2005/07/23 00:51:19 andrew Exp $

// English version.


// Cat/Article listing index.
define("_MD_CATLIST_CAPTION",	"Articles");			// Caption of category/article list
define("_MD_INDEX_PAGE_TITLE",	"Index page title");	// Title of category/article list page (not used in shipped package)
define("_MD_ARTICLE_VIEW_CAP",	"views");				// Caption for number of views
define("_MD_NUM_ARTICLE_CAP",	"articles");			// Caption for number of articles for category
define("_MD_NUM_ARTICLE_NUM",	"Articles");
define("_MD_NUM_ARTICLE_OF",	"of");
define("_MD_NUM_ARTICLE_TO",	"to");
define("_MD_NUM_ARTICLE_PREV",	"&#171;prev");
define("_MD_NUM_ARTICLE_NEXT",	"next&#187;");
define("_MD_NUM_ARTICLE_SEP",	"::");

// Article page
define("_MD_INDEXLINKTEXT",		"Index");		// Text for return to index page
define("_MD_INDEXLINKPRINT",	"Print");		// Text for printable version
define("_MD_POSTEDON",			"Posted on");	// Posted on text
define("_MD_READS", 			"reads");		// Text for reads
define("_MD_EMAIL", 			"E-mail");		// Text for email friend.
define("_MD_NOARTICLE",			"Sorry, the article you requested does not exist.");		// Text for email friend.
define("_MD_PAGENEXT",			"next");
define("_MD_PAGEPREV",			"prev");
define("_MD_PAGENUM",			"page");
define("_MD_PAGEOF",			"of");
define("_MD_ART_POSTER",		"by");


// E-mail page
define("_MD_EMAILHEADTTL", 		"E-mail Article to friend");
define("_MD_EMAILYOURNAME",		"Your name:");
define("_MD_EMAILYOUREMAIL",	"Your e-mail:");
define("_MD_EMAILRECIPIENT",	"Recipient:");
define("_MD_EMAILMESSAGE",		"Your message:");
define("_MD_EMAILMESSAGEDESC",	"This will be included in the e-mail.");
define("_MD_EMAILSEND",			"send");
define("_MD_EMAILSET",			"reset");
define("_MD_EMAILSECNOTE",		"<strong>Please note:</strong> Some security information will be sent along with the e-mail to help trace anyone who abuses this service."); 

// Print page
define("_MD_ARTPRINTTITLE",		"Article title:");
define("_MD_ARTPRINTPOSTED",	"First posted:");
define("_MD_ARTPRINTDESCRIP",	"Description:");
define("_MD_ARTPRINTTEXT",		"Article text:");
define("_MD_ARTPRINTPUB",		"This article was originally published on:");
define("_MD_ARTPRINTSITENAME",	"Site:");
define("_MD_ARTPRINTSITEURL",	"URL:");

// General
define("_MD_MOD_WHOBY",		"<span style=\"font-size: smaller; text-align: center;\">Articles Copyright &copy 2003 <a href=\"ajmills@sirium.net\">Andrew Mills</a></span>");

// Confirmation messages
define("_MD_DBUPDATED",					"Database updated successfully!");
define("_MD_DBNOTUPDATED",				"Database not updated!"); 
define("_MD_ITEMDELETED",				"Item deleted successfully!");
define("_MD_ITEMNOTDELETED",			"Item not deleted successfully!");
define("_MD_ITEM_DELETED_CANCELLED",	"Delete cancelled!");
define("_MD_CONFIRMDELETE",             "Are you sure you want to delete this item?");
define("_MD_DBSUBMITTED",				"Thank you for your submission, we will review it for publication as soon as possible.");

// Errors
define("_MD_NOACCESSHERE",	"You don't have permission to access this page.");
define("_MD_LOGGEDIN",		"You have to be logged in to access this page.");
define("_MD_EMLMAXCHARS",	"You have entered more than the maximum allowed characters.");
define("_MD_NOTALLOWED",	"You don't have access to this page.");

// Submit page
define("_MD_ART_SUBINTRO",		"You can use the following form to submit your article. Please be aware that it will have to be approved by an administrator before it is published.");
define("_MD_SUBMIT_PAGE_TITLE", "Submit an article");
define("_MD_ART_SUBALERTTITLE",	"Please enter at least 3 characters for a title.");
define("_MD_ART_SUBALERTCAT",	"Please select a category from the drop down list.");
define("_MD_ART_SUBTITLE",		"Title:");
define("_MD_ART_SUBCAT",		"Category:");
define("_MD_ART_SUBDESC",		"Description:");
define("_MD_ART_SUBTART",		"Article:");
define("_MD_ART_SUBTNOTIFY",	"Notify:");
define("_MD_ART_SUBTNOTIFYDES",	"Notify you when article has been published?");
define("_MD_ART_SUBMIT",		" Submit article ");
define("_MD_ART_SUBRESET",		" Reset ");
define("_MD_ART_PREVIEW",		" Preview ");
define("_MD_SUBMITTEDMSG",		"Article submitted");
define("_MD_SUBMITTEDMSGDESC",	"Thank you for your submission, we will review it before it is published.");
define("_MD_FORMCAPTIONPAGEBRK",	"Use <strong>[pagebreak]</strong> to break article into pages.");
define("_MD_FORMCAPTIONNOHTML",		"Disable HTML tags");
define("_MD_FORMCAPTIONNOSMILEY",	"Disable Smiley icons");
define("_MD_FORMCAPTIONNOXCODE",	"Disable XOOPS codes");
define("_MD_FORMCAPTIONNOIMAGE",	"Disable images (using XOOPS codes)");
define("_MD_FORMCAPTIONNOBR",		"Disable auto line breaks");
define("_MD_FORMCAPTIONSELECT",		"Please select a category");


?>
