<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

$parser = new messageParser();
$message = $parser->parse('hier sollte eine fehlermeldung stehen');
self::$TPL->Assign('message', $message);
?>