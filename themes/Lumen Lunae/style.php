<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

$time = microtime(true);
define('endl', "\n");

/* Variables */
// Input strings
$p = ''; // current page
$a = ''; // current actions

// Static style sheets
$s = ['style.css', 'header.css', 'footer.css', 'crumbs.css', 'notification.css', 'button.css'];

// Dynamic style sheets
$d = [
'page' => [
	'Board'    => 'board.css',
	'Thread'   => 'post.css',
	'Register' => 'register.css',
	'User'     => 'user.css',
	'UserList' => 'user.css'
],
'action' => []
];

/* Processing input */
if(isset($_GET['p'])) $p = $_GET['p'];
if(isset($_GET['a'])) $a = $_GET['a'];

/* Processing output */
$output = '@charset "utf-8";'.endl;
foreach ($s as $style) {
	$output .= '/* --- '.$style.' --- */'.endl
	.file_get_contents($style).endl.endl;
}
if($p && isset($d['page'][$p])) {
	$styles = (array)$d['page'][$p];
	foreach ($styles as $style) {
		$output .= '/* --- '.$style.' --- */'.endl
		.file_get_contents($style).endl.endl;
	}
}

// Design test page
if($p == 'Design') {
	foreach ($d['page'] as $style) {
		$output .= '/* --- '.$style.' --- */'.endl
		.file_get_contents($style).endl.endl;
	}
}

/* Set the content type to css */
header('Content-Type: text/css; charset=UTF-8');

/* Display the collected stylesheets */
echo $output;

/* Generated time */
echo '/* CSS generated in '.((microtime(true) - $time) * 1000).' ms */';
?>