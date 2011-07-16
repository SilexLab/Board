<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class permission {
	/**
	 * Abgefragtes Zugriffsrecht wird über den $Permissions Parameter
	 * übergeben. Zurückgegeben wird true, wenn der Zugriff erlaubt ist
	 * und false, falls der Zugriff nicht erlaubt ist.
	 * Als Optionaler Parameter kann die ID von zum Beispiel einem Forum
	 * übergeben werden.
	 *
	 * Beispiel: permission::Check('see.forum', 3); oder um auf alle Foren
	 * bezug zu nehmen: permission::Check('see.forums');
	 */
	public static function Check($Permission, $ID = -1) {
		return true;
	}
}
?>