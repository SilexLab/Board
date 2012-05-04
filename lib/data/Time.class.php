<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Time {
	const
		MONDAY    = 'sbb.time.monday',
		TUESDAY   = 'sbb.time.tuesday',
		WEDNESDAY = 'sbb.time.wednesday',
		THURSDAY  = 'sbb.time.thursday',
		FRIDAY    = 'sbb.time.friday',
		SATURDAY  = 'sbb.time.saturday',
		SUNDAY    = 'sbb.time.sunday',
		JANUARY   = 'sbb.time.january',
		FEBRUARY  = 'sbb.time.february',
		MARCH     = 'sbb.time.march',
		APRIL     = 'sbb.time.april',
		MAY       = 'sbb.time.may',
		JUNE      = 'sbb.time.june',
		JULY      = 'sbb.time.july',
		AUGUST    = 'sbb.time.august',
		SEPTEMBER = 'sbb.time.september',
		OCTOBER   = 'sbb.time.october',
		NOVEMBER  = 'sbb.time.november',
		DECEMBER  = 'sbb.time.december';
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