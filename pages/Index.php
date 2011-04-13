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

mysql::Select('categories');
$Cat = array();
while($res = mysql::FetchObject())
	$Cat[] = $res;
foreach($Cat as $Category) {
	echo $Category->CategoryName.'<br>';
	echo $Category->Description.'<br>';
	
	mysql::Select('forums', '*', 'Category = '.$Category->ID);
	while($Forum = mysql::FetchObject()) {
		echo '- - '.$Forum->ForumName;
	}
	echo '<br><br>';
}
?>