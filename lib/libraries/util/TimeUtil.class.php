<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class TimeUtil {
	public static $Day = [
		1 => 'time.monday',
		2 => 'time.tuesday',
		3 => 'time.wednesday',
		4 => 'time.thursday',
		5 => 'time.friday',
		6 => 'time.saturday',
		7 => 'time.sunday'
	];
	public static $Month = [
		1  => 'time.january',
		2  => 'time.february',
		3  => 'time.march',
		4  => 'time.april',
		5  => 'time.may',
		6  => 'time.june',
		7  => 'time.july',
		8  => 'time.august',
		9  => 'time.september',
		10 => 'time.october',
		11 => 'time.november',
		12 => 'time.december'
	];

	const
		SECOND = 'time.second',
		MINUTE = 'time.minute',
		HOUR   = 'time.hour',
		DAY    = 'time.day',
		WEEK   = 'time.week',
		MONTH  = 'time.month',
		YEAR   = 'time.year';

	/**
	 * Wrapper for DateTime diff
	 * @param  string $Date1
	 * @param  string $Date2
	 * @param  string $Format optional
	 * @return mixed
	 */
	public static function Diff($Date1, $Date2, $Format = '') {
		$Diff = date_diff(date_create($Date1), date_create($Date2));
		if($Format)
			return $Diff->format($Format);
		return $Diff;
	}

	/* Special */
	public static function DateProgress() {
		$Now = new DateTime('now');

		$YearBegin = new DateTime(date('Y-01-01 00:00:00'));
		$YearEnd = new DateTime(date('Y-12-31 23:59:59'));
		$DayBegin = new DateTime(date('Y-m-d 00:00:00'));
		$DayEnd = new DateTime(date('Y-m-d 23:59:59'));

		// Get in seconds
		$YearNowSeconds = $Now->getTimestamp() - $YearBegin->getTimestamp();
		$YearTotalSeconds = $YearEnd->getTimestamp() - $YearBegin->getTimestamp();

		$DayNowSeconds = $Now->getTimestamp() - $DayBegin->getTimestamp();
		$DayTotalSeconds = $DayEnd->getTimestamp() - $DayBegin->getTimestamp();

		// Progresses
		$YearProgress = $YearNowSeconds / $YearTotalSeconds * 100;
		$DayProgress = $DayNowSeconds / $DayTotalSeconds * 100;

		$DateTitle = Language::Get(self::$Day[$Now->format('N')]).', '.
			$Now->format('d. ').Language::Get(self::$Month[$Now->format('n')]).$Now->format(' Y');

		SBB::Template()->Assign([
			'time' => [
				'date'          => $Now->format('d.m.Y'),
				'time'          => $Now->format('H:i'),
				'week'          => $Now->format('W'),
				'year_progress' => round($YearProgress, 2),
				'day_progress'  => round($DayProgress, 2),
				'title_year'    => sprintf(Language::Get('time.year_progress'), $YearProgress),
				'title_day'     => sprintf(Language::Get('time.day_progress'), $DayProgress),
				'title_date'    => Language::Get('time.current.date').' - '.$DateTitle
			]
		]);
	}
}
