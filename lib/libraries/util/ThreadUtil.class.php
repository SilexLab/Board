<?php
/**
 * @author      Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class ThreadUtil {

    /**
     * Length of the preview text saved in the thread
     */
    const PREVIEW_LENGTH = 50;

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

    /**
     * Create a thread AND the first post
     *
     * @param string $Topic
     * @param int    $BoardId
     * @param string $Prefix
     * @param bool   $Sticky
     * @param int    $UserId
     * @param string $Message
     * @param string $IpAddress
     * @param bool   $Smileys
     * @param bool   $Html
     * @param bool   $SilexCode
     *
     * @return bool|Thread Newly created thread.
     */
    public static function Create($BoardId, $Topic, $Prefix, $Sticky, $UserId, $Message, $IpAddress, $Smileys, $Html, $SilexCode) {

		// Create first post first
		$FirstPost = PostUtil::Create(0, $UserId, $Message, $IpAddress, $Smileys, $Html, $SilexCode);

		if(!$FirstPost)
			return false;

		$Row = [
			'BoardID'      => $BoardId,
			'PostID'       => $FirstPost->GetId(),
			'UserID'       => $UserId,
			'Prefix'       => $Prefix,
			'Topic'        => $Topic,
			'Message'      => (strlen($Message) > self::PREVIEW_LENGTH ? substr($Message, 0, self::PREVIEW_LENGTH - 3) . ' ...' : $Message),
			'Time'         => time(),
			'LastPostID'   => $FirstPost->GetId(),
			'LastPostTime' => $FirstPost->GetTime(),
			'Replies'      => 0,
			'Views'        => 0,
			'Sticky'       => ($Sticky ? 1 : 0),
			'Disabled'     => 0,
			'Closed'       => 0,
			'Deleted'      => 0,
			'DeleteReason' => '',
			'DeleteTime'   => 0
		];

		// Write the row in the DB
		$Query = 'INSERT INTO `thread` ';

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

		$Thread = new Thread(Thread::GIVEN_ROW, (object) $Row);

        // Set thread of the first post
        $FirstPost->SetThreadId($Thread->GetId());
        $FirstPost->Save();

		// Set last post
        $Thread->GetBoard()->SetLastPostId($Thread->GetId());
        $Thread->Save();

		// Yea, yea. A bit long
		$Thread->GetBoard()->SetPostCount($Thread->GetBoard()->GetPostCount() + 1);
		$Thread->GetBoard()->SetThreadCount($Thread->GetBoard()->GetThreadCount() + 1);
		$Thread->GetBoard()->Save();

		return $Thread;

	}

}

?>
