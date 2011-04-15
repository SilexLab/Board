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

mysql::Select('categories');
$Cat = array();
while($res = mysql::FetchObject())
	$Cat[] = $res;

$ret = '';
if(empty($Cat))
	$ret = '{lang=com.sbb.forum_overview.empty}';

foreach($Cat as $Category) {
	$ret .= $Category->CategoryName.'<br>'."\n".
		$Category->Description.'<br>';
	
	mysql::Select('forums', '*', 'Category = '.$Category->ID);
	while($Forum = mysql::FetchObject()) {
		$ret .= '- - '.$Forum->ForumName;
	}
	$ret .= "\n".'<br><br>'."\n";
} $ret = trim($ret, "\n".'<br><br>'."\n");
self::$TPL->Assign('ForumOverview', $ret);
?>