<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

$message = $parser->parse('[b]Hi Nox[/b] (h)');
self::$TPL->Assign('message', $message);
?>