<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class SmtpMailSender implements IMailSender {

	/**
	 * Mail to be sent
	 * @var Mail
	 */
	private $Mail;

	/**
	 * SMTP-server file handler
	 * @var resource
	 */
	private $SmtpFh;

	private $SmtpServer = '';
	private $SmtpUser = '';
	private $SmtpPass = '';
	private $SmtpPort = 0;

	/**
	 * Builds the according mail
	 *
	 * @param Mail $Mail
	 */
	public function __construct(Mail $Mail) {

		$this->Mail = $Mail;

		// Open connection to the SMTP server
		$this->SmtpServer = SBB::Config('mail.smtp.server');
		$this->SmtpUser = SBB::Config('mail.smtp.user');
		$this->SmtpPass = SBB::Config('mail.smtp.pass');
		$this->SmtpPort = SBB::Config('mail.smtp.port');

		$this->SmtpFh = fsockopen($this->SmtpServer, $this->PortSMTP);

	}

	/**
	 * Sends our mail
	 * @return bool Success
	 */
	public function Send() {

		// We need this here to meet the Interface requirements
		if($this->SmtpFh === false)
			return false;
		// And again .. maybe we should through an exception here

		$Buffer = 'EHLO '.$_SERVER['SERVER_ADDR']."\n".
			'auth login'."\n".
			base64_encode($this->SmtpUser)."\n".
			base64_encode($this->SmtpPass)."\n".
			'MAIL FROM: <'.$this->Mail->GetFromMail().'>'."\n".
			'RCPT TO: <'.$this->$this->Mail->GetTo().'>'."\n".
			'DATA'."\n".
			$this->Mail->GetHeader()."\n".
			$this->Mail->GetMessage()."\n".
			'QUIT';

		fclose($this->SmtpFh);

	}

}

?>