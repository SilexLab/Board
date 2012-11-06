<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    0.0.1
 */

// Load the core of "de" and overwrite different nodes
self::Load('de', 'sbb.core.php');

/* Langfile:	German (Formal) */
self::$Items = array_merge(self::$Items, [
'sbb.language.info' => 'Deutsch (Formell)',

'sbb.language.changed' => 'Ihre Sprache wurde nach %s geändert',

'sbb.register.success' => 'Sie haben sich erfolgreich registriert!',

'sbb.login.failed'   => 'Sie konnten sich nicht einloggen',
'sbb.login.success'  => 'Sie haben sich erfolgreich angemeldet',
'sbb.logout.success' => 'Sie wurden erfolgreich ausgeloggt',

'sbb.email.activation.title' => 'Sie müssen diesen Link klicken um Ihre Registrierung abzuschließen: '
]);
