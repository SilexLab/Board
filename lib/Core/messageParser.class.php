<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class messageParser {
    public $Message = '';
    
	// Paletten für BBCodes
	private $BBcodeSearch = array('/\\*\*(.*)\*\*/U',
        '/\[spoiler=(.*)\](.*)\[\/spoiler\]/');
	
	private $BBcodeReplace = array('/\\*\*(.*)\*\*/U',
		'<div onclick="$(\'#$1\').slideToggle(\'slow\')" style="margin: 3px 3px 0 3px; padding:3px; border-radius: 3px 3px 0 0; background-color: #F00;"><strong>Spoiler</strong> $1</div>
		 <div id="$1" style="margin: 0 3px 3px 3px; padding:3px; border-radius: 0 0 3px 3px; background-color: #CCC;display:none;">$2</div>
		');
		
		
    /* Paletten für Markdown */
    private $MarkDownSearch = array('/\\*\*(.*)\*\*/U',
        '/_(.*)_/U',
        '/\*(.*)\*/U',
        '/`(.*)`/U',
        "/#### (.*)/",
        "/### (.*)/",
        "/## (.*)/",
        "/# (.*)/",
        "/\[(.*) \| (.*) \| (.*)\]/");
    private $MarkDownReplace = array('<strong>$1</strong>',
        '<span style="text-decoration: underline;">$1</span>',
        '<span style="font-style: italic;">$1</span>',
        '<code>$1</code>',
        '<h4>$1</h4>',
        '<h3>$1</h3>',
        '<h2>$1</h2>',
        '<h1>$1</h1>',
        '<a href="$1" title="$3">$2</a>');
    
    /* Paletten für Smilies :D */
    private $SmileySearch = array('/:\)/',
        '/:\(/',
        '/:D/',
        '/\(h\)/');
    private $SmileyReplace = array('<img style="margin-bottom: -3px;" src="images/smiley/smile.png" alt="Smile">',
        '<img style="margin-bottom: -3px;" src="images/smiley/sad.png" alt="Sad">',
        '<img style="margin-bottom: -3px;" src="images/smiley/bigsmile.png" alt="BigSmile">',
        '<img style="margin-bottom: -3px;" src="images/smiley/heart.png" alt="Heart">');

    public function parse($Message, $EnableBBCodes = true, $EnableSmilies = true, $EnableHtml = false, $EnableBBcode = true) {
        $this->Message = $Message;

        if(!$EnableHtml) {
            $this->Message = htmlentities($this->Message);
            $this->Message = nl2br($this->Message);
        }

        if($EnableBBCodes)
            $this->Message = preg_replace($this->MarkDownSearch, $this->MarkDownReplace, $this->Message);

        if($EnableSmilies)
            $this->Message = preg_replace($this->SmileySearch, $this->SmileyReplace, $this->Message);
			
        if($EnableBBcode)
           $this->Message = preg_replace($this->BBcodeSearch, $this->BBcodeReplace, $this->Message);
			
        return $this->Message;
    }
}
?>