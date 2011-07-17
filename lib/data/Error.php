<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

$error = $_GET['type'];
if(isset($error))
{
	switch($error) {
		case '404':	$message = ('Error 404. Page Not found.'); break;
		case '403':	$message = ('Error 403. Access Denied'); break;
	}
}
else
$message = ('Error 404. Page Not found.');
Template::Assign(array('Page' => 'Error', 'Content' => $message));
?>