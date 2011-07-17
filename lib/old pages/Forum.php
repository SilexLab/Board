<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 3
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

// Übergeordnete Seite
page::$Info['Site'] = 'Forum';

// Die Variable {$Content} aus body.tpl mit einer Templatevariable ersetzen
crumb::Add('Forum', '?page=Forum');
self::$TPL->Assign('Site', self::$TPL->GetVar('Site').' - Index');
self::$TPL->Assign('Content', view::DisplayOverview());
?>