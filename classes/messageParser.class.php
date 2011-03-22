<?php
class messageParser {
	protected $message = '';
	
	/* Paletten für BBCodes */
	protected $BBCodeSearch = array('/\[b\](.*)\[\/b\]/is',
					'/\[u\](.*)\[\/u\]/is',
					'/\[i\](.*)\[\/i\]/is',
					'/\[d\](.*)\[\/d\]/is',
					'/\[img\](.*)\[\/img\]/is',
					'/\[url=(.*)\](.*)\[\/i\]/is',
					'/\[h1\](.*)\[\/h1\]/is','/\[h2\](.*)\[\/h2\]/is',
					'/\[h3\](.*)\[\/h3\]/is','/\[h4\](.*)\[\/h4\]/is',
					'/\[---\]/',
					'/http:\/\/(.*)/',
					'/www.(.*)/');
	protected $BBCodeReplace = array('<strong>$1</strong>',
					'<u>$1</u>',
					'<i>$1</i>',
					'<span style="text-decoration: line-through;">$1</span>',
					'<img src="$1" />','<a href="$1">$2</a>',
					'<h1>$1</h1>','<h2>$1</h2>',
					'<h3>$1</h3>','<h4>$1</h4>',
					'<div style="height: 2px; background: black;"></div>',
					'<a href="http://$1">$1</a>',
					'<a href="http://$1">$1</a>');

	/* Paletten für Smilies :D */
	protected $smileySearch = array('/:\)/',
					'/:\(/',
					'/:D/',
					'/\(h\)/');
	protected $smileyReplace = array("<img src=\"'.PATH_SMILEY.'smile.png\" alt=\"Smile\" />",
					"<img src=\"'.PATH_SMILEY.'sad.png\" alt=\"Sad\" />",
					"<img src=\"'.PATH_SMILEY.'bigsmile.png\" alt=\"BigSmile\" />",
					"<img src=\"'.PATH_SMILEY.'heart.png\" alt=\"Heart\" />");
	
	public function parse($message, $enableBBCodes = true, $enableSmilies = true, $enableHtml = false) {
		$this->message = $message;
		
		if(!$enableHtml) {
			$this->message = htmlentities($this->message);
			$this->message = nl2br($this->message);
		}
		
		if($enableBBCodes)
			$this->message = preg_replace($this->BBCodeSearch, $this->BBCodeReplace, $this->message);
			
		if($enableSmilies)
			$this->message = preg_replace($this->smileySearch, $this->smileyReplace, $this->message);
		
		return $this->message;
	}
}
?>