<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Time {
	private static $YearProcess, $DayProcess;

	/**
	 * Returns the year process in percent
	 * @return float
	 */
	public static function YearProcess() {
		if(empty(self::$YearProcess)) {
			$Year = mktime(0, 0, 0, 1, 1, date('Y') + 1) - mktime(0, 0, 0, 1, 1, date('Y'));
			$Current = time() - mktime(0, 0, 0, 1, 1, date('Y'));
			self::$YearProcess = $Current / $Year;
		}
		return self::$YearProcess;
	}

	/**
	 * Returns the day process in percent
	 * @return float
	 */
	public static function DayProcess() {
		if(empty(self::$DayProcess)) {
			$Day = 86400;
			$Current = time() - mktime(0, 0, 0, date('n'), date('j'), date('Y'));
			self::$DayProcess = $Current / $Day;
		}
		return self::$DayProcess;
	}
}
?>