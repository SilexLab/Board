<?php
function __autoload($className) {
	include_once(PATH_CLASS.$className.'.class.php');
}
?>