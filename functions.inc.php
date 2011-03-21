<?php
function IncludeClasses() {
	$dir = opendir(PATH_CLASS);
	while($file = readdir($dir))
		if(strpos($file, '.class.php') !== false && ($file != '.' || $file != '..'))
			include_once(PATH_CLASS.$file);
	closedir($dir);
}
?>