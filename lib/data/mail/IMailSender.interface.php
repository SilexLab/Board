<?php
/**
 * @author    Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright Copyright (c) Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
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