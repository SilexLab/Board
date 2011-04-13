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
			switch($this->check) {
				case false:
					$sql 		= 	new mysqlQuery;
					$inserts	= 	array("ConfigName" => 'Site',
									"ConfigValue" => $titel);
					$sql->Insert('config', $inserts);
				break;
				
				case true:
					$sql 		= 	new mysqlQuery;
					$update 	= 	array("ConfigValue" => $titel);
					$sql->Update('config', $update, 'ConfigName=Site');
				break;
				
				default:
					exit;
				break;	
			}
		}
	}
?>