<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * global shorthand functions
 */


/* FILESYSTEM */

/**
 * recursively scandir
 * @param  string $directory
 * @param  int    $sorting_order
 * @return array
 */
function scandirr($directory, $sorting_order = 0) {
	$files = scandir($directory, $sorting_order);
	if(strpos($directory, '/', strlen($directory) - 1) === false)
		$directory .= '/';
	
	$rfiles = [];
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
 * recursively remove a directory
 * @param string $dir
 */
function rrmdir($dir) {
	foreach(glob($dir.'/*') as $file) {
		if(is_dir($file))
			rrmdir($file);
		else
			unlink($file);
	}
	rmdir($dir);
}

/**
 * Get the file extension
 */
function file_ext($file) {
	return pathinfo($file, PATHINFO_EXTENSION);
}


/* ARRAYS */

/**
 * Searches the array for a given value and returns the corresponding key(s) if successful
 * @param  mixed $needle
 * @param  array $haystack
 * @param  bool  $strict = false
 * @return mixed
 */
function array_search_all($needle, array $haystack, $strict = false) {
	$founds = [];
	foreach($haystack as $key => $value) {
		if(!$strict && $value == $needle)
			$founds[] = $key;
		else if($strict && $value === $needle)
			$founds[] = $key;
	}
	return empty($founds) ? false : $founds;
}


/* MATH */

/**
 * clamp the value
 * @param  mixed $value
 * @param  mixed $min_value
 * @param  mixed $max_value
 * @return mixed
 */
function clamp($value, $min, $max) { return max(min($value, $max), $min); }


/* STRINGS */

function strfind($haystack, $needle) { return strpos($haystack, $needle) !== false; }

function urlencode_slashes($url) {
	$scheme = '';
	if(preg_match('/^(?<scheme>[a-z][a-z0-9+\-.]*):/ix', $url, $m)) {
		$scheme = $m[0].'//';
		$url = substr($url, strlen($scheme));
	}
	$new_url = '';
	$e = explode('/', $url);
	for($i = 0; $i < sizeof($e); $i++)
		$new_url .= urlencode($e[$i]).(($i < sizeof($e) - 1) ? '/' : '');
	return $scheme.$new_url;
}

function rawurlencode_slashes($url) {
	$scheme = '';
	if(preg_match('/^(?<scheme>[a-z][a-z0-9+\-.]*):/ix', $url, $m)) {
		$scheme = $m[0].'//';
		$url = substr($url, strlen($scheme));
	}
	$new_url = '';
	$e = explode('/', $url);
	for($i = 0; $i < sizeof($e); $i++)
		$new_url .= rawurlencode($e[$i]).(($i < sizeof($e) - 1) ? '/' : '');
	return $scheme.$new_url;
}
