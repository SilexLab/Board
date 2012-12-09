<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Group {
	protected $ID;
	protected $Name;
	protected $Image;
	protected $Color;
	protected $Icon;

	/**
	 * Get information about the group
	 * @param int $GroupID
	 */
	public function __construct($GroupID) {
		$GroupID = (int)$GroupID;
		// fetch from database
		$Statement = SBB::DB()->prepare('SELECT * FROM `groups` WHERE `ID` = :GroupID');
		$Statement->execute([':GroupID' => $GroupID]);
		if(!$Statement) {
			throw new DatabaseException('The group with ID '.$GroupID.' can\'t be fetched.');
		}
		$GroupInfo = $Statement->fetch(PDO::FETCH_OBJ);
		$this->ID = (int)$GroupID;
		$this->Name = $GroupInfo->GroupName;
		$this->Image = $GroupInfo->Image;
		$this->Color = $GroupInfo->Color;
		$this->Icon = $GroupInfo->Icon;
	}

	/**
	 * Get the group id
	 * @return int
	 */
	public function ID() {
		return $this->ID;
	}

	/**
	 * Get the name of the group
	 * @return string
	 */
	public function Name() {
		return $this->Name;
	}
}
