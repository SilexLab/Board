<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

abstract class AbstractNav {
	abstract public function GetList();
	abstract public function Add($Name, $Link, $Target = false);
	abstract public function Remove($Name);
}
