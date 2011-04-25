<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */
require_once('init.php');
$Parser = new messageParser;

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
?>