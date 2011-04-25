<?php
/**
 * @author		SilexBoard Team
 *					Angus
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ./');

self::$TPL->Assign('Username', 'test' /*login::GetUsername(session::read('userid'))*/);
?>