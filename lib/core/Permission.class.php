<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Permission {
	private $Permissions;
	private $Index;

	public function __construct($UserID, $GroupID) {
		$UserID = (int)$UserID;
		$GroupID = (int)$GroupID;

		/* Default permissions */
		$Statement = SBB::DB()->query('SELECT `ID`, `PermissionNode`, `Type`, `DefaultValue` FROM `permissions`');
		foreach($Statement->fetchAll(PDO::FETCH_OBJ) as $Perm) {
			$this->Permissions[$Perm->PermissionNode] = ['value' => $Perm->DefaultValue, 'type' => $Perm->Type];
			$this->Index[$Perm->ID] = $Perm->PermissionNode;
		}

		/* Group permissions */
		$Statement = SBB::DB()->prepare('SELECT `PermissionID`, `PermissionValue` FROM `group_permissions` WHERE `GroupID` = :GroupID');
		$Statement->execute([':GroupID' => $GroupID]);
		foreach($Statement->fetchAll(PDO::FETCH_OBJ) as $P) {
			if(isset($this->Index[$P->PermissionID])) {
				$this->Permissions[$this->Index[$P->PermissionID]]['value'] = $P->PermissionValue;
			}
		}

		/* User permissions */
		$Statement = SBB::DB()->prepare('SELECT `PermissionID`, `PermissionValue` FROM `group_permissions` WHERE `UserID` = :UserID');
		$Statement->execute([':UserID' => $UserID]);
		foreach($Statement->fetchAll(PDO::FETCH_OBJ) as $P) {
			if(isset($this->Index[$P->PermissionID])) {
				$this->Permissions[$this->Index[$P->PermissionID]]['value'] = $P->PermissionValue;
			}
		}

		$this->CastTypes();
	}

	public function Get($Node) {
		return isset($this->Permissions[$Node]) ? $this->Permissions[$Node]['value'] : null;
	}

	private function CastTypes() {
		foreach($this->Permissions as $Node => $Perm) {
			switch($Perm['type']) {
				case 'bool':
					$this->Permissions[$Node]['value'] = (bool)$Perm['value'];
					break;
				default:
					$this->Permissions[$Node]['value'] = (int)$Perm['value'];
			}
		}
	}
}
