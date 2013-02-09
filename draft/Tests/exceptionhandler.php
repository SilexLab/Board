<?php
class Testexception extends Exception {
	public function __construct() {
	}
}

class TestClass {
	public function __construct() {
		set_exception_handler(array('TestClass', 'ExceptionHandler'));
	}
	
	public static function ExceptionHandler(Exception $e) {
		echo 'Exception ausgelöst: '.$e->getMessage();
	}
}

new TestClass();

throw new TestException('Testexception');
?>