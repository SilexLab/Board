<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// Load the core of DE and overwrite different nodes
self::Load('DE', 'Core.php');

/* Langfile:	German (Formal) */
self::$Items = array_merge(self::$Items, array(
'com.sbb.language.info'    => 'Deutsch (Formell)',

'com.sbb.language.changed' => 'Ihre Sprache wurde nach '.' geändert',

'com.sbb.register.success'            => 'Sie haben sich erfolgreich registriert!',

'com.sbb.login.success'           => 'Sie haben sich erfolgreich angemeldet!',

'com.sbb.logout.logged_out'    => 'Sie wurden erfolgreich ausgeloggt.',
'com.sbb.logout.not_logged_in' => 'Sie können sich nicht ausloggen.',

'com.sbb.email.activation.title' => 'Sie müssen diesen Link klicken um Ihre Registrierung abzuschließen: '
));
?>