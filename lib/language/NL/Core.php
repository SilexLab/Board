<?php
/**
 * @author     Malachite
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Langfile:	Dutch */
self::$Items = array_merge(self::$Items, array(
'sbb.language.info'    => 'Nederlands (Formal)',
'sbb.language.changed' => 'Jouww taal werd naar '.' veranderd',

'sbb.error'         => 'Fout',
'sbb.error.no_page' => 'This page doesn\'t exists', // ?
'sbb.forumsoftware' => 'Forumsoftware',

'sbb.header.welcome'            => 'Welkom',
'sbb.header.logo_title'         => 'Startpagina',
'sbb.header.slogan'             => 'De moderne Bulletin Board software',
'sbb.header.search.title'       => 'Zoektocht', // ?
'sbb.header.search.placeholder' => 'Zoeken...', // ?

'sbb.page.error'    => 'Fout',
'sbb.page.home'     => 'Startpagina',
'sbb.page.forum'    => 'Forum',
'sbb.page.userlist' => 'Gebruikerslist',
'sbb.page.login'    => 'Login',   // ?
'sbb.page.register' => 'Sign up', // ?
'sbb.page.user'     => 'User',    // ?

'sbb.register.register'           => 'Registreren',
'sbb.register.username'           => 'Gebruikersnaam',
'sbb.register.email'              => 'E-mailadres',
'sbb.register.email_repeat'       => 'E-mailadres herhalen',
'sbb.register.password'           => 'Wachtwoord',
'sbb.register.password_repeat'    => 'Wachtwoord herhalen',
'sbb.register.invalid_username'   => 'Ongeldige gebruikersnaam',
'sbb.register.invalid_email'      => 'Ongeldige E-Mailadres',
'sbb.register.incorrect_password' => 'De wachtwoorden stemmen niet overeen',
'sbb.register.incorrect_email'    => 'De e-mailadressen stemmen niet overeen',
'sbb.register.username_exist'     => 'Deze gebruikersnaam bestaat al!',
'sbb.register.email_exist'        => 'Deze e-mailadres bestaat al!',
'sbb.register.success'            => 'Jij hebt jouw met succes geregistreerd',

'sbb.login.login'          => 'Inloggen',
'sbb.login.bar_handle'     => 'Inloggen / Registreren',
'sbb.login.username'       => 'Gebruikersnaam',
'sbb.login.password'       => 'Wachtwoord',
'sbb.login.stay'           => 'Ingeloggt blijven',
'sbb.login.wrong_password' => 'Het wachtwoord ist niet juist!',
'sbb.login.no_user'        => 'Deze gebruiker bestaat niet!',
'sbb.login.success'        => 'Jij hebt jouw met succes aangemeld!',
'sbb.logout.success'       => 'Jij werd met success uitgeloggt',

'sbb.form.submit' => 'Afzenden',

'sbb.user.guest'             => 'Guest',    // ?
'sbb.user.avatar'            => 'Avatar',   // ?
'sbb.user.username'          => 'Username', // ?
'sbb.user.joined'            => 'Joined',   // ?
'sbb.user.posts'             => 'Posts',    // ?
'sbb.user.language'          => 'Language', // ?
'sbb.user.homepage'          => 'Webpage',  // ?
'sbb.user.contact'           => 'Contact',  // ?
'sbb.user.all_members'       => 'All Members',   // ?
'sbb.user.teammembers'       => 'Teammembers',   // ?
'sbb.user.search'            => 'Member search', // ?
'sbb.user.no_user'           => 'This user doesn\'t exist!', // ?
'sbb.user.user'              => 'User', // ?
'sbb.user.profile_of'        => 'Profil of', // ?
'sbb.user.profile.group'     => 'Group', // ?
'sbb.user.profile.gender'    => 'Gender', // ?
'sbb.user.profile.joined'    => 'Joined', // ?
'sbb.user.profile.activity'  => 'Last activity', // ?
'sbb.user.profile.language'  => 'Languages', // ?
'sbb.user.profile.birthday'  => 'Birthday', // ?
'sbb.user.profile.age'       => 'Age', // ?
'sbb.user.profile.signature' => 'Signature', // ?
'sbb.user.gender.male'       => 'Male', // ?
'sbb.user.gender.female'     => 'Female', // ?


'sbb.logout.logout'        => 'Uitloggen',
'sbb.logout.logged_out'    => 'Jij werd met success uitgeloggt.',
'sbb.logout.main_menu'     => 'Hoofdmenu,',
'sbb.logout.not_logged_in' => 'U kunt uw niet uitloggen.',

'sbb.profile.homepage'  => 'Homepage',
'sbb.profile.signature' => 'Signatuur',

'sbb.board.empty'            => 'Op dit moment is het board leeg.',
'sbb.board.not_categorized'  => 'Niet gekategorizeerd',
'sbb.board.error.no_board'   => 'Het forum bestaat niet.',
'sbb.topics.error.no_topics' => 'Er zijn geen themas.',

'sbb.captcha'       => 'Captcha',
'sbb.captcha_wrong' => 'Het captcha is niet juist!',

'sbb.email.activation.title' => 'Gebruik deze link om jouw registrering af te sluiten: ',

'sbb.footer.current_language' => 'Current language', // ?
'sbb.footer.current_style'    => 'Current style',    // ?
'sbb.footer.current_time'     => 'Current time',     // ?
'sbb.footer.current_date'     => 'Current date',     // ?

'sbb.time.progress'    => 'Progress of the year ('.round(Time::YearProcess() * 100, 2).'%)', // ?
'sbb.time.dayprogress' => 'Progress of the day ('.round(Time::DayProcess() * 100, 2).'%)',   // ?
'sbb.time.january'     => 'January',   // ?
'sbb.time.february'    => 'February',  // ?
'sbb.time.march'       => 'March',     // ?
'sbb.time.april'       => 'April',     // ?
'sbb.time.may'         => 'May',       // ?
'sbb.time.june'        => 'June',      // ?
'sbb.time.july'        => 'July',      // ?
'sbb.time.august'      => 'August',    // ?
'sbb.time.september'   => 'September', // ?
'sbb.time.october'     => 'October',   // ?
'sbb.time.november'    => 'November',  // ?
'sbb.time.december'    => 'December',  // ?
'sbb.time.monday'      => 'Monday',    // ?
'sbb.time.tuesday'     => 'Tuesday',   // ?
'sbb.time.wednesday'   => 'Wednesday', // ?
'sbb.time.thursday'    => 'Thursday',  // ?
'sbb.time.friday'      => 'Friday',    // ?
'sbb.time.saturday'    => 'Saturday',  // ?
'sbb.time.sunday'      => 'Sunday',    // ?

// Databasestrings
'sbb.config.style.default' => 'Standaardstijl',
'sbb.config.page.title'    => 'Paginatitel'
));
