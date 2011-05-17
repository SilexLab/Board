<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

crumb::Add('Forum', '?page=Forum');

self::$TPL->Assign('Content', view::DisplayTopics($_GET['TopicID']));

self::$TPL->Assign('Site', self::$TPL->GetVar('Site').' - '.view::$BoardTitle);
?>