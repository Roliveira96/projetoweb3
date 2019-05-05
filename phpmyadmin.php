<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
* Main loader script
*
* @package PhpMyAdmin
*/

/**
* Gets some core libraries and displays a top message if required
*/
require_once 'libraries/common.inc.php';

/**
* display Git revision if requested
*/
require_once 'libraries/display_git_revision.lib.php';
require_once 'libraries/Template.class.php';

/**
* pass variables to child pages
*/
$drops = array(
'lang',
'server',
'collation_connection',
'db',
'table'
