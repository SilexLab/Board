<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

/* Langfile:	German (Informal) */
self::$Items = array_merge(self::$Items, array(
'com.sbb.error'		=> 'Fehler',
'com.sbb.copyright'	=> 'Forensoftware: Silex Bulletin Board '.SILEX_VERSION.' – © 2011 silexboard.org',

'com.sbb.language.info'		=> 'Deutsch (Informal)',
'com.sbb.language.changed'	=> 'Deine Sprache wurde nach '.SBB::Template()->Get('LangChangedTo').' geändert',

'com.sbb.header.welcome'		=> 'Willkommen',
'com.sbb.header.welcome_text'	=> 'Herzlich willkommen auf '.SBB::Template()->Get('PageTitle').' - '.SBB::Template()->Get('PageSlogan'),
'com.sbb.header.logo_title'		=> 'Startseite',
'com.sbb.header.slogan'			=> 'Die moderne Bulletin-Board-Software',

'com.sbb.menu.home'		=> 'Startseite',
'com.sbb.menu.forum'	=> 'Forum',
'com.sbb.menu.userlist'	=> 'Benutzerliste',

'com.sbb.crumbs.home'	=> 'Startseite',
'com.sbb.crumbs.forum'	=> 'Forum',
'com.sbb.crumbs.user'	=> 'Benutzerliste',

'com.sbb.register.register'				=> 'Registrieren',
'com.sbb.register.username'				=> 'Benutzername',
'com.sbb.register.email'				=> 'E-mail Adresse',
'com.sbb.register.email_repeat'			=> 'E-mail Adresse wiederholen',
'com.sbb.register.password'				=> 'Passwort',
'com.sbb.register.password_repeat'		=> 'Passwort wiederholen',
'com.sbb.register.invalid_username'		=> 'Ungültiger Benutzername',
'com.sbb.register.invalid_email'		=> 'Ungültige E-Mail Adresse',
'com.sbb.register.incorrect_password'	=> 'Die Passwörter stimmen nicht überein',
'com.sbb.register.incorrect_email'		=> 'Die E-Mail Adressen stimmen nicht überein',
'com.sbb.register.username_exist'		=> 'Dieser Benutzername existiert bereits!',
'com.sbb.register.email_exist'			=> 'Diese E-Mail Adresse existiert bereits!',
'com.sbb.register.success'				=> 'Du hast dich erfolgreich registriert!',

'com.sbb.login.login'				=> 'Einloggen',
'com.sbb.login.bar_handle'			=> 'Einloggen / Registrieren',
'com.sbb.login.username'			=> 'Benutzername',
'com.sbb.login.password'			=> 'Passwort',
'com.sbb.login.stay'				=> 'Eingeloggt bleiben',
'com.sbb.login.wrong_password'		=> 'Das Passwort ist falsch!',
'com.sbb.login.notexist_username'	=> 'Dieser Benutzer existiert nicht!',
'com.sbb.login.success'				=> 'Du hast dich erfolgreich angemeldet!',

'com.sbb.form.submit'	=> 'Absenden',

'com.sbb.logout.logout'			=> 'Ausloggen',
'com.sbb.logout.logged_out'		=> 'Du wurdest erfolgreich ausgeloggt.',
'com.sbb.logout.main_menu'		=> 'Hauptmenü',
'com.sbb.logout.not_logged_in'	=> 'Du kannst dich nicht ausloggen.',

'com.sbb.profile.homepage'	=> 'Homepage',
'com.sbb.profile.signature'	=> 'Signatur',

'com.sbb.board.empty'				=> 'Zurzeit ist das Board leer.',
'com.sbb.board.not_categorized'		=> 'Nicht Kategorisiert',
'com.sbb.board.error.no_board'		=> 'Das Forum existiert nicht',
'com.sbb.topics.error.no_topics'	=> 'Es gibt keine Themen.',

'com.sbb.captcha'		=> 'Captcha',
'com.sbb.captcha_wrong'	=> 'Captcha ist falsch!',

'com.sbb.email.activation.title'	=> 'Du musst diesen Link klicken um deine Registrierung abzuschließen: ',

// Databasestrings
'com.sbb.config.style.default'	=> 'Standardstil',
'com.sbb.config.page.title'		=> 'Seitentitel'
));
?>