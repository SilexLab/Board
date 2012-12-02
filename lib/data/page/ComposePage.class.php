<?php
/**
 * @author     Janek Ostendorf (ozzy) <ozzy2345de@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */
class ComposePage implements IPage {

    /**
     * Create a new thread
     */
    const TYPE_THREAD = 1;

    /**
     * Create an answer
     */
    const TYPE_ANSWER = 2;

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

    /**
     * Will called when the page is the current page
     */
    public function Display(Page $P) {

		$this->Target = $P->URI()->GetID(2, 'Target');
		$this->Type = $P->URI()->GetID(1, 'Type');

		$this->Evaluate();

		$Error = false;

		// Declare for assignment
		$Thread = $Board = false;


        switch($this->Type) {

            case self::TYPE_ANSWER:

				try {
					$Thread = new Thread(Thread::GIVEN_ID, $this->Target);
				}
				catch(NotFoundException $e) {

					$Error = true;
					Notification::Show(Language::Get('sbb.error.thread_not_exists'), Notification::ERROR);
					break;

				}

				$this->TargetTitle = $Thread->GetTopic();

				// Redirect if url-title is wrong
				if(!$P->URI()->Check(2, htmlspecialchars_decode($Thread->GetTopic())) || !$P->URI()->Check(1, htmlspecialchars_decode($this->Title()))) {

					header('location: '.$this->Link());

				}

				// Crumb the crumbies
				Breadcrumb::AddMany($Thread->GetBreadcrumbs());
				Breadcrumb::Add($this->Title(), $this->Link());

                break;

			case self::TYPE_THREAD:
				try {
					$Board = new Board(Board::GIVEN_ID, $this->Target);
				}
				catch(NotFoundException $e) {

					$Error = true;
					Notification::Show(Language::Get('sbb.error.board_not_exists'), Notification::ERROR);
					break;

				}

				$this->TargetTitle = $Board->GetTitle();

				// Redirect if url-title is wrong
				if(!$P->URI()->Check(2, htmlspecialchars_decode($Board->GetTitle())) || !$P->URI()->Check(1, htmlspecialchars_decode($this->Title()))) {

					header('location: '.$this->Link());

				}

				// Crumb the crumbies
				Breadcrumb::AddMany($Board->GetBreadcrumbs());
				Breadcrumb::Add($this->Title(), $this->Link());

				break;

        }

		SBB::Template()->Assign(['compose' => ['error' => $Error, 'target' => $this->Target, 'type' => $this->Type, 'board' => $Board, 'thread' => $Thread]]);

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
		if($this->Type == 1)
			return Language::Get('sbb.compose.compose_thread');
		elseif($this->Type == 2)
			return Language::Get('sbb.compose.compose_answer');
    }

    /**
     * Return the template file which belongs to the page
     * @return string
     */
    public function Template() {
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

		// Preview comes later
		if(HtmlPost::Get('save')) {

			if($this->CheckInput()) {

				Notification::Show('Yaaay!', Notification::SUCCESS); // This will be the creation

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
			if(HtmlPost::Get('subject') === false) {
				Notification::Show(Language::Get('sbb.compose.error.no_subject'), Notification::ERROR);
				$Return = false;
			}
		}

		if(HtmlPost::Get('message') === false) {
			Notification::Show(Language::Get('sbb.compose.error.no_message'), Notification::ERROR);
			$Return = false;
		}

		if(HtmlPost::Get('setting_silexcode') === false || HtmlPost::Get('setting_html') === false || HtmlPost::Get('setting_smileys') === false) {
			Notification::Show(Language::Get('sbb.compose.error.no_settings'), Notification::ERROR);
			$Return = false;
		}

		if(!in_array(HtmlPost::Get('setting_silexcode'), ['1', '0']) ||
				!in_array(HtmlPost::Get('setting_html'), ['1', '0']) ||
				!in_array(HtmlPost::Get('setting_smileys'), ['1', '0'])) {

			Notification::Show(Language::Get('sbb.compose.error.pattern_settings'), Notification::ERROR);
			$Return = false;

		}

		return $Return;

	}

}