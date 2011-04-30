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
crumb::Add('Forum', '?page=Forum');
self::$TPL->Assign('Site', self::$TPL->GetVar('Site').' - Index');
self::$TPL->Assign('Content', view::DisplayOverview());
?>