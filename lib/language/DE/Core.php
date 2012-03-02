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

'com.sbb.error'     => 'Fehler',
'com.sbb.copyright' => '<span class="Copyright">Forensoftware:</span> Silex Bulletin Board '.SBB_VERSION.' <span class="Copyright">–</span> © 2011 - 2012 SilexBoard.org',

'com.sbb.header.welcome'      => 'Willkommen',
'com.sbb.header.logo_title'   => 'Startseite',
'com.sbb.header.slogan'       => 'Die moderne Bulletin-Board-Software',
'com.sbb.header.search.title' => 'Suche',
'com.sbb.header.search.placeholder' => 'Suchen...',

'com.sbb.page.error'    => 'Fehler',
'com.sbb.page.home'     => 'Startseite',
'com.sbb.page.forum'    => 'Forum',
'com.sbb.page.userlist' => 'Benutzerliste',
'com.sbb.page.login'    => 'Anmeldung',
'com.sbb.page.register' => 'Registrierung',

'com.sbb.time.progress'    => 'Fortschritt des Jahres ('.round(Time::YearProcess() * 100, 2).'%)',
'com.sbb.time.dayprogress' => 'Fortschritt des Tages ('.round(Time::DayProcess() * 100, 2).'%)',

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
'com.sbb.login.wrong_password' => 'Das Passwort ist falsch!',
'com.sbb.login.no_user'        => 'Dieser Benutzer existiert nicht!',
'com.sbb.login.success'        => 'Du hast dich erfolgreich angemeldet!',

'com.sbb.form.submit' => 'Absenden',

'com.sbb.user.guest' => 'Gast',

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

// Databasestrings
'com.sbb.config.style.default' => 'Standardstil',
'com.sbb.config.page.title'    => 'Seitentitel'
));
?>