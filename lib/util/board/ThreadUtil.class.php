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

	public static function Create($Topic, $BoardId, $ThreadId, $UserId, $Message, $IpAddress, $Smileys, $Html, $SilexCode) {

		// Create first post first
		$FirstPost = PostUtil::Create($ThreadId, $UserId, $Message, $IpAddress, $Smileys, $Html, $SilexCode);

		if(!$FirstPost)
			return false;

		$Row = [
			'ThreadID'     => $ThreadId,
			'UserID'       => $UserId,
			'Message'      => $Message,
			'Time'         => time(),
			'LastEdit'     => '0',
			'EditorID'     => '0',
			'PollID'       => '0',
			'IPAddress'    => $IpAddress,
			'Disabled'     => '0',
			'Deleted'      => '0',
			'DeleteReason' => '',
			'DeleteTime'   => '0',
			'Smileys'      => ($Smileys ? '1' : '0'),
			'HTML'         => ($Html ? '1' : '0'),
			'SilexCode'    => ($SilexCode ? '1' : '0'),
		];

		// Write the row in the DB
		$Query = 'INSERT INTO `post` ';

		$Columns = '(';
		$Values = 'VALUES(';

		// Arguments for the statementv
		$Args = [];

		$i = 1;
		foreach($Row as $Column => $Value) {

			$Columns .= '`'.$Column.'`';
			$Values  .= ':'.$Column;

			if($i++ != count($Row)) {
				$Columns .= ', ';
				$Values  .= ', ';
			}

			// Arguments for the statement
			$Args[':'.$Column] = $Value;

		}

		$Columns .= ') ';
		$Values  .= ')';

		$Query .= $Columns.$Values;

		$Stmt = SBB::DB()->prepare($Query);

		if($Stmt->execute($Args) === false)
			return false;

		// Get ID
		$Row['ID'] = SBB::DB()->lastInsertId();

		$Post = new Post(Post::GIVEN_ROW, (object) $Row);

		// Set last post
		$Post->GetThread()->SetLastPostId($Post->GetId());
		$Post->Save();

		return $Post;

	}

}

?>