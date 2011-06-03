<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

class Avatar {
    protected $Email;

    public function  __construct($Email, $Size) {
        $this->Email = $Email;
        $this->Size = $Size;
        $this->URL = "http://www.gravatar.com/avatar/".md5(strtolower(trim($this->Email)))."?d=mm&amp;s=".$this->Size;
    }

    public function GetURL() {
        return $this->URL;
    }

    public function  __toString() {
        return '<img src="'.$this->GetURL().'" style="width: '.$this->Size.'px; height: '.$this->Size.'px" alt="" />';
    }
}
?>