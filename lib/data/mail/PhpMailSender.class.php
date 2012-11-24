<?php
/**
 * @author    Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright Copyright (c) Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @package
 */
class PhpMailSender implements IMailSender {

    /**
     * Mail to be sent
     * @var Mail
     */
    private $Mail;

    /**
     * Builds the according mail
     *
     * @param Mail $Mail
     */
    public function __construct(Mail $Mail) {

        $this->Mail = $Mail;

    }

    /**
     * Sends our mail
     * @return bool Success
     */
    public function Send() {

		return mail($this->Mail->GetTo(), $this->Mail->GetSubject(), $this->Mail->GetMessage(), $this->Mail->GetHeader(), '-f '.$this->Mail->GetFromMail());

    }

}

?>