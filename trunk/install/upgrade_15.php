<?php
/**
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * $Id: upgrade_15.php,v 1.12 2007/06/24 10:50:10 jon Exp $
 **/

if (!defined('INSTALLER')) {
	exit('Use index.php to upgrade.');
}

$need_templates = array(
	'MAIN_COPYRIGHT', //Edited
	'REGISTER_MAIN',
	'FORUM_TOPIC',
	'TOPIC_MAIN',
	'PM_FOLDER_MESSAGE',
	'FORUM_MAIN',
	'NEW_POSTS_CONTENT'
);

$mb->sets['terms'] = 0;

$add_permission['post_counting'] = true;
$add_permission['view_invisible_users'] = false;
$add_permission['topic_publish'] = false;
$add_permission['topic_publish_auto'] = true;
$add_permission['topic_view_unpublished'] = false;
$add_permission['topic_rate'] = true;
$add_permission['edit_avatar'] = true;
$add_permission['edit_profile'] = true;
$add_permission['forum_subscribe'] = true;


$queries[] = "DROP TABLE IF EXISTS {$pre}rates";
$queries[] = "CREATE TABLE {$pre}rates (
  rate_user int(10) NOT NULL default '0',
  rate_topic int(10) NOT NULL default '0',
  rate_rated tinyint(3) unsigned NOT NULL default '0'
) TYPE=MyISAM";

$queries[] = "ALTER TABLE {$pre}settings ADD settings_term text NOT NULL AFTER settings_id";
$queries[] = "UPDATE {$pre}topics SET topic_modes=topic_modes | " . TOPIC_PUBLISH; // Make all topics published
$queries[] = "ALTER TABLE {$pre}topics ADD topic_rate tinyint(3) unsigned NOT NULL default '0' AFTER topic_poll_options";

?>