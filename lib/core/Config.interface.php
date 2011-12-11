<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface ConfigInterface {
	/**
	 * Get the config from the config-table
	 */
	public function __construct();
	
	/**
	 * Return the configvalue for a config-node
	 */
	public function Get($Node);
	
	/**
	 * Return the template vars
	 */
	public static function GetTemplateVariables();
}
?>