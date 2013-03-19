<?php
/**
 * @author      Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class PostUtil {

	/**
	 * Creates a new post and returns the post object of the new post.
	 * @param int $ThreadId Set 0 for no thread
	 * @param int $UserId
	 * @param string $Message
	 * @param string $IpAddress
	 * @param bool $Smileys
	 * @param bool $Html
	 * @param bool $SilexCode
	 * @return bool|Post Returns the Post object of the new post on success.
	 */
	public static function Create($ThreadId, $UserId, $Message, $IpAddress, $Smileys, $Html, $SilexCode) {

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
        if($ThreadId != 0) {
		    $Post->GetThread()->SetLastPostId($Post->GetId());
			$Post->GetThread()->SetReplyCount($Post->GetThread()->GetReplyCount() + 1);
		    $Post->GetThread()->Save();

			// Yea, yea. A bit long
			$Post->GetThread()->GetBoard()->SetPostCount($Post->GetThread()->GetBoard()->GetPostCount() + 1);
			$Post->GetThread()->GetBoard()->SetThreadCount($Post->GetThread()->GetBoard()->GetThreadCount() + 1);
			$Post->GetThread()->GetBoard()->Save();
        }

		return $Post;

	}


}
