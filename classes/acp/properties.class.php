<?php 
	class helper {
		
		public $check = false;
		
		public function __construct() {
			$sql = new mysqlQuery;
			if($sql->NumRows($sql->Select('config')) != 0) { 
				$this->check = true;
			}
		}
		
		public function set_titel($titel) {			
			$sql = new mysqlQuery;
			$inserts = array("ConfigName" => 'Site',
							"ConfigValue" => $titel);
			$sql->Insert('config', $inserts);
		}
		
		public function change_titel($titel) {
			if($this->check == true) {
				$sql = new mysqlQuery;
				$update = array("ConfigValue" => $titel);
				$sql->Update('config', $update, 'ConfigName=Site');
			}
		}
		
		/*
			Im Backend: wenn checking() == false, dann soll set_titel ausgeführt werden
 						wenn checking() == true, dann soll change_titel ausgeführt werden
		 */
		public function checking() {
			return $this->check;
		}
	}
?>