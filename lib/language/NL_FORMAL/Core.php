<?php
/**
 * @author     Malachite
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Langfile:	Dutch (Formal) */
self::$Items = array_merge(self::$Items, array(
'com.sbb.language.info'    => 'Nederlands (Formal)',
'com.sbb.language.changed' => 'Uw taal werd naar '.' veranderd',

'com.sbb.error'         => 'Fout',
'com.sbb.error.no_page' => 'This page doesn\'t exists', // ?
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
'com.sbb.register.success'            => 'U hebt uw met succes geregistreerd',

'com.sbb.login.login'          => 'Inloggen',
'com.sbb.login.bar_handle'     => 'Inloggen / Registreren',
'com.sbb.login.username'       => 'Gebruikersnaam',
'com.sbb.login.password'       => 'Wachtwoord',
'com.sbb.login.stay'           => 'Ingeloggt blijven',
'com.sbb.login.wrong_password' => 'Het wachtwoord ist niet juist!',
'com.sbb.login.no_user'        => 'Deze gebruiker bestaat niet!',
'com.sbb.login.success'        => 'U hebt uw met succes aangemeld!',

'com.sbb.form.submit' => 'Afzenden',

'com.sbb.user.guest'             => 'Guest',    // ?
'com.sbb.user.avatar'            => 'Avatar',   // ?
'com.sbb.user.username'          => 'Username', // ?
'com.sbb.user.joined'            => 'Joined',   // ?
'com.sbb.user.posts'             => 'Posts',    // ?
'com.sbb.user.language'          => 'Language', // ?
'com.sbb.user.homepage'          => 'Webpage',  // ?
'com.sbb.user.contact'           => 'Contact',  // ?
'com.sbb.user.all_members'       => 'All Members',   // ?
'com.sbb.user.teammembers'       => 'Teammembers',   // ?
'com.sbb.user.search'            => 'Member search', // ?
'com.sbb.user.no_user'           => 'This user doesn\'t exist!', // ?
'com.sbb.user.user'              => 'User', // ?
'com.sbb.user.profile_of'        => 'Profil of', // ?
'com.sbb.user.profile.group'     => 'Group', // ?
'com.sbb.user.profile.gender'    => 'Gender', // ?
'com.sbb.user.profile.joined'    => 'Joined', // ?
'com.sbb.user.profile.activity'  => 'Last activity', // ?
'com.sbb.user.profile.language'  => 'Languages', // ?
'com.sbb.user.profile.birthday'  => 'Birthday', // ?
'com.sbb.user.profile.age'       => 'Age', // ?
'com.sbb.user.profile.signature' => 'Signature', // ?
'com.sbb.user.gender.male'       => 'Male', // ?
'com.sbb.user.gender.female'     => 'Female', // ?

'com.sbb.logout.logout'        => 'Uitloggen',
'com.sbb.logout.logged_out'    => 'U werd met success uitgeloggt.',
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

'com.sbb.email.activation.title' => 'Gebruik deze link om uw registrering af te sluiten: ',

'com.sbb.footer.current_language' => 'Current language', // ?
'com.sbb.footer.current_style'    => 'Current style',    // ?
'com.sbb.footer.current_time'     => 'Current time',     // ?
'com.sbb.footer.current_date'     => 'Current date',     // ?

'com.sbb.time.progress'    => 'Progress of the year ('.round(Time::YearProcess() * 100, 2).'%)', // ?
'com.sbb.time.dayprogress' => 'Progress of the day ('.round(Time::DayProcess() * 100, 2).'%)',   // ?
'com.sbb.time.january'     => 'January',   // ?
'com.sbb.time.february'    => 'February',  // ?
'com.sbb.time.march'       => 'March',     // ?
'com.sbb.time.april'       => 'April',     // ?
'com.sbb.time.may'         => 'May',       // ?
'com.sbb.time.june'        => 'June',      // ?
'com.sbb.time.july'        => 'July',      // ?
'com.sbb.time.august'      => 'August',    // ?
'com.sbb.time.september'   => 'September', // ?
'com.sbb.time.october'     => 'October',   // ?
'com.sbb.time.november'    => 'November',  // ?
'com.sbb.time.december'    => 'December',  // ?
'com.sbb.time.monday'      => 'Monday',    // ?
'com.sbb.time.tuesday'     => 'Tuesday',   // ?
'com.sbb.time.wednesday'   => 'Wednesday', // ?
'com.sbb.time.thursday'    => 'Thursday',  // ?
'com.sbb.time.friday'      => 'Friday',    // ?
'com.sbb.time.saturday'    => 'Saturday',  // ?
'com.sbb.time.sunday'      => 'Sunday',    // ?

// Databasestrings
'com.sbb.config.style.default' => 'Standaardstijl',
'com.sbb.config.page.title'    => 'Paginatitel'
));
?>