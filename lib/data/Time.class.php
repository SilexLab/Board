<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Time {
	const
		MONDAY    = 'com.sbb.time.monday',
		TUESDAY   = 'com.sbb.time.tuesday',
		WEDNESDAY = 'com.sbb.time.wednesday',
		THURSDAY  = 'com.sbb.time.thursday',
		FRIDAY    = 'com.sbb.time.friday',
		SATURDAY  = 'com.sbb.time.saturday',
		SUNDAY    = 'com.sbb.time.sunday',
		JANUARY   = 'com.sbb.time.january',
		FEBRUARY  = 'com.sbb.time.february',
		MARCH     = 'com.sbb.time.march',
		APRIL     = 'com.sbb.time.april',
		MAY       = 'com.sbb.time.may',
		JUNE      = 'com.sbb.time.june',
		JULY      = 'com.sbb.time.july',
		AUGUST    = 'com.sbb.time.august',
		SEPTEMBER = 'com.sbb.time.september',
		OCTOBER   = 'com.sbb.time.october',
		NOVEMBER  = 'com.sbb.time.november',
		DECEMBER  = 'com.sbb.time.december';
	private static
		$Months = array(),
		$Days = array();

	private static
		$YearProcess,
		$DayProcess;

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

	/**
	 * Returns the language node of the given month
	 * @param  int $Number
	 * @return mixed
	 */
	public static function Month($Number) {
		if(empty(self::$Months)) {
			self::$Months = array(
				1  => self::JANUARY,
				2  => self::FEBRUARY,
				3  => self::MARCH,
				4  => self::APRIL,
				5  => self::MAY,
				6  => self::JUNE,
				7  => self::JULY,
				8  => self::AUGUST,
				9  => self::SEPTEMBER,
				10 => self::OCTOBER,
				11 => self::NOVEMBER,
				12 => self::DECEMBER
			);
		}
		if(isset(self::$Months[$Number]))
			return self::$Months[$Number];
		return $Number;
	}

	/**
	 * Returns the language node of the given day of the week
	 * @param  int $Number
	 * @return mixed
	 */
	public static function Day($Number) {
		if(empty(self::$Days)) {
			self::$Days = array(
				1 => self::MONDAY,
				2 => self::TUESDAY,
				3 => self::WEDNESDAY,
				4 => self::THURSDAY,
				5 => self::FRIDAY,
				6 => self::SATURDAY,
				7 => self::SUNDAY
			);
		}
		if(isset(self::$Days[$Number]))
			return self::$Days[$Number];
		return $Number;
	}
}
?>