<?php
/**
 * @author 		Malachite
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

/* Langfile:	Dutch (Formal) */
self::$Items = array_merge(self::$Items, array(
'com.sbb.error'		=> 'Fout',
'com.sbb.copyright'	=> 'Forumsoftware: Silex Bulletin Board '.SILEX_VERSION.' – © 2011 silexboard.org',

'com.sbb.language.info'		=> 'Nederlands (Formal)',
'com.sbb.language.changed'	=> 'Uw taal werd naar '.SBB::Template()->Get('LangChangedTo').' veranderd',

'com.sbb.header.welcome'		=> 'Welkom',
'com.sbb.header.welcome_text'	=> 'Welkom op '.SBB::Template()->Get('PageTitle').' - '.SBB::Template()->Get('PageSlogan'),
'com.sbb.header.logo_title'		=> 'Startpagina',
'com.sbb.header.slogan'			=> 'De moderne Bulletin Board software',

'com.sbb.menu.home'		=> 'Startpagina',
'com.sbb.menu.forum'	=> 'Forum',
'com.sbb.menu.userlist'	=> 'Gebruikerslist',

'com.sbb.crumbs.home'	=> 'Startpagina',
'com.sbb.crumbs.forum'	=> 'Forum',
'com.sbb.crumbs.user'	=> 'Gebruikerslist',

'com.sbb.register.register'				=> 'Registreren',
'com.sbb.register.username'				=> 'Gebruikersnaam',
'com.sbb.register.email'				=> 'E-mailadres',
'com.sbb.register.email_repeat'			=> 'E-mailadres herhalen',
'com.sbb.register.password'				=> 'Wachtwoord',
'com.sbb.register.password_repeat'		=> 'Wachtwoord herhalen',
'com.sbb.register.invalid_username'		=> 'Ongeldige gebruikersnaam',
'com.sbb.register.invalid_email'		=> 'Ongeldige E-Mailadres',
'com.sbb.register.incorrect_password'	=> 'De wachtwoorden stemmen niet overeen',
'com.sbb.register.incorrect_email'		=> 'De e-mailadressen stemmen niet overeen',
'com.sbb.register.username_exist'		=> 'Deze gebruikersnaam bestaat al!',
'com.sbb.register.email_exist'			=> 'Deze e-mailadres bestaat al!',
'com.sbb.register.success'				=> 'U hebt uw met succes geregistreerd',

'com.sbb.login.login'				=> 'Inloggen',
'com.sbb.login.bar_handle'			=> 'Inloggen / Registreren',
'com.sbb.login.username'			=> 'Gebruikersnaam',
'com.sbb.login.password'			=> 'Wachtwoord',
'com.sbb.login.stay'				=> 'Ingeloggt blijven',
'com.sbb.login.wrong_password'		=> 'Het wachtwoord ist niet juist!',
'com.sbb.login.notexist_username'	=> 'Deze gebruiker bestaat niet!',
'com.sbb.login.success'				=> 'U hebt uw met succes aangemeld!',

'com.sbb.form.submit'	=> 'Afzenden',

'com.sbb.logout.logout'			=> 'Uitloggen',
'com.sbb.logout.logged_out'		=> 'U werd met success uitgeloggt.',
'com.sbb.logout.main_menu'		=> 'Hoofdmenu,',
'com.sbb.logout.not_logged_in'	=> 'U kunt uw niet uitloggen.',

'com.sbb.profile.homepage'	=> 'Homepage',
'com.sbb.profile.signature'	=> 'Signatuur',

'com.sbb.board.empty'				=> 'Op dit moment is het board leeg.',
'com.sbb.board.not_categorized'		=> 'Niet gekategorizeerd',
'com.sbb.board.error.no_board'		=> 'Het forum bestaat niet.',
'com.sbb.topics.error.no_topics'	=> 'Er zijn geen themas.',

'com.sbb.captcha'		=> 'Captcha',
'com.sbb.captcha_wrong'	=> 'Het captcha is niet juist!',

'com.sbb.email.activation.title'	=> 'Gebruik deze link om uw registrering af te sluiten: ',

// Databasestrings
'com.sbb.config.style.default'	=> 'Standaardstijl',
'com.sbb.config.page.title'		=> 'Paginatitel'
));
?>