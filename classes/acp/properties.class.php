<?php 
/**
 * @author 		Nut
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

	class helper {
		
		public $check = false;
		
		public function __construct() {
			$sql = new mysql;
			if($sql->NumRows($sql->Select('config')) != 0) { 
				$this->check = true;
			}
		}
		
		public function set_titel($titel) {	
			switch($this->check) {
				case false:
					$sql 		= 	new mysql;
					$inserts	= 	array("ConfigName" => 'Site',
									"ConfigValue" => $titel);
					$sql->Insert('config', $inserts);
				break;
				
				case true:
					$sql 		= 	new mysql;
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