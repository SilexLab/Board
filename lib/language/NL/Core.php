<?php
/**
 * @author     Malachite
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Langfile:	Dutch */
self::$Items = array_merge(self::$Items, array(
'com.sbb.language.info'    => 'Nederlands (Formal)',
'com.sbb.language.changed' => 'Jouww taal werd naar '.' veranderd',

'com.sbb.error'         => 'Fout',
'com.sbb.forumsoftware' => 'Forumsoftware',

'com.sbb.header.welcome'            => 'Welkom',
'com.sbb.header.logo_title'         => 'Startpagina',
'com.sbb.header.slogan'             => 'De moderne Bulletin Board software',
'com.sbb.header.search.title'       => 'Zoektocht', // ?
'com.sbb.header.search.placeholder' => 'Zoeken...', // ?

'com.sbb.page.error'    => 'Fout',
'com.sbb.page.home'     => 'Startpagina',
'com.sbb.page.forum'    => 'Forum',
'com.sbb.page.userlist' => 'Gebruikerslist',
'com.sbb.page.login'    => 'Login',   // ?
'com.sbb.page.register' => 'Sign up', // ?

'com.sbb.time.progress'    => 'Progress of the year ('.round(Time::YearProcess() * 100, 2).'%)', // ?
'com.sbb.time.dayprogress' => 'Progress of the day ('.round(Time::DayProcess() * 100, 2).'%)',   // ?

'com.sbb.register.register'           => 'Registreren',
'com.sbb.register.username'           => 'Gebruikersnaam',
'com.sbb.register.email'              => 'E-mailadres',
'com.sbb.register.email_repeat'       => 'E-mailadres herhalen',
'com.sbb.register.password'           => 'Wachtwoord',
'com.sbb.register.password_repeat'    => 'Wachtwoord herhalen',
'com.sbb.register.invalid_username'   => 'Ongeldige gebruikersnaam',
'com.sbb.register.invalid_email'      => 'Ongeldige E-Mailadres',
'com.sbb.register.incorrect_password' => 'De wachtwoorden stemmen niet overeen',
'com.sbb.register.incorrect_email'    => 'De e-mailadressen stemmen niet overeen',
'com.sbb.register.username_exist'     => 'Deze gebruikersnaam bestaat al!',
'com.sbb.register.email_exist'        => 'Deze e-mailadres bestaat al!',
'com.sbb.register.success'            => 'Jij hebt jouw met succes geregistreerd',

'com.sbb.login.login'          => 'Inloggen',
'com.sbb.login.bar_handle'     => 'Inloggen / Registreren',
'com.sbb.login.username'       => 'Gebruikersnaam',
'com.sbb.login.password'       => 'Wachtwoord',
'com.sbb.login.stay'           => 'Ingeloggt blijven',
'com.sbb.login.wrong_password' => 'Het wachtwoord ist niet juist!',
'com.sbb.login.no_user'        => 'Deze gebruiker bestaat niet!',
'com.sbb.login.success'        => 'Jij hebt jouw met succes aangemeld!',

'com.sbb.form.submit' => 'Afzenden',

'com.sbb.user.guest' => 'Gast', // ?

'com.sbb.logout.logout'        => 'Uitloggen',
'com.sbb.logout.logged_out'    => 'Jij werd met success uitgeloggt.',
'com.sbb.logout.main_menu'     => 'Hoofdmenu,',
'com.sbb.logout.not_logged_in' => 'U kunt uw niet uitloggen.',

'com.sbb.profile.homepage'  => 'Homepage',
'com.sbb.profile.signature' => 'Signatuur',

'com.sbb.board.empty'            => 'Op dit moment is het board leeg.',
'com.sbb.board.not_categorized'  => 'Niet gekategorizeerd',
'com.sbb.board.error.no_board'   => 'Het forum bestaat niet.',
'com.sbb.topics.error.no_topics' => 'Er zijn geen themas.',

'com.sbb.captcha'       => 'Captcha',
'com.sbb.captcha_wrong' => 'Het captcha is niet juist!',

'com.sbb.email.activation.title' => 'Gebruik deze link om jouw registrering af te sluiten: ',

'com.sbb.footer.current_language' => 'Current language', // ?
'com.sbb.footer.current_style'    => 'Current style',    // ?

// Databasestrings
'com.sbb.config.style.default' => 'Standaardstijl',
'com.sbb.config.page.title'    => 'Paginatitel'
));
?>