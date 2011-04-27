<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

// Die Variable {$Content} aus body.tpl mit einer Templatevariable ersetzen
self::$TPL->Assign('Content', '{$:page_index}');
self::$TPL->Assign('Site', self::$TPL->GetVar('Site').' - Index');
crumb::Add('Forum', './');

self::$TPL->Assign('ForumOverview', view::DisplayBoard());
?>