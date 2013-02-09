<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * A simple wrapper for SimpleXML
 */
class XML {
	protected $XMLObj;

	/**
	 * Create a new SimpleXML object
	 * @param   string  $XML
	 * @param   bool    $IsString   optional
	 */
	public function __construct($XML, $IsString = false) {
		if($IsString)
			$this->XMLObj = simplexml_load_string($XML);
		else
			$this->XMLObj = simplexml_load_file($XML);

		if(!$this->XMLObj)
			throw new SystemException('Failed to load XML');
	}

	/**
	 * Return the SimpleXML object
	 * @return  SimpleXMLElement
	 */
	public function __get($Name) {
		return $this->XMLObj->{$Name};
	}
	public function __call($Name, $Arguments) {
		//return $this->XMLObj->{$Name}($Arguments[0]);
		return call_user_func_array([$this, $Name], $Arguments); // quite slower than above but has all arguments
	}

	/**
	 * Converts the XML object structure into an array
	 * @param   SimpleXMLElement    $XML    optional
	 * @return  array
	 */
	public function ToArray(SimpleXMLElement $XML = null) {
		if(!$XML)
			$XML = $this->XMLObj;
		return json_decode(json_encode($XML), true);
	}
}
