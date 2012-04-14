<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Langfile:	English */
self::$Items = array_merge(self::$Items, array(
'com.sbb.language.info'    => 'English',
'com.sbb.language.changed' => 'Your Language was changed to '.'.',

'com.sbb.error'         => 'Error',
'com.sbb.error.no_page' => 'This page doesn\'t exists',
'com.sbb.forumsoftware' => 'Forum software',

'com.sbb.header.welcome'            => 'Welcome',
'com.sbb.header.logo_title'         => 'Frontpage',
'com.sbb.header.slogan'             => 'The modern bulletin board software',
'com.sbb.header.search.title'       => 'Search',
'com.sbb.header.search.placeholder' => 'Search...',

'com.sbb.page.error'    => 'Error',
'com.sbb.page.home'     => 'Home',
'com.sbb.page.forum'    => 'Forum',
'com.sbb.page.userlist' => 'Memberlist',
'com.sbb.page.login'    => 'Login',
'com.sbb.page.register' => 'Sign up',
'com.sbb.page.user'     => 'User',

'com.sbb.register.register'           => 'Sign up',
'com.sbb.register.username'           => 'Username',
'com.sbb.register.email'              => 'E-mail address',
'com.sbb.register.email_repeat'       => 'Repeat e-mail address',
'com.sbb.register.password'           => 'Password',
'com.sbb.register.password_repeat'    => 'Repeat password',
'com.sbb.register.invalid_username'   => 'Invalid username',
'com.sbb.register.invalid_email'      => 'Invalid e-mail adress',
'com.sbb.register.incorrect_password' => 'The passwords don\'t match',
'com.sbb.register.incorrect_email'    => 'The e-mail adresses don\'t match',
'com.sbb.register.username_exist'     => 'This username already exists!',
'com.sbb.register.email_exist'        => 'This e-mail adress already exists!',
'com.sbb.register.success'            => 'You are successfully registered!',

'com.sbb.login.login'          => 'Log in',
'com.sbb.login.stay'           => 'Stay logged in',
'com.sbb.login.bar_handle'     => 'Log in / Sign up',
'com.sbb.login.username'       => 'Username',
'com.sbb.login.password'       => 'Password',
'com.sbb.login.wrong_password' => 'The password is wrong!',
'com.sbb.login.no_user'        => 'This user doesn\'t exist!',
'com.sbb.login.success'        => 'You are successfully logged in!',

'com.sbb.form.submit' => 'Submit',

'com.sbb.user.guest'             => 'Guest',
'com.sbb.user.avatar'            => 'Avatar',
'com.sbb.user.username'          => 'Username',
'com.sbb.user.joined'            => 'Joined',
'com.sbb.user.posts'             => 'Posts',
'com.sbb.user.language'          => 'Language',
'com.sbb.user.homepage'          => 'Webpage',
'com.sbb.user.contact'           => 'Contact',
'com.sbb.user.all_members'       => 'All Members',
'com.sbb.user.teammembers'       => 'Teammembers',
'com.sbb.user.search'            => 'Member search',
'com.sbb.user.no_user'           => 'This user doesn\'t exist!',
'com.sbb.user.user'              => 'User',
'com.sbb.user.profile_of'        => 'Profil of',
'com.sbb.user.profile.group'     => 'Group',
'com.sbb.user.profile.gender'    => 'Gender',
'com.sbb.user.profile.joined'    => 'Joined',
'com.sbb.user.profile.activity'  => 'Last activity',
'com.sbb.user.profile.language'  => 'Languages',
'com.sbb.user.profile.birthday'  => 'Birthday',
'com.sbb.user.profile.age'       => 'Age',
'com.sbb.user.profile.signature' => 'Signature',
'com.sbb.user.gender.male'       => 'Male',
'com.sbb.user.gender.female'     => 'Female',

'com.sbb.logout.logout'          => 'Logout',
'com.sbb.logout.logged_out'      => 'You are logged out now.',
'com.sbb.logout.main_menu'       => 'Main Menu',
'com.sbb.logout.never_logged_in' => 'You are never logged in.',

'com.sbb.profile.homepage'  => 'Homepage',
'com.sbb.profile.signature' => 'Signature',

'com.sbb.board.empty'            => 'Currently the Board is empty.',
'com.sbb.board.not_categorized'  => 'Not categorized',
'com.sbb.board.error.no_board'   => 'This forum doesn\'t exists',
'com.sbb.topics.error.no_topics' => 'There are no topics.',

'com.sbb.captcha'       => 'Captcha',
'com.sbb.captcha_wrong' => 'Captcha is wrong!',

'com.sbb.email.activation.title' => 'Your registration will be completed if you follow this link: ',

'com.sbb.footer.current_language' => 'Current language',
'com.sbb.footer.current_style'    => 'Current style',
'com.sbb.footer.current_time'     => 'Current time',
'com.sbb.footer.current_date'     => 'Current date',

'com.sbb.time.progress'    => 'Progress of the year ('.round(Time::YearProcess() * 100, 2).'%)',
'com.sbb.time.dayprogress' => 'Progress of the day ('.round(Time::DayProcess() * 100, 2).'%)',
'com.sbb.time.january'     => 'January',
'com.sbb.time.february'    => 'February',
'com.sbb.time.march'       => 'March',
'com.sbb.time.april'       => 'April',
'com.sbb.time.may'         => 'May',
'com.sbb.time.june'        => 'June',
'com.sbb.time.july'        => 'July',
'com.sbb.time.august'      => 'August',
'com.sbb.time.september'   => 'September',
'com.sbb.time.october'     => 'October',
'com.sbb.time.november'    => 'November',
'com.sbb.time.december'    => 'December',
'com.sbb.time.monday'      => 'Monday',
'com.sbb.time.tuesday'     => 'Tuesday',
'com.sbb.time.wednesday'   => 'Wednesday',
'com.sbb.time.thursday'    => 'Thursday',
'com.sbb.time.friday'      => 'Friday',
'com.sbb.time.saturday'    => 'Saturday',
'com.sbb.time.sunday'      => 'Sunday',

// Databasestrings
'com.sbb.config.style.default' => 'Default style',
'com.sbb.config.page.title'    => 'Page title'
));
?>