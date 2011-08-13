<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface TemplateInterface {
	public static function Initial();
	public static function Assign($Vars);
	public static function AssignLanguage($Vars);
	public static function Render($Template);
	public static function Display($Template);
}
?>