Silex Bulletin Board - Readme
=============================
Silex Board or SilexBB (Silex Bulletin Board) is an open source forum software released under the [GNU General Public Licence](http://www.gnu.org/licenses/gpl-3.0.html). It is free to download and use.
The software uses a modified version of a template language/engine called [Twig](https://github.com/SilexBoard/Template) to manage layouts, safe code and display the content.
The project was found by Patrick Kleinschmidt (Nox Nebula) to improve his PHP skills. He convinced Daniel (Cadillaxx), Gillo (Angus) and Yannick (Nut) to join the project as main developers. Daniel left the team for unknown reasons.

Requirements
------------
* A webserver like apache, nginx or lighttpd <sup>[1]</sup>
* PHP __5.4__ or later
	* Matching PDO driver for the database of your choice
	* Activated cURL, fopen or wget
	* Activated zlib
	* Writeable and enabled cache directory (_or the board will be slow as hell_) <sup>[2]</sup>
* A database such as MySQL 5, PostgreSQL, MSSQL or SQLite 3 <sup>[3]</sup>
* Some love ♥ <sup>[4]</sup>

Links
-------
* __[Homepage](http://www.silexboard.org/)__
* __[Demo](http://demo.silexboard.org/)__
* __[Github repository](https://github.com/SilexBoard/Board)__
* __[Issues](https://github.com/SilexBoard/Board/issues)__
* __[Contributors](https://github.com/SilexBoard/Board/blob/master/CONTRIBUTORS.md)__
* __[Silex Flavored Markdown draft](http://demo.silexboard.org/Draft/Silex_Flavored_Markdown.html)__
* __[Coding style](https://github.com/SilexBoard/Board/blob/master/docs/codingstyle.md)__
* __[License](http://www.gnu.org/licenses/gpl-3.0.html)__

### Contact
* __IRC__ - [Webchat](http://webchat.quakenet.org/?channels=SilexBoard)<br>___irc://irc.quakenet.org/#SilexBoard___<br>#SilexBoard at irc.quakenet.org
* ![](https://twitter.com/favicon.ico) __[Twitter](https://twitter.com/SilexBoard)__ - ___@SilexBoard___
* ![](https://www.facebook.com/favicon.ico) __[Facebook](https://www.facebook.com/SilexBoard)__
* <img src="https://ssl.gstatic.com/s2/oz/images/faviconr2.ico" height="16" width="16"> __[Google+](https://plus.google.com/b/110206747608815084063/)__

Notes
-----
__<sup>[1]</sup>__ Silex Board is developed primarily under nginx<br>
__<sup>[2]</sup>__ Later on, we will support Memcache or so<br>
__<sup>[3]</sup>__ Tested currently only with MySQL<br>
__<sup>[4]</sup>__ Yes there is a heart, just for you, here is another one: ♥

-----

Silex Bulletin Board – © 2011 - 2012 [SilexBoard.org](http://www.silexboard.org/)