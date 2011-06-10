<?php
$FolderBase = $_SERVER['SCRIPT_NAME'];
$FolderBase = explode(basename($_SERVER['PHP_SELF']),$_SERVER['PHP_SELF']);
$FolderBase = $FolderBase[0];

$Handle = fopen('.htaccess','w');
fwrite($Handle,'ErrorDocument 404 '.$FolderBase.'index.php?page=Error&type=404'."\n");
fwrite($Handle,'ErrorDocument 403 '.$FolderBase.'index.php?page=Error&type=403'."\n");
fwrite($Handle,'Allow from all');
fclose($Handle);
?>
<pre>
<?php echo file_get_contents('.htaccess'); ?>
</pre>
Es m&uuml;sste nun alles in Ordnung sein. Falls es falsch ist, wird ein Error 500(Internal Server Error) ausgeworfen. Einfach <b>.htaccess</b> l&ouml;schen und Skript nochmal aufrufen, falls es immer noch nicht stimmt, Versuch es manuell.