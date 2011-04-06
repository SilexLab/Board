<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

include_once('init.php');

$parser = new messageParser();
$language = new language();
$tpl = new template('head', 'user', 'footer');

if(isset($_GET['userID'])) {
    $sql = new mysqlQuery;
    $sql->Select('users', '*', 'ID = \''.$_GET['userID'].'\'', 1);
    if($sql->NumRows() == 1) {
        $row = $sql->FetchArray();
        echo "<h2>".$row['UserName']."</h2>\n";
        $avatar = new avatar($row['Email'], 100);
        echo $avatar."<br>\n";
        echo "Registriert seit: ".date('d.m.Y', $row['RegisterTime']);
        if(!empty($row['Homepage'])) {
            echo "<br>\n<a href=\"".(strpos($row['Homepage'], 'http://') === false ? 'http://' : '').$row['Homepage']."\">".$row['Homepage']."</a><br>\n";
        }
        if(!empty($row['Signatur'])) {
            $parser = new messageParser;
            echo $parser->parse($row['Signatur'], 1, 1);
        }
    }
    else {
        echo "Benutzer nicht gefunden!";
    }
}
else {
    $sql = new mysqlQuery;
    $sql->Select('users', '*');
    while($row = $sql->FetchArray()) {
        echo "<a href=\"user.php?userID=".$row['ID']."\">".$row['UserName']."</a><br>\n";
    }
}

$tpl->Assign(array('Site' => 'Seitentitel'));

$language->Assign($tpl);
$tpl->Display(false, false);
?>