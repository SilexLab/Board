-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. April 2011 um 22:23
-- Server Version: 5.1.41
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `silexboard`
--

-- --------------------------------------------------------

--
-- Tabelle Categories löschen
--

DROP TABLE IF EXISTS `categories`;

--
-- Tabellenstruktur für Tabelle `forums`
--

DROP TABLE IF EXISTS `forums`;
CREATE TABLE IF NOT EXISTS `forums` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` tinyint(4) NOT NULL,
  `Parent` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Description` text NOT NULL,
  `Position` int(11) NOT NULL,
  `Permission` longtext NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `forums`
--

INSERT INTO `forums` (`ID`, `Type`, `Parent`, `Title`, `Description`, `Position`, `Permission`, `Status`) VALUES
(1, 0, 0, 'Erste Kategorie', 'Eine neue Kategorie', 2, '', 0),
(2, 0, 0, 'Zweite Kategorie', 'Beschreibung der 2. Kategorie', 1, '', 0),
(3, 1, 1, 'Erstes Forum', 'Forum in der ersten Kategorie', 0, '', 0),
(4, 1, 2, 'Zweites Forum', 'Forum in der Zweiten Kategorie', 1, '', 0),
(5, 1, 2, 'Drittes Forum', 'Forum in der 2. Kategorie', 0, '', 0),
(6, 0, 0, 'Dritte Kategorie', 'Eine neue Dritte Kategorie', 0, '', 0),
(7, 1, 6, '4. Forum', 'Forum in der 3. Kategorie', 0, '', 0),
(8, 1, 7, '5. Forum', 'Forum in einem Forum', 0, '', 0),
(9, 1, 0, '6. Forum', 'Forum ohne Kategorie', 0, '', 0);
