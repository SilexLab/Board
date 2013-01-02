<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

interface IStyleScript {
	public function __construct(array &$Info, array &$Properties);

	/**
	 * Get CSS and JS files
	 * if the returned array is empty info.xml properties will be used
	 * format: ['css' => [array], 'js' => [array]]
	 * @return  array
	 */
	public function GetFiles();
}
