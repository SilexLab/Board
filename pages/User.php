<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

$parser = new messageParser();
$language = new language();
$tpl = new template('head', 'page_user', 'footer');
$content = '';

if(isset($_GET['userID'])) {
    mysql::Select('users', '*', 'ID = \''.$_GET['userID'].'\'', 1);
    if(mysql::NumRows() == 1) {
        $row = mysql::FetchObject();
        $content .= "<h2>".$row->UserName."</h2>\n";
        $avatar = new avatar($row->Email, 100);
        $content .= $avatar."<br>\n";
        $content .= "Registriert seit: ".date('d.m.Y H:i', $row->RegisterTime);
        if(!empty($row->Homepage)) {
            $content .= "<br>\n<a href=\"".(strpos($row->Homepage, 'http://') === false ? 'http://' : '').$row->Homepage."\">".$row->Homepage."</a><br>\n";
        }
        if(!empty($row->Signatur)) {
            $parser = new messageParser;
            $content .= $parser->parse($row->Signatur, 1, 1);
        }
    }
    else {
        $content .= "Benutzer nicht gefunden!";
    }
}
else {
    mysql::Select('users', '*');
    while($row = mysql::FetchObject()) {
        $content .= "<a href=\"?page=User&userID=".$row->ID."\">".$row->UserName."</a><br>\n";
    }
}
self::$TPL->Assign(array('Site' => 'Seitentitel',
        'Content' => $content));
?>