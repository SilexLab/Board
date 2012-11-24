<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
interface IMailSender {

    /**
     * Builds the according mail
     * @param Mail $Mail
     */
    public function __construct(Mail $Mail);

    /**
     * Sends our mail
     * @return bool Success
     */
    public function Send();


}

?>