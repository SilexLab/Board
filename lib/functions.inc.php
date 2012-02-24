<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * recursive scandir
 */
function scandirr($directory, $sorting_order = 0) {
	$files = scandir($directory, $sorting_order);
	if(strpos($directory, '/', strlen($directory) - 1) === false)
		$directory .= '/';
	
	$rfiles = array();
	foreach($files as $f) {
		if(($f === '.' || $f === '..') && is_dir($directory.$f))
			continue;
		if(is_dir($directory.$f)) {
			$rf = scandirr($directory.$f, $sorting_order);
			for($i = 0; $i < sizeof($rf); $i++)
				$rfiles[] = $f.'/'.$rf[$i];
		}
		else
			$rfiles[] = $f;
	}
	return $rfiles;
}

/**
 * Returns the yearprocess in percent
 */
function GetYearProcess() {
	$Start = mktime(0, 0, 0, 1, 1, date('Y'));
	$Current = time();
	$ToDay = 60 * 60 * 24;
	
	$DayOfTheYear = ($Current - $Start) / $ToDay;
	$DaysOfTheYear = (mktime(0, 0, 0, 1, 1, date('Y') + 1) - $Start) / $ToDay;
	
	return $DayOfTheYear / $DaysOfTheYear;
}

// Shortcut functions
function EscapeString($String) { return SBB::DB()->EscapeString($String); }
?>