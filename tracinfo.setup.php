<?PHP
/* ====================
[BEGIN_COT_EXT]
Code=tracinfo
Name=TracInfo
Description=Interface with Trac
Version=1.1
Date=2011-feb-28
Author=Kilandor
Copyright=Kilandor
Notes=This version only displays ticket info on index. Revision and ticket bots are disabled.
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
cronseckey=11:string:::Cron Security key, this will preven anyone from running the bots without this key
tracurl=12:string::trac.cotonti.com/:URL to your TracSite (used for linking up things) (without the http bit)
revforumsection=14:string:::Section ID for Revision forum posts to go in.
revbotid=15:string:::Revision Bot User ID which is used to post, posts as
revbotname=16:string::RevisionBot:Revision Bot User Name which should be same as the account name
tickforumsection=17:string:::Section ID for Ticket forum posts to go in.
tickarchforumsection=18:string:::Section ID for Ticket Archive forum posts to go in, after closed status
tickbotid=19:string:::Ticket Bot User ID which is used to post, posts as
tickbotname=20:string::TicketBot:Ticket User Name which should be same as the account name
addimg=30:string::skins/sed-light/img/svn-add.jpg:Path to image for "added" icon
delimg=31:string::skins/sed-light/img/svn-del.jpg:Path to image for "deleted" icon
editimg=32:string::skins/sed-light/img/svn-edit.jpg:Path to image for "edited" icon
moveimg=33:string::skins/sed-light/img/svn-move.jpg:Path to image for "moved" icon
copyimg=34:string::skins/sed-light/img/svn-copy.jpg:Path to image for "copied" icon
lastcheckrev=96:string::999999999999:Last Time Revision was checked.
lastrevision=97:string::0:Last Revision that was found when checked
lastchecktick=98:string::99999999999:Last Time Ticket was checked.
lastticket=99:string::0:Last Ticket that was found when checked
[END_COT_EXT_CONFIG]
==================== */

if (!defined('COT_CODE')) { die('Wrong URL.'); }

//if($action == 'install')
//{
//	// Install
//	sed_sql_query("
//CREATE TABLE `sed_tracinfo_tickets` (
//  `ticket_topicid` int(11) NOT NULL,
//  `ticket_sectionid` int(11) NOT NULL,
//  `ticket_id` int(11) NOT NULL,
//  `ticket_title` text NOT NULL default '',
//  `ticket_type` text NOT NULL default '',
//  `ticket_status` text NOT NULL default '',
//  `ticket_resolution` text NOT NULL default '',
//  `ticket_reporter` text NOT NULL default '',
//  `ticket_owner` text NOT NULL default '',
//  `ticket_priority` text NOT NULL default '',
//  `ticket_milestone` text NOT NULL default '',
//  `ticket_component` text NOT NULL default '',
//  `ticket_version` text NOT NULL default '',
//  `ticket_description` text NOT NULL default '',
//  `ticket_summary` text NOT NULL default '',
//  PRIMARY KEY  (`ticket_topicid`)
//) ENGINE=MyISAM;");
//}
//elseif($action == 'uninstall')
//{
//	// Uninstall
//}
?>