<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

require_once('init.php');
$Parser = new messageParser;
echo '<script src="javascript/jquery-1.6.min.js"></script>';
$Message = '_Unterstrichen_ *Kursiv* **Fett** ***Fett und Kursiv*** **_Fett und Unterstrichen_** *_Kursiv und Unterstrichen_* *_**Fett, Kursiv und Unterstrichen**_*';
echo $Parser->parse($Message);
echo "<br>";
$Message = 'Text davor `echo "Hallo Welt";` Text danach';
echo $Parser->parse($Message);
echo "<br>";
$Message = "# Überschrift 1\n## Überschrift 2\n### Überschrift 3\n#### Überschrift 4";
echo $Parser->parse($Message);
echo "<br>";
$Message = "[http://google.com | das ist ein link | hallo noxi]";
echo $Parser->parse($Message);
echo "<br>";
echo $Parser->parse('[spoiler=title]xDDD[/spoiler]');
echo "<br>";
echo $Parser->parse('[http://google.com | Google | KLICK MICH :D] hier sollte eine fehlermeldung stehen :D', 1, 0, 0);
echo '';
?>