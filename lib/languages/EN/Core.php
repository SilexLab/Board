<?php
/**
 * @author 		Nox Nebula
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE - Version 3
 * @package		SilexBoard
 */

/* Langfile:	English */
self::$Items = array_merge(self::$Items, array(
'com.sbb.error'		=> 'Error',
'com.sbb.copyright'	=> 'Forum software: Silex Bulletin Board '.SILEX_VERSION.' — © 2011 silexboard.org',

'com.sbb.language.info'		=> 'English',
'com.sbb.language.changed'	=> 'Your Language was changed to '.SBB::Template()->Get('LangChangedTo').'.',

'com.sbb.header.welcome'		=> 'Welcome',
'com.sbb.header.welcome_text'	=> 'Welcome on '.SBB::Template()->Get('PageTitle').' - '.SBB::Template()->Get('PageSlogan'),
'com.sbb.header.logo_title'		=> 'Frontpage',
'com.sbb.header.slogan'			=> 'The modern Bulletin Board Software',

'com.sbb.menu.home'		=> 'Home',
'com.sbb.menu.forum'	=> 'Forum',
'com.sbb.menu.userlist'	=> 'Memberlist',

'com.sbb.crumbs.home'	=> 'Home',
'com.sbb.crumbs.forum'	=> 'Forum',
'com.sbb.crumbs.user'	=> 'Memberlist',

'com.sbb.register.register'				=> 'Sign up',
'com.sbb.register.username'				=> 'Username',
'com.sbb.register.email'				=> 'E-mail address',
'com.sbb.register.email_repeat'			=> 'Repeat E-mail address',
'com.sbb.register.password'				=> 'Password',
'com.sbb.register.password_repeat'		=> 'Repeat password',
'com.sbb.register.invalid_username'		=> 'Invalid username',
'com.sbb.register.invalid_email'		=> 'Invalid e-mail adress',
'com.sbb.register.incorrect_password'	=> 'The passwords don\'t match',
'com.sbb.register.incorrect_email'		=> 'The e-mail adresses don\'t match',
'com.sbb.register.username_exist'		=> 'This username already exists!',
'com.sbb.register.email_exist'			=> 'This e-mail adress already exists!',
'com.sbb.register.success'				=> 'You are successfully registered!',

'com.sbb.login.login'				=> 'Log in',
'com.sbb.login.stay'				=> 'Stay logged in',
'com.sbb.login.bar_handle'			=> 'Log in / Sign up',
'com.sbb.login.username'			=> 'Username',
'com.sbb.login.password'			=> 'Password',
'com.sbb.login.wrong_password'		=> 'The password is wrong!',
'com.sbb.login.notexist_username'	=> 'This user doesn\'t exist!',
'com.sbb.login.success'				=> 'You are successfully logged in!',

'com.sbb.form.submit'	=> 'Submit',

'com.sbb.logout.logout'				=> 'Logout',
'com.sbb.logout.logged_out'			=> 'You are logged out now.',
'com.sbb.logout.main_menu'			=> 'Main Menu',
'com.sbb.logout.never_logged_in'	=> 'You are never logged in.',

'com.sbb.profile.homepage'	=> 'Homepage',
'com.sbb.profile.signature'	=> 'Signature',

'com.sbb.board.empty'				=> 'Currently the Board is empty.',
'com.sbb.board.not_categorized'		=> 'Not categorized',
'com.sbb.board.error.no_board'		=> 'This forum doesn\'t exists',
'com.sbb.topics.error.no_topics'	=> 'There are no topics.',

'com.sbb.captcha'		=> 'Captcha',
'com.sbb.captcha_wrong'	=> 'Captcha is wrong!',

'com.sbb.email.activation.title'	=> 'Your registration will be completed if you follow this link: ',

// Databasestrings
'com.sbb.config.style.default'	=> 'Default style',
'com.sbb.config.page.title'		=> 'Page title'
));
?>