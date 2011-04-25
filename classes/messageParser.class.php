<?php
/**
 * @author		SilexBoard Team
 *					Cadillaxx
 * @copyright	2011 SilexBoard
 */

class messageParser {
    public $Message = '';
    
    /* Paletten für BBCodes */
    public $MarkDownSearch = array('/\\*\*(.*)\*\*/U',
        '/_(.*)_/U',
        '/\*(.*)\*/U',
        '/`(.*)`/U',
        "/#### (.*)/",
        "/### (.*)/",
        "/## (.*)/",
        "/# (.*)/",
        "/\[(.*) \| (.*) \| (.*)\]/");
    protected $MarkDownReplace = array('<strong>$1</strong>',
        '<span style="text-decoration: underline;">$1</span>',
        '<span style="font-style: italic;">$1</span>',
        '<code>$1</code>',
        '<h4>$1</h4>',
        '<h3>$1</h3>',
        '<h2>$1</h2>',
        '<h1>$1</h1>',
        '<a href="$1" title="$3">$2</h1>');
    
    /* Paletten für Smilies :D */
    protected $SmileySearch = array('/:\)/',
        '/:\(/',
        '/:D/',
        '/\(h\)/');
    protected $SmileyReplace = array('<img style="margin-bottom: -3px;" src="images/smiley/smile.png" alt="Smile">',
        '<img style="margin-bottom: -3px;" src="images/smiley/sad.png" alt="Sad">',
        '<img style="margin-bottom: -3px;" src="images/smiley/bigsmile.png" alt="BigSmile">',
        '<img style="margin-bottom: -3px;" src="images/smiley/heart.png" alt="Heart">');

    public function parse($Message, $EnableBBCodes = true, $EnableSmilies = true, $EnableHtml = false) {
        $this->Message = $Message;

        if(!$EnableHtml) {
            $this->Message = htmlentities($this->Message);
            $this->Message = nl2br($this->Message);
        }

        if($EnableBBCodes)
            $this->Message = preg_replace($this->MarkDownSearch, $this->MarkDownReplace, $this->Message);

        if($EnableSmilies)
            $this->Message = preg_replace($this->SmileySearch, $this->SmileyReplace, $this->Message);

        return $this->Message;
    }
}
?>