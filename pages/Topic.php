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

crumb::Add('Forum', '?page=Forum');

self::$TPL->Assign('Content', view::DisplayTopics($_GET['TopicID']));

self::$TPL->Assign('Site', self::$TPL->GetVar('Site').' - '.view::$BoardTitle);
?>