<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class TimeUtil {
	const
		MONDAY    = 'time.monday',
		TUESDAY   = 'time.tuesday',
		WEDNESDAY = 'time.wednesday',
		THURSDAY  = 'time.thursday',
		FRIDAY    = 'time.friday',
		SATURDAY  = 'time.saturday',
		SUNDAY    = 'time.sunday',
		JANUARY   = 'time.january',
		FEBRUARY  = 'time.february',
		MARCH     = 'time.march',
		APRIL     = 'time.april',
		MAY       = 'time.may',
		JUNE      = 'time.june',
		JULY      = 'time.july',
		AUGUST    = 'time.august',
		SEPTEMBER = 'time.september',
		OCTOBER   = 'time.october',
		NOVEMBER  = 'time.november',
		DECEMBER  = 'time.december';
	const
		SECOND = 1,
		MINUTE = 60,
		HOUR   = 3600,
		DAY    = 86400,
		WEEK   = 604800,
		MONTH  = 2628000,
		YEAR   = 31536000;

	private static $Units = [
			self::SECOND => 'time.second',
			self::MINUTE => 'time.minute',
			self::HOUR   => 'time.hour',
			self::DAY    => 'time.day',
			self::WEEK   => 'time.week',
			self::MONTH  => 'time.month',
			self::YEAR   => 'time.year'
		];

	private static
		$Months = [],
		$Days = [];

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
			$Current = time() - mktime(0, 0, 0, date('n'), date('j'), date('Y'));
			self::$DayProcess = $Current / self::DAY;
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

	/**
	 * Return the time difference
	 * @param  int $Time timestamp
	 * @return string
	 */
	public static function Difference($Time) {
		if($Time < time()) {
			$Number = time() - $Time;
			self::Convert($Number, $Unit);
			return sprintf(Language::Get('time.ago'), $Number, $Unit);
		}
		if($Time > time()) {
			$Number = $Time - time();
			self::Convert($Number, $Unit);
			return sprintf(Language::Get('time.ahead'), $Number, $Unit);
		}
		return Language::Get('time.now');
	}

	/**
	 * Convert time values into higher units
	 * @param ref $Time
	 * @param ref $Unit
	 * @param int $Base optional
	 */
	public static function Convert(&$Time, &$Unit, $Base = 1) {
		if(!is_numeric($Time) || !isset(self::$Units[$Base]))
			return;

		$Time = $Time * $Base;
		if($Time >= self::YEAR) { // year
			$Time = (int)($Time / self::YEAR);
			$Unit = self::$Units[self::YEAR];
		} else if($Time >= self::MONTH) { // month
			$Time = (int)($Time / self::MONTH);
			$Unit = self::$Units[self::MONTH];
		} else if($Time >= self::WEEK) { // week
			$Time = (int)($Time / self::WEEK);
			$Unit = self::$Units[self::WEEK];
		} else if($Time >= self::DAY) { // day
			$Time = (int)($Time / self::DAY);
			$Unit = self::$Units[self::DAY];
		} else if($Time >= self::HOUR) { // hour
			$Time = (int)($Time / self::HOUR);
			$Unit = self::$Units[self::HOUR];
		} else if($Time >= self::MINUTE) { // minute
			$Time = (int)($Time / self::MINUTE);
			$Unit = self::$Units[self::MINUTE];
		} else
			$Unit = self::$Units[self::SECOND];

		if($Time != 1)
			$Unit .= 's';
	}
}
