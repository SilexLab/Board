<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

interface LanguageInterface {
	public function Get($Key);
	public function Assign();
	public function GetLanguages();
	public static function ChangeLang($File);
}
?>