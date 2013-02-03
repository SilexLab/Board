<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    0.0.1
 */

/* Langfile:	German (Formal) */
return array_merge([
'language.info' => 'Deutsch (Formell)',

'language.changed' => 'Ihre Sprache wurde nach %s geändert',

'register.success' => 'Sie haben sich erfolgreich registriert!',

'login.failed'   => 'Sie konnten sich nicht einloggen',
'login.success'  => 'Sie haben sich erfolgreich angemeldet',
'logout.success' => 'Sie wurden erfolgreich ausgeloggt',

'info.javascript' => 'Bitte aktivieren Sie JavaScript um den vollen Funktionsumfang dieser Seite nutzen zu können.',

'email.activation.title' => 'Sie müssen diesen Link klicken um Ihre Registrierung abzuschließen: ',

'compose.error.no_topic'         => 'Sie müssen ein Thema angeben!',
'compose.error.no_message'       => 'Sie müssen eine Nachricht angeben!',
'compose.error.no_settings'      => 'Sie müssen jede Einstellung angeben!',
'compose.error.pattern_settings' => 'Irgendetwas stimmt nicht mit Ihren Einstellungen.',
'compose.success.reply'          => 'Ihre Antwort wurde erfolgreich erstellt.',
'compose.success.thread'         => 'Ihr Thread wurde erfolgreich erstellt.',
'compose.success.edit'           => 'Ihr Beitrag wurde erfolgreich bearbeitet.'
// Load the core of "de" and overwrite different nodes
], self::Load('de', 'sbb.core.php'));
