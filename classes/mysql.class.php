<?php
class mysql {
	private $Connect;
	
	public function __construct($Host, $Username, $Password, $Database) {
		$this->Connect = mysql_connect($Host, $Username, $Password) or
			die('<strong>Verbindung nicht möglich</strong>:<br><br>'.mysql_error());
		
		mysql_select_db($Database, $this->Connect) or
			die('<strong>Kann die Datenbank "'.$Database.'" nicht benutzen</strong>:<br><br>'.mysql_error());
	}
	
	public function Disconnect() {
		if(is_resource($this->Connect))				
        	mysql_close($this->Connect);
	}
	
	public function DoQuery($Query) {
		$Result = mysql_query($Query, $this->Connect);
		//mysql_num_rows($result);
		if($Result) {
			$Fetch;
			while($Row = mysql_fetch_object($Result))
				$Fetch[] = $Row;
			return $Fetch;
		}
	}	
}
?>