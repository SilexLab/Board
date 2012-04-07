<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class CommitInfo {
	/**
	 * Return the timestamp of the commit
	 * @param  string $Info
	 * @return int
	 */
	public static function Get($Info = 'date') {
		$Dir  = DIR_ROOT.'.git/logs/';
		$File = $Dir.'HEAD';
		$TMP  = CFG_CACHE_DIR.'commitinfo';

		if(is_dir($Dir) && file_exists($File)) {
			$Board = new Github('SilexBoard', 'Board');

			$F = file($File);
			$L = explode(' ', $F[sizeof($F)-1]);
			$SHA = $L[1];
			if($Info == 'SHA')
				return $SHA;

			if(file_exists($TMP)) {
				$F = explode(':', trim(file_get_contents($TMP)));
				if($SHA == $F[0]) // Nothing changed
					return (int)$F[1];

				// Commits are different
				$T = strtotime($Board->GetCommit($SHA)->committer->date);
				$FH = fopen($TMP, 'w');
				fwrite($FH, $SHA.':'.$T);
				fclose($FH);
				return (int)$T;
			}
			// Create new file
			$T = strtotime($Board->GetCommit($SHA)->committer->date);
			$FH = fopen($TMP, 'w');
			fwrite($FH, $SHA.':'.$T);
			fclose($FH);
			return (int)$T;
		}
		return 0;
	}
}
?>