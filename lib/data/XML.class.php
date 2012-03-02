<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class XML {
	protected $XMLObj = NULL;
	
	/**
	 * Creates a new SimpleXML object
	 * If the given $File is a XML String, set the optional parameter to true
	 * @param	string  $File
	 * @param	bool    $String = false
	 */
	public function __construct($File, $String = false) {
		if($String)
			$this->LoadString($File);
		else
			$this->LoadFile($File);
	}
	
	/**
	 * Parses a string of XML data
	 * @param	string	$String
	 */
	public function LoadString($String) {
		$this->XMLObj = simplexml_load_string($String);
		if(!$this->XMLObj)
			throw new SystemException('the given string isn\'t a valid XML source');
	}
	
	/**
	 * Loads and parses a XML file
	 * @param	string	$FileName
	 */
	public function LoadFile($FileName) {
		$this->XMLObj = simplexml_load_file($FileName);
		if(!$this->XMLObj)
			throw new SystemException('the file \''.$FileName.'\' isn\'t a valid XML file');
	}
	
	/**
	 * Sends a xpath query
	 * Wrapper for SimpleXMLElement::xpath();
	 */
	public function XPath($Path) {
		return $this->XMLObj->xpath($Path);
	}
	
	/**
	 * Returns an array of all elements of a SimpleXML object
	 * @param	string              $Name
	 * @param	SimpleXMLElement    $XMLObj = NULL
	 */
	public function GetTree($Name, SimpleXMLElement $XMLObj = NULL) {
		if(!$XMLObj)
			$XMLObj = $this->XMLObj;
		
		$Tree = array(
			'name' => $Name,
			'attributes' => $this->GetAttributes($XMLObj),
			'cdata' => $this->GetCDATA($XMLObj),
			'children' => $this->GetChildren($XMLObj, true)
		);
		
		return $Tree;
	}
	
	/**
	 * Returns an associative array with all attributes of an SimpleXML element
	 * @param	SimpleXMLElement	$XMLObj = NULL
	 */
	public function GetAttributes(SimpleXMLElement $XMLObj = NULL) {
		if(!$XMLObj)
			$XMLObj = $this->XMLObj;
		
		$Attributes = array();
		foreach($XMLObj->attributes() as $Key => $Value) {
			$Attributes[$Key] = (string)$Value;
		}
		return $Attributes;
	}
	
	/**
	 * Returns the CDATA of a SimpleXML element
	 * @param	SimpleXMLElement	$XMLObj = NULL
	 */
	public function GetCDATA(SimpleXMLElement $XMLObj = NULL) {
		if(!$XMLObj)
			$XMLObj = $this->XMLObj;
		
		return (string)trim($XMLObj);
	}
	
	/**
	 * Returns the children of a SimpleXML element
	 * @param	SimpleXMLElement    $XMLObj = NULL
	 * @param	bool                $Recursive = false
	 */
	public function GetChildren(SimpleXMLElement $XMLObj = NULL, $Recursive = false) {
		if(!$XMLObj)
			$XMLObj = $this->XMLObj;
		
		$Children = array();
		foreach($XMLObj->children() as $Key => $ChildObj) {
			if($Recursive)
				$Children[] = $this->GetTree($Key, $ChildObj);
			else
				$Children[] = $ChildObj; 
		}
		return $Children;
	}
}
?>