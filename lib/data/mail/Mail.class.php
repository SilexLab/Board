<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class Mail {

	/*
	 * Mail methods
	 * Value is the front part of the class name
	 */
	const METHOD_PHP = 'Php';
	const METHOD_SMTP = 'Smtp';

	/*
	 * Mail types
	 * Plain text or HTML?
	 */
	const TYPE_PLAIN = 1;
	const TYPE_HTML = 2;

	/*
	 * Mail values
	 */
	private $From = '';
	private $FromMail = '';
	private $To = '';
	private $Subject = '';
	private $Message = '';
	private $Header = '';

	private $MailType = 0;

	/**
	 * Mail method to be used. See Mail::METHOD_* constants
	 * @var string
	 */
	private static $Method = '';

	/**
	 * Build our nice mail
	 */
	public function __construct($MailType, $From, $FromMail, $To, $Subject, $Message) {

		$this->From = $From;
		$this->FromMail = $FromMail;
		$this->To = $To;
		$this->Subject = $Subject;
		$this->Message = $Message;

		$this->MailType = $MailType;

	}

	/**
	 * Build the header'n'stuff
	 */
	public function Build() {

		// Build header
		$FromUser = '=?UTF-8?B?' . base64_encode($this->From) . '?=';
		$this->Subject = '=?UTF-8?B?' . base64_encode($this->Subject) . '?=';

		$Headers = 'From: ' . $FromUser . '<' . $this->FromMail . '>\r\n' .
			'MIME-Version: 1.0' . "\n";

		switch ($this->MailType) {

			case self::TYPE_HTML:
				$Headers .= 'Content-type: text/html; charset=UTF-8' . "\n";
				break;

			default:
			case self::TYPE_PLAIN:
				$Headers .= 'Content-type: text/plain; charset=UTF-8' . "\n";
				break;

		}

		$this->Header = $Headers;

	}

	/**
	 * Finally send the mail!
	 * @return bool Success
	 *
	 * @see IMailSender::Send
	 */
	public function Send() {

		// Do it .. with the right class
		$Class = self::$Method . 'MailSender';
		$Sender = new $Class($this);

		if ($Sender instanceof IMailSender) {
			// Send it!
			return $Sender->Send();
		}
		// Maybe throw an exception here?

	}


	/*
	 * Getters
	 */ 
	public function GetFrom() {
		return $this->From;
	}

	public function GetFromMail() {
		return $this->FromMail;
	}

	public function GetHeader() {
		return $this->Header;
	}

	public function GetMessage() {
		return $this->Message;
	}

	public function GetSubject() {
		return $this->Subject;
	}

	public function GetTo() {
		return $this->To;
	}

	/*
	 * Setters
	 */
	public function SetFrom($From) {
		$this->From = $From;
		$this->Build();
	}

	public function SetFromMail($FromMail) {
		$this->FromMail = $FromMail;
		$this->Build();
		
	}

	public function SetMessage($Message) {
		$this->Message = $Message;
		$this->Build();
	}

	public function SetSubject($Subject) {
		$this->Subject = $Subject;
		$this->Build();
	}

	public function SetTo($To) {
		$this->To = $To;
		$this->Build();
	}

	/**
	 * Init all global settings
	 */
	public static function Init() {

		// Get method
		$MethodConst = 'Mail::METHOD_'.SBB::Config('mail.method');

		if(defined($MethodConst))
			self::$Method = constant('Mail::METHOD_'.SBB::Config('mail.method'));
		// Maybe throw an exception here, too?

	}

}
