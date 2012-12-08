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

'sbb.email.activation.title' => 'Sie müssen diesen Link klicken um Ihre Registrierung abzuschließen: ',

'sbb.compose.error.no_topic'         => 'Sie müssen ein Thema angeben!',
'sbb.compose.error.no_message'       => 'Sie müssen eine Nachricht angeben!',
'sbb.compose.error.no_settings'      => 'Sie müssen jede Einstellung angeben!',
'sbb.compose.error.pattern_settings' => 'Irgendetwas stimmt nicht mit Ihren Einstellungen.',
'sbb.compose.success.reply'          => 'Ihre Antwort wurde erfolgreich erstellt.',
'sbb.compose.success.thread'         => 'Ihr Thread wurde erfolgreich erstellt.',
'sbb.compose.success.edit'           => 'Ihr Beitrag wurde erfolgreich bearbeitet.'
]);
