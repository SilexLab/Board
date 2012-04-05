<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class CommitInfo {
	/**
	 * Return the timestamp of the commit
	 * @return int
	 */
	public static function Get() {
		$Dir  = DIR_ROOT.'.git/';
		$File = $Dir.'ORIG_HEAD';
		$TMP  = CFG_CACHE_DIR.'commitinfo';

		if(is_dir($Dir) && file_exists($File)) {
			$Board = new Github('SilexBoard', 'Board');

			$SHA = trim(@file_get_contents($File));

			if(file_exists($TMP)) {
				$F = explode(':', trim(file_get_contents($TMP)));
				if($SHA == $F[0]) // Nothing changed
					return $F[1];

				// Commits are different
				$T = strtotime($Board->GetCommit($SHA)->committer->date);
				$FH = fopen($TMP, 'w');
				fwrite($FH, $SHA.':'.$T);
				fclose($FH);
				return $T;
			}
			// Create new file
			$T = strtotime($Board->GetCommit($SHA)->committer->date);
			$FH = fopen($TMP, 'w');
			fwrite($FH, $SHA.':'.$T);
			fclose($FH);
			return $T;
		}
		return 0;
	}
}
?>