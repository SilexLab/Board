<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

// Load the core of DE and overwrite different nodes
self::Load('DE', 'Core.php');

/* Langfile:	German (Formal) */
self::$Items = array_merge(self::$Items, array(
'sbb.language.info' => 'Deutsch (Formell)',

'sbb.language.changed' => 'Ihre Sprache wurde nach '.' geändert',

'sbb.register.success' => 'Sie haben sich erfolgreich registriert!',

'sbb.login.failed'   => 'Sie konnten sich nicht einloggen',
'sbb.login.success'  => 'Sie haben sich erfolgreich angemeldet',
'sbb.logout.success' => 'Sie wurden erfolgreich ausgeloggt',

'sbb.email.activation.title' => 'Sie müssen diesen Link klicken um Ihre Registrierung abzuschließen: '
));
