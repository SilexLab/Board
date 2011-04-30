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

self::$TPL->Assign('Content', view::DisplayBoard($_GET['BoardID']));

self::$TPL->Assign('Site', self::$TPL->GetVar('Site').' - '.view::$BoardTitle);
?>