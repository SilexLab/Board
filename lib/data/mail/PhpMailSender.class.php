<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
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