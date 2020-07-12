<?php

// The name of this module.
define('_MI_ARTICLES_NAME',		'Articles');

// Description for this module.
define('_MI_ARTICLES_DESC',		'Articles: Article Manager for Xoops v2');

// Names of blocks for this module.
define('_MI_ARTICLES_BNAME1',	'Latest Articles'); // New articles
define('_MI_ARTICLES_BNAME2',	'Popular Articles'); // Top by views
define('_MI_ARTICLES_BNAME3',	'Latest Published Articles'); // New articles - main display
define('_MI_ARTICLES_BNAME4',	'Popular Published Articles'); // Top by rates - main display

// Names of admin menu items
define('_MI_ARTICLE_ADMENU1',	'Index');
define('_MI_ARTICLE_ADMENU2',	'Add articles');
define('_MI_ARTICLE_ADMENU3',	'Edit/Delete articles');
define('_MI_ARTICLE_ADMENU4',	'Add categories');
define('_MI_ARTICLE_ADMENU5',	'Edit/Delete categories');
define('_MI_ARTICLE_ADMENU6',	'Validate articles');

// Sub menu items
define('_MI_ARTICLE_SUBMENU1',	'Submit article');

// Notification stuff
define('_MI_ARTICLE_GLOBAL_NOTIFY',     'Global');
define('_MI_ARTICLE_GLOBAL_NOTIFYDSC',  'Global links notification options.');

define('_MI_ARTICLE_USERSUBNOTIFY',		'Admin');
define('_MI_ARTICLE_USERSUBNOTIFYDSC',	'Admin notification of user submitted articles.');

define('_MI_ARTICLE_GLOBAL_NEWARTICLE_NOTIFY',      'New article added.');
define('_MI_ARTICLE_GLOBAL_NEWARTICLE_NOTIFYCAP',   'Notify me when new articles are added.');
define('_MI_ARTICLE_GLOBAL_NEWARTICLE_NOTIFYDSC',   'Receive notification when a new article is added.');
define('_MI_ARTICLE_GLOBAL_NEWARTICLE_NOTIFYSBJ',   '[{X_SITENAME}] New article added.');

define('_MI_ARTICLE_GLOBAL_NEWCATEGORY_NOTIFY',      'New category added.');
define('_MI_ARTICLE_GLOBAL_NEWCATEGORY_NOTIFYCAP',   'Notify me when new categories are added.');
define('_MI_ARTICLE_GLOBAL_NEWCATEGORY_NOTIFYDSC',   'Receive notification when a new category is added.');
define('_MI_ARTICLE_GLOBAL_NEWCATEGORY_NOTIFYSBJ',   '[{X_SITENAME}] New category added.');

define('_MI_ART_ADMIN_USERNEWARTICLE_NOTIFY',		'New article submitted.');
define('_MI_ART_ADMIN_USERNEWARTICLE_NOTIFYCAP',	'Notify admin when user submits an article.');
define('_MI_ART_ADMIN_USERNEWARTICLE_NOTIFYDSC',	'Receive notification when a user submits an article for publication.');
define('_MI_ART_ADMIN_USERNEWARTICLE_NOTIFYSBJ',	'[{X_SITENAME}] A user has submitted an article for validation.');


// Config stuff
define('_MI_ART_OPTION_LOGGEDIN',		'Allow anonymous submissions:');
define('_MI_ART_OPTION_LOGGEDINDSC',	'Allow article submissions from anonymous users.');
define('_MI_ART_OPTIONALLOWSUB',		'Allow user articles');
define('_MI_ART_OPTIONALLOWSUBDSC',		'Allow users to submit articles.');
define('_MI_ART_OPTION_ICONSIZE',		'Article icon size');
define('_MI_ART_OPTION_ICONSIZEDSC',	'Size of icons for article listings.');
define('_MI_ART_OPTION_EDITADMIN',		'Admin editor.');
define('_MI_ART_OPTION_EDITADMINDSC',	'The editor to use in the admin area. If a third party editor is selected, but not installed, the default editor will be used.');
define('_MI_ART_OPTION_EDITUSER',		'User editor.');
define('_MI_ART_OPTION_EDITUSERDSC',	'The editor to use in user/visitor areas. If a third party editor is selected, but not installed, the default editor will be used.');
define('_MI_ART_OPTION_INDEXVIEW',		'Index view type');
define('_MI_ART_OPTION_INDEXVIEWDSC',	'select how the main index page should show display.');
define('_MI_ART_OPTION_INDEXFLAT',		'Categories and articles');
define('_MI_ART_OPTION_INDEXTHREAD',	'Categories only');
define('_MI_ART_OPTION_BGCOLOR',		'Article background');
define('_MI_ART_OPTION_BGCOLORDSC',		'The background colour for the article text.');
define('_MI_ART_OPTION_SHWREADS',		'Show article reads');
define('_MI_ART_OPTION_SHWREADSDSC',	'display numbers of times read on article page.');
define('_MI_ART_OPTION_SHWPOSTED',		'Show article posted');
define('_MI_ART_OPTION_SHWPOSTEDSC',	'display when article was posted.');
define('_MI_ART_OPTION_SHWPOSTR',		'Show article poster');
define('_MI_ART_OPTION_SHWPOSTRDSC',	'display who posted the article.');
define('_MI_ART_OPTION_SHWINDRDS',		'Show reads in index');
define('_MI_ART_OPTION_SHWINDRDSDSC',	'display number of article reads in index listing.');
define('_MI_ART_OPTION_ALLOWEMAIL',		'Allow e-mail');
define('_MI_ART_OPTION_ALLOWEMAILDSC',	'allow send e-mail to friend feature. Disabling this will also hide the e-mail link.');
define('_MI_ART_OPTION_EMLLOGGEDIN',	'Logged in to e-mail');
define('_MI_ART_OPTION_EMLLOGGEDINDSC',	'whether user should be logged in to use e-mail to friend feature.');
define('_MI_ART_OPTION_EMLOWNMSG',		'Allow own message');
define('_MI_ART_OPTION_EMLOWNMSGDSC',	'allow user to add their own message to e-mail.');
define('_MI_ART_OPTION_EMLMSGSBJCT',	'E-mail subject');
define('_MI_ART_OPTION_EMLMSGSBJCTDSC',	'the text that will appear in the e-mail\'s subject field.');
define('_MI_ART_OPTION_EMLMSGSUBJECT',	'A friend recommended this Article');
define('_MI_ART_OPTION_EMLMSGCHRS',		'No. characters in own message');
define('_MI_ART_OPTION_EMLMSGCHRSDSC',	'the maximum number of characters user is allowed to send in own message.');
define('_MI_ART_OPTION_NOINCADN',		'Don\'t increment views for admins');
define('_MI_ART_OPTION_NOINCADNDSC',	'when set, admins viewing articles will not increment how many times the article has been viewed.');
define('_MI_ART_OPTION_EMAILTXT',		'E-mail message');
define('_MI_ART_OPTION_EMAILTXTSC',		'The text that will be sent in the e-mail to a friend message.');
define('_MI_ART_OPTION_EMAILTXTMSG',	'Hello,

A user of {SITE_NAME} feels that the following page may be of interest to you.

{ARTICLE_URL}

Their message below:

**

{USER_MESSAGE}

**

Security information:
If this e-mail has been sent inappropriately, please forward the complete e-mail to {ADMIN_EMAIL}.
User\'s IP address: {USER_IP}
User\'s Browser: {USER_BROWSER}
Time sent: {USER_TIME}

-- 
 {SITE_NAME}
 {SITE_URL}
');

define('_MI_ART_OPTION_DATEFRMT',	'Date format - article');
define('_MI_ART_OPTION_DATEFRMTSC',	'Date format for the main article page. See PHP\'s <a href="http://www.php.net/date" target="_blank">date format page</a> for the different date format characters you can use.');
define('_MI_ART_OPTION_DATEFRMTP',	'Date format - print');
define('_MI_ART_OPTION_DATEFRMTPSC',	'Date format for the printable version page. See PHP\'s <a href="http://www.php.net/date" target="_blank">date format page</a> for the different date format characters you can use.');
define('_MI_ART_OPTION_ALLWPRT',	'Allow printable page');
define('_MI_ART_OPTION_ALLWPRTDSC',	'allow visitors to use the printable version page. Disabling this will also hide the print link.');
define('_MI_ART_OPTION_PAGETTL',	'Article title as page title:');
define('_MI_ART_OPTION_PAGETTLDSC',	'display the article\'s title in the page title.');
define('_MI_ART_OPTION_PAGETTL1',	'No');
define('_MI_ART_OPTION_PAGETTL2',	'Yes: &lt;module name&gt; - &lt;article title&gt;');
define('_MI_ART_OPTION_PAGETTL3',	'Yes: &lt;article title&gt; - &lt;module name&gt;');
define('_MI_ART_OPTION_PAGIN',		'Pagination limit:');
define('_MI_ART_OPTION_PAGINDSC',	'Number of articles to show in collapsed mode.');
define('_MI_ART_OPTION_FCKPATH',	'FCK Editor path:');
define('_MI_ART_OPTION_FCKPATHDSC',	'The server path (relative to the root of your web space) to where you have installed the FCK editor files. (This option is not required for XOOPS 2.2.x)');
define('_MI_ART_OPTION_SPWPATH',	'SPAW Editor path:');
define('_MI_ART_OPTION_SPWPATHDSC',	'The server path (relative to the root of your web space) to where you have installed the SPAW editor files. (This option is not required for XOOPS 2.2.x)');
define('_MI_ART_OPTION_HTMLPATH',	'HTML Editor path:');
define('_MI_ART_OPTION_HTMLPATHDSC',	'The server path (relative to the root of your web space) to where you have installed the HTML editor files. (This option is not required for XOOPS 2.2.x)');
define('_MI_ART_OPTION_KOIVPATH',	'Koivi Editor path:');
define('_MI_ART_OPTION_KOIVPATHDSC',	'The server path (relative to the root of your web space) to where you have installed the Koivi editor files. (This option is not required for XOOPS 2.2.x)');


?>
