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
	 * @return mixed
	 */
	public static function Get($Info = 'date') {
		$Dir  = DIR_ROOT.'.git/logs/';
		$File = $Dir.'HEAD';
		$TMP  = CFG_CACHE_DIR.'commitinfo';

		if(is_dir($Dir) && file_exists($File)) {
			$Board = new Github('SilexBoard', 'Board');

			$aFile = file($File);
			$aLine = explode(' ', $aFile[sizeof($aFile)-1]);
			$SHA = $aLine[1];
			if($Info == 'SHA')
				return $SHA;

			if(file_exists($TMP)) {
				$F = explode(':', trim(file_get_contents($TMP)));
				if($SHA == $F[0]) // Nothing changed
					return (int)$F[1];
			}

			// Write to file
			$Time = strtotime($Board->GetCommit($SHA)->committer->date);
			if(!$Time) {
				for($i = 4; $i < sizeof($aFile); $i++) {
					if(is_numeric($aLine[$i]) && strlen($aLine[$i]) == 10) {
						$Time = $aLine[$i];
						break;
					}
				}
			}
			$FileHandle = fopen($TMP, 'w');
			fwrite($FileHandle, $SHA.':'.$Time);
			fclose($FileHandle);
			return (int)$Time;
		}
		return 0;
	}
}
?>