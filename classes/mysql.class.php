<?php
/**
 * @author		SilexBoard Team
 *					Nut, Nox Nebula, Cadillaxx
 * @copyright	2011 SilexBoard
 */

class mysql{
	protected $Host, $Username, $Password, $Database;
	
	public function __construct($Host, $Username, $Password, $Database) {		
		$this->Host = $Host;
		$this->Username = $Username;
		$this->Password = $Password;
		$this->Database = $Database;
    
		$this->connect();
		$this->selectDB();
	}
	protected function connect() {
		$connect = @mysql_connect($this->Host, $this->Username, $this->Password);
		if(!$connect) {
			$error = "<h2>Fatal Error:</h2>\n"
					."	<b>Couldn't connect to the MySQL-User '".$this->Username."'!</b><br />\n"
					."	<b>Errorcode</b>: ".mysql_errno()."<br />\n"
					."	<b>Error</b>: ".mysql_error()."<br />\n"
					."	<b>Site</b>: ".(isset($_SERVER['REQUEST_URI'])  && !empty($_SERVER['REQUEST_URI'])  ? htmlentities($_SERVER['REQUEST_URI']) : "-")."<br />\n"
					."	<b>Referrer</b>: ".(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? htmlentities($_SERVER['HTTP_REFERER']) : "-")."<br />\n"
					."</div>\n";
			die($error);	
		}
		return true;
	}
	protected function selectDB() {
		$select = @mysql_select_db($this->Database);
		if(!$select) {
			$error = "<h2 style=\"display:block;\">Fatal Error:</h2>\n"
					."	<b>Can't find database <b>".$this->Database."</b>!</b><br />\n"
					."	<b>Errorcode</b>: ".mysql_errno()."<br />\n"
					."	<b>Error</b>: ".mysql_error()."<br />\n"
					."	<b>Site</b>: ".(isset($_SERVER['REQUEST_URI'])  && !empty($_SERVER['REQUEST_URI'])  ? htmlentities($_SERVER['REQUEST_URI']) : "-")."<br />\n"
					."	<b>Referrer</b>: ".(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? htmlentities($_SERVER['HTTP_REFERER']) : "-")."<br />\n"
					."</div>\n";
			die($error);
		}
		return true;
	}
}

?>