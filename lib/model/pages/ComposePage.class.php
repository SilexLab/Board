<?php
/**
 * @author      Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class ComposePage implements IPage {
	/**
	 * Create a new thread
	 */
	const TYPE_THREAD = 1;

	/**
	 * Create a reply
	 */
	const TYPE_REPLY = 2;

	/**
	 * Edit a post
	 */
	const TYPE_EDIT = 3;

	/**
	 * Which type of post are we creating?
	 * @var int
	 */
	protected $Type = 0;

	/**
	 * Where should this post be created? BoardID or ThreadID, according to $Type
	 * @var int
	 */
	protected $Target = 0;

	/**
	 * Title of the target
	 * @var string
	 */
	protected $TargetTitle = '';

	protected $Error = false;

	/**
	 * Will called when the page is the current page
	 */
	public function Display(Page $P) {
		$this->Target = $P->URI()->GetID(2, 'Target');
		$this->Type = $P->URI()->GetID(1, 'Type');

		if(!$this->Type || !$this->Target) {
			Notification::Show(Language::Get('compose.error.no_type_target'), Notification::ERROR);
			return false;
		}

		$this->Evaluate();

		// Declare for assignment
		$Thread = $Board = $Post = false;

		switch($this->Type) {
			case self::TYPE_REPLY:
				try {
					$Thread = new Thread(Thread::GIVEN_ID, $this->Target);
				} catch(NotFoundException $e) {
					$this->Error = true;
					Notification::Show(Language::Get('error.no_thread'), Notification::ERROR);
					break;
				}

				$this->TargetTitle = $Thread->GetTopic();

				// Redirect if url-title is wrong
				if(!$P->URI()->Check(2, htmlspecialchars_decode($Thread->GetTopic())) || !$P->URI()->Check(1, htmlspecialchars_decode($this->Title()))) {
					header('location: '.$this->Link());
				}

				// Crumb the crumbies
				SBB::Nav()->Crumb()->AddMany($Thread->GetBreadcrumbs());
				SBB::Nav()->Crumb()->Add($this->Title(), $this->Link());
				break;
			case self::TYPE_THREAD:
				try {
					$Board = new Board(Board::GIVEN_ID, $this->Target);
				} catch(NotFoundException $e) {
					$this->Error = true;
					Notification::Show(Language::Get('error.no_board'), Notification::ERROR);
					break;
				}

				$this->TargetTitle = $Board->GetTitle();

				// Redirect if url-title is wrong
				if(!$P->URI()->Check(2, htmlspecialchars_decode($Board->GetTitle())) || !$P->URI()->Check(1, htmlspecialchars_decode($this->Title()))) {
					header('location: '.$this->Link());
				}

				// Crumb the crumbies
				SBB::Nav()->Crumb()->AddMany($Board->GetBreadcrumbs());
				SBB::Nav()->Crumb()->Add($this->Title(), $this->Link());
				break;
			case self::TYPE_EDIT:
				try {
					$Post = new Post(Post::GIVEN_ID, $this->Target);
				} catch(NotFoundException $e) {
					$this->Error = true;
					Notification::Show(Language::Get('error.no_post'), Notification::ERROR);
					break;
				}

				$this->TargetTitle = $Post->GetThread()->GetTopic();

				// Redirect if url-title is wrong
				if(!$P->URI()->Check(2, htmlspecialchars_decode($Post->GetThread()->GetTopic())) || !$P->URI()->Check(1, htmlspecialchars_decode($this->Title()))) {
					header('location: '.$this->Link());
				}

				// Give them the current things
				$Current = [
					'message' => $Post->GetMessage(),
					'smileys' => $Post->GetSmileys(),
					'html'    => $Post->GetHtml(),
					'silexcode' => $Post->GetSilexCode(),
					'numchars'  => strlen($Post->GetMessage())
				];

                // Do we have the edited values in there?
                if(!HtmlPost::Get('save'))
				    SBB::Template()->Assign(['input' => $Current]);

				// Crumb the crumbies
				SBB::Nav()->Crumb()->AddMany($Post->GetThread()->GetBreadcrumbs());
				SBB::Nav()->Crumb()->Add($this->Title(), $this->Link());
				break;
		}
		SBB::Template()->Assign(['compose' => ['error' => $this->Error, 'target' => $this->Target, 'type' => $this->Type, 'board' => $Board, 'thread' => $Thread, 'post' => $Post]]);
	}

	/**
	 * Returns the callable link for this site
	 * e.g. ?page=Home
	 *
	 * @return string
	 */
	public function Link() {
		return URI::Make([['page', 'Compose'], ['Type', $this->Type, $this->Title()], ['Target', $this->Target, $this->TargetTitle]]);
	}

	/**
	 * Return the title of the current page
	 * @return string
	 */
	public function Title() {
		if($this->Type == self::TYPE_THREAD)
			return Language::Get('compose.compose_thread');
		elseif($this->Type == self::TYPE_REPLY)
			return Language::Get('compose.compose_reply');
		elseif($this->Type == self::TYPE_EDIT)
			return Language::Get('compose.compose_edit');
	}

	/**
	 * Return the template file which belongs to the page
	 * @return string
	 */
	public function Template() {
		if(!$this->Type || !$this->Target)
			return 'PageError.tpl';
		else
			return 'PageCompose.tpl';
	}

	/**
	 * Return additional information if available
	 * @param  string $Info
	 * @return mixed
	 */
	public function Info($Info) {
		// TODO: Implement Info() method.
	}

	/**
	 * Evaluate the input and create the post/thread
	 */
	protected function Evaluate() {
		$Input = [
			'topic'   => HtmlPost::Get('topic'),
			'message' => HtmlPost::Get('message'),
			'smileys' => HtmlPost::Get('setting_smileys') == 1,
			'html'    => HtmlPost::Get('setting_html') == 1,
			'silexcode' => HtmlPost::Get('setting_silexcode') == 1,
			'numchars'  => strlen(HtmlPost::Get('message'))
		];

		// Preview comes later
		if(HtmlPost::Get('save')) {
			if($this->CheckInput()) {
				switch($this->Type) {
					case self::TYPE_REPLY:
						// TODO: Is the user allowed to do so? (Permissions)
						$NewPost = PostUtil::Create($this->Target, SBB::User()->ID(), $Input['message'], '', $Input['smileys'], $Input['html'], $Input['silexcode']);
						if($NewPost === false) {
							Notification::Show('compose.error.generic_reply', Notification::ERROR);
							SBB::Template()->Assign(['input' => $Input]);
							break;
						}
						// Hey ThreadPage, I got something for you!
						Session::Set('ComposePostSuccess', 1);

						header('Location: '.$NewPost->GetThread()->GetLink());
						break;
					case self::TYPE_THREAD:
						$NewThread = ThreadUtil::Create($this->Target, $Input['topic'], '', false, SBB::User()->ID(), $Input['message'], '', $Input['smileys'], $Input['html'], $Input['silexcode']);
						if($NewThread === false) {
							Notification::Show('compose.error.generic_thread', Notification::ERROR);
							SBB::Template()->Assign(['input' => $Input]);
							break;
						}
						// Hey ThreadPage, I got something for you!
						Session::Set('ComposeThreadSuccess', 1);

						header('Location: '.$NewThread->GetLink());
						break;
                    case self::TYPE_EDIT:
                        // Get post
                        try {
                            $Post = new Post(Post::GIVEN_ID, $this->Target);
                        } catch(NotFoundException $e) {
                            $this->Error = true;
                            Notification::Show(Language::Get('error.no_post'), Notification::ERROR);
                            break;
                        }

                        /* Set them data! */
                        $Post->SetMessage($Input['message']);
                        $Post->SetSilexCode($Input['silexcode']);
                        $Post->SetHtml($Input['html']);
                        $Post->SetSmileys($Input['smileys']);

                        $Post->SetEditorId(SBB::User()->ID());
                        $Post->SetLastEdit(time());

                        $Post->Save();

                        // Hey ThreadPage, I got something for you!
                        Session::Set('EditPostSuccess', 1);

                        header('Location: '.$Post->GetThread()->GetLink());
                        break;
				}
			}
		}
	}

	/**
	 * Is the input alright?
	 * @return bool
	 */
	protected function CheckInput() {
		$Return = true;

		if($this->Type == self::TYPE_THREAD) {
			if(HtmlPost::Get('topic') === false) {
				Notification::Show(Language::Get('compose.error.no_topic'), Notification::ERROR);
				$Return = false;
			}
		}

		if(HtmlPost::Get('message') === false) {
			Notification::Show(Language::Get('compose.error.no_message'), Notification::ERROR);
			$Return = false;
		}

		if(HtmlPost::Get('setting_silexcode') === false || HtmlPost::Get('setting_html') === false || HtmlPost::Get('setting_smileys') === false) {
			Notification::Show(Language::Get('compose.error.no_settings'), Notification::ERROR);
			$Return = false;
		}

		if(!in_array(HtmlPost::Get('setting_silexcode'), ['1', '0']) ||
				!in_array(HtmlPost::Get('setting_html'), ['1', '0']) ||
				!in_array(HtmlPost::Get('setting_smileys'), ['1', '0'])) {

			Notification::Show(Language::Get('compose.error.pattern_settings'), Notification::ERROR);
			$Return = false;
		}
		return $Return;
	}
}
