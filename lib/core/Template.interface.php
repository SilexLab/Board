<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface TemplateInterface {
	/**
	 * Create a new Templateobject
	 */
	public function __construct($TPLPath    = '',
								$Cache      = '',
								$Debug      = true,
								$Charset    = 'utf-8',
								$AutoReload = true,
								$Autoescape = false);
	
	/**
	 * Translate a given templatevariable into a normal string if it exists
	 */
	public function Get($Key);
	
	/**
	 * Assigns new Variables to the template
	 */
	public function Assign(array $Variables);
	
	/**
	 * Assigns new Languagestrings to the template
	 */
	public function AssignLanguage(array $Variables);
	
	/**
	 * Renders the template and return it
	 * @return string
	 */
	public function Render($Template);
	
	/**
	 * Renders the template and display it
	 */
	public function Display($Template);
}
?>