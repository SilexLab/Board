<?php
class MySQLiWrapper {
	const READ   = 0;
	const INSERT = 1;
	const UPDATE = 2;
	const DELETE = 3;
	const EXISTS = 4;
	
	// Options
	/*const O_MODE   = 0;
	const O_TABLE  = 1;
	const O_ROWS   = 2;
	const O_INSERT = 3;
	const O_UPDATE = 4;
	const O_WHERE  = 5;
	const O_ORDER  = 6;
	const O_LIMIT  = 7;*/
	
	// Database connection
	private $Database;
	
	public function __construct($Host, $User, $Password, $Database, $Port = NULL, $Socket = NULL) {
		if(!empty($this->Database))
			return false;
		
		$this->Database = new MySQLi($Host, $User, $Password, $Database, $Port, $Socket);
		if($this->Database->connect_errno)
			return false;
		return true;
	}
	
	public function Disconnect() {
		$this->Database->close();
	}
	
	// Database handle
	
	/*
		Read => Rows, Where, Order, Limit
		Insert => /
		Update => Where
		Delete => Where
		Exists => Where
	*/
	private $Data = array(), $Package = array();
	
	public function Table($Table) {
		$this->Pack('TABLE', $Table);
		return $this;
	}
	
	public function Read($Rows) {
		$this->Pack('MODE', self::READ);
		$this->Pack('ROWS', $Rows);
		return $this;
	}
	
	public function Insert(array $Inserts) {
		$this->Pack('MODE', self::INSERT);
		$this->Pack('INSERT', $Inserts);
		return $this;
	}
	
	public function Update(array $Updates) {
		$this->Pack('MODE', self::UPDATE);
		$this->Pack('UPDATE', $Updates);
		return $this;
	}
	
	public function Delete() {
		$this->Pack('MODE', self::DELETE);
		return $this;
	}
	
	public function Exists() {
		$this->Pack('MODE', self::EXISTS);
		return $this;
	}
	
	public function Where($Where, $Operator, $Value) {
		$this->Pack('WHERE', array($Where, $Operator, $Value));
		return $this;
	}
	
	public function OrderBy($Order) {
		$this->Pack('ORDER', $Order);
		return $this;
	}
	
	public function Limit($Limit) {
		$this->Pack('LIMIT', $Limit);
		return $this;
	}
	
	public function Execute() {
		$this->Put();
		
		if(sizeof($this->Data) > 1) { // Multiquery
			// <Awesome code>
		} else if(sizeof($this->Data) == 1) { // Singequery
			// <Awesome code>
		} else
			return false;
		
		return true;
	}
	
	// Pack values
	private function Pack($Option, $Value) {
		if($Option == 'MODE' || $Option == 'TABLE') {
				$this->Put($Option != 'TABLE' && isset($this->Package['TABLE']) ? array('TABLE') : NULL);
		}
		$this->Package[$Option] = $Value;
	}
	
	// Put ready values into the array
	private function Put(array $Keep = NULL) {
		if(empty($this->Package))
			return false;
		
		$this->Data[] = $this->Package;
		
		if(!$Keep) {
			$this->Package = NULL;
		} else {
			$Options;
			foreach($Keep as $Option) {
				if(isset($this->Package[$Option]))
					$Options[$Option] = $this->Package[$Option];
			}
			$this->Package = NULL;
			$this->Package = $Options;
		}
	}
}
?>