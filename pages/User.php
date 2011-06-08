<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 4
 */

// Schutz vor Direktaufruf der Datei
if(!defined('SILEX_VERSION'))
	header('location: ../');

// Übergeordnete Seite
global $gPage;
$gPage['Site'] = 'User';

$Parser = new messageParser();
$Language = new language();

$content = '';
crumb::Add('{lang=com.sbb.crumbs.user}', '?page=User');

if(isset($_GET['userID'])) {
    mysql::Select('users', '*', 'ID = \''.$_GET['userID'].'\'', 1);
    if(mysql::NumRows() == 1) {
        $Row = mysql::FetchObject();
        $Content .= '<h2>'.$Row->UserName.'</h2>'."\n";
        $Avatar = new avatar($Row->Email, 100);
        $Content .= $Avatar.'<br>'."\n";
        $Content .= 'Registriert seit: '.date('d.m.Y H:i', $Row->RegisterTime); // TODO: Languagestring
        if(!empty($row->Homepage)) {
            $Content .= '<br>'."\n".'<a href="'.(strpos($Row->Homepage, 'http://') === false ? 'http://' : '').$Row->Homepage.'">'.$Row->Homepage.'</a><br>'."\n";
        }
        if(!empty($row->Signatur)) {
            $Content .= $parser->parse($Row->Signatur);
        }
        crumb::Add($Row->UserName, '?page=User&amp;userID='.$_GET['userID']);
    }
    else {
        $Content .= 'Benutzer nicht gefunden!'; // TODO: Languagestring
    }
}
else {
    mysql::Select('users', '*');
    if(mysql::NumRows() > 0) {
        while($Row = mysql::FetchObject()) {
            $Avatar = new avatar($Row->Email, 50);
            $Content .= '<p>'.$Avatar.' <a href="?page=User&amp;userID='.$Row->ID.'">'.$Row->UserName.'</a> Registriert seit: '.date('d.m.Y H:i', $Row->RegisterTime)."</p>\n";
        }
    }
    else {
        $Content .= 'Keine Benutzer gefunden!'; // TODO: Languagestring
    }
}
self::$TPL->Assign(array('Site' => 'UserList', 'Content' => $Content));
?>