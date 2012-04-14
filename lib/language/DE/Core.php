<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Langfile:	German (Informal) */
self::$Items = array_merge(self::$Items, array(
'com.sbb.language.info'    => 'Deutsch (Informell)',
'com.sbb.language.changed' => 'Deine Sprache wurde nach '.' geändert',

'com.sbb.error'         => 'Fehler',
'com.sbb.error.no_page' => 'Diese Seite existiert nicht',
'com.sbb.forumsoftware' => 'Forensoftware',

'com.sbb.header.welcome'            => 'Willkommen',
'com.sbb.header.logo_title'         => 'Startseite',
'com.sbb.header.slogan'             => 'Die moderne Bulletin-Board-Software',
'com.sbb.header.search.title'       => 'Suche',
'com.sbb.header.search.placeholder' => 'Suchen...',

'com.sbb.page.error'    => 'Fehler',
'com.sbb.page.home'     => 'Startseite',
'com.sbb.page.forum'    => 'Forum',
'com.sbb.page.userlist' => 'Benutzerliste',
'com.sbb.page.login'    => 'Anmeldung',
'com.sbb.page.register' => 'Registrierung',

'com.sbb.register.register'           => 'Registrieren',
'com.sbb.register.username'           => 'Benutzername',
'com.sbb.register.email'              => 'E-mail Adresse',
'com.sbb.register.email_repeat'       => 'E-mail Adresse wiederholen',
'com.sbb.register.password'           => 'Passwort',
'com.sbb.register.password_repeat'    => 'Passwort wiederholen',
'com.sbb.register.invalid_username'   => 'Ungültiger Benutzername',
'com.sbb.register.invalid_email'      => 'Ungültige E-Mail Adresse',
'com.sbb.register.incorrect_password' => 'Die Passwörter stimmen nicht überein',
'com.sbb.register.incorrect_email'    => 'Die E-Mail Adressen stimmen nicht überein',
'com.sbb.register.username_exist'     => 'Dieser Benutzername existiert bereits!',
'com.sbb.register.email_exist'        => 'Diese E-Mail Adresse existiert bereits!',
'com.sbb.register.success'            => 'Du hast dich erfolgreich registriert!',

'com.sbb.login.login'          => 'Einloggen',
'com.sbb.login.bar_handle'     => 'Einloggen / Registrieren',
'com.sbb.login.username'       => 'Benutzername',
'com.sbb.login.password'       => 'Passwort',
'com.sbb.login.stay'           => 'Eingeloggt bleiben',
'com.sbb.login.failed'         => 'Du konntest dich nicht einloggen.',
'com.sbb.login.success'        => 'Du hast dich erfolgreich angemeldet!',

'com.sbb.form.submit' => 'Absenden',

'com.sbb.user.guest'             => 'Gast',
'com.sbb.user.avatar'            => 'Profilbild',
'com.sbb.user.username'          => 'Benutzername',
'com.sbb.user.joined'            => 'Beigetreten',
'com.sbb.user.posts'             => 'Beiträge',
'com.sbb.user.language'          => 'Sprache',
'com.sbb.user.homepage'          => 'Webseite',
'com.sbb.user.contact'           => 'Kontaktieren',
'com.sbb.user.all_members'       => 'Alle Mitglieder',
'com.sbb.user.teammembers'       => 'Teammitglieder',
'com.sbb.user.search'            => 'Mitgliedssuche',
'com.sbb.user.no_user'           => 'Dieser Benutzer existiert nicht!',
'com.sbb.user.user'              => 'Benutzer',
'com.sbb.user.profile_of'        => 'Profil von',
'com.sbb.user.profile.group'     => 'Gruppe',
'com.sbb.user.profile.gender'    => 'Geschlecht',
'com.sbb.user.profile.joined'    => 'Beitrittsdatum',
'com.sbb.user.profile.activity'  => 'Letzte Aktivität',
'com.sbb.user.profile.language'  => 'Sprachen',
'com.sbb.user.profile.birthday'  => 'Geburtstag',
'com.sbb.user.profile.age'       => 'Alter',
'com.sbb.user.profile.signature' => 'Signatur',
'com.sbb.user.gender.male'       => 'Männlich',
'com.sbb.user.gender.female'     => 'Weiblich',

'com.sbb.logout.logout'        => 'Ausloggen',
'com.sbb.logout.logged_out'    => 'Du wurdest erfolgreich ausgeloggt.',
'com.sbb.logout.main_menu'     => 'Hauptmenü',
'com.sbb.logout.not_logged_in' => 'Du kannst dich nicht ausloggen.',

'com.sbb.profile.homepage'  => 'Homepage',
'com.sbb.profile.signature' => 'Signatur',

'com.sbb.board.empty'            => 'Zurzeit ist das Board leer.',
'com.sbb.board.not_categorized'  => 'Nicht Kategorisiert',
'com.sbb.board.error.no_board'   => 'Das Forum existiert nicht',
'com.sbb.topics.error.no_topics' => 'Es gibt keine Themen.',

'com.sbb.captcha'       => 'Captcha',
'com.sbb.captcha_wrong' => 'Captcha ist falsch!',

'com.sbb.email.activation.title' => 'Du musst diesen Link klicken um deine Registrierung abzuschließen: ',

'com.sbb.footer.current_language' => 'Aktuelle Sprache',
'com.sbb.footer.current_style'    => 'Aktueller Stil',
'com.sbb.footer.current_time'     => 'Aktuelle Uhrzeit',
'com.sbb.footer.current_date'     => 'Aktuelles Datum',

'com.sbb.time.progress'    => 'Fortschritt des Jahres ('.round(Time::YearProcess() * 100, 2).'%)',
'com.sbb.time.dayprogress' => 'Fortschritt des Tages ('.round(Time::DayProcess() * 100, 2).'%)',
'com.sbb.time.january'     => 'Januar',
'com.sbb.time.february'    => 'Februar',
'com.sbb.time.march'       => 'März',
'com.sbb.time.april'       => 'April',
'com.sbb.time.may'         => 'Mai',
'com.sbb.time.june'        => 'Juni',
'com.sbb.time.july'        => 'Juli',
'com.sbb.time.august'      => 'August',
'com.sbb.time.september'   => 'September',
'com.sbb.time.october'     => 'Oktober',
'com.sbb.time.november'    => 'November',
'com.sbb.time.december'    => 'Dezember',
'com.sbb.time.monday'      => 'Montag',
'com.sbb.time.tuesday'     => 'Dienstag',
'com.sbb.time.wednesday'   => 'Mittwoch',
'com.sbb.time.thursday'    => 'Donnerstag',
'com.sbb.time.friday'      => 'Freitag',
'com.sbb.time.saturday'    => 'Samstag',
'com.sbb.time.sunday'      => 'Sonntag',

// Databasestrings
'com.sbb.config.style.default' => 'Standardstil',
'com.sbb.config.page.title'    => 'Seitentitel'
));
?>