<?php
/**
 * @author      Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class BoardUtil {
	/**
	 * Grab breadcrumbs for this board
	 * @param Board $Board
	 * @return array
	 */
	public static function GetBreadcrumbs(Board $Board) {
		$Crumbs = [];
		if($Board->GetParentBoard() !== false)
			$Crumbs = self::GetBreadcrumbs($Board->GetParentBoard());
		$Crumbs[] = ['title' => $Board->GetTitle(), 'link' => $Board->GetLink()];
		return $Crumbs;
	}
}
