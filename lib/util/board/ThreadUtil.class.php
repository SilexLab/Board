<?php
/**
 * @author     Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class ThreadUtil {

	/**
	 * Grab breadcrumbs for this thread
	 * @param Thread $Thread
	 * @return array
	 */
	public static function GetBreadcrumbs(Thread $Thread) {

		// Crumbs of the board
		$Crumbs = BoardUtil::GetBreadcrumbs($Thread->GetBoard());
		$Crumbs[] = array('title' => $Thread->GetTopic(), 'link' => $Thread->GetLink());
		return $Crumbs;

	}

}

?>