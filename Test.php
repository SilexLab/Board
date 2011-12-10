<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>MySQLi Tests</title>
</head>

<body>
<pre>
<?php
include('lib/core/exception/DatabaseException.class.php');
include('lib/core/database/Database.class.php');
include('lib/core/database/SQL.class.php');
include('lib/core/database/MySQLiWrapper.class.php');
$SQL = new MySQLiWrapper('localhost', '', '', 'test');

echo "\n".'Exists:'."\n";
$SQL->Table('exists')->Exists()->Where('`ID` = 1')->Execute();

echo "\n".'Select:'."\n";
print_r($SQL->Table('improved')->Select('*')->Where('`ID` < 4')->Execute()->FetchObjects());

//$SQL->Table('exists')->Exists()->Where('`ID` = 2');
//$SQL->Select('*')->Where('`ID` = 1')->OrderBy('Wert');
//$SQL->Table('improved')->Insert(array('Name' => 'Dein Name', 'Wohnort' => 'Blub', 'Beruf' => 'Bauarbeiter'));
//$SQL->Execute();

//$SQL->Table('improved')->Insert(array('Name' => 'Dein Name', 'Wohnort' => 'Blub', 'Beruf' => 'Bauarbeiter'))->Execute();
?>
</pre>
</body>
</html>