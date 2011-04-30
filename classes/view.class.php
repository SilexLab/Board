<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

class view {
	public static $BoardTitle, $BoardID;
	
	private static $Crumbs = array();
	
	public static function DisplayOverview() {
		return self::GetChilds(0); // Rekursiv aufrufende Funktion
	}
	
	public static function DisplayBoard($ID) {
		$ID = intval($ID);
		if($ID == 0)
			return '{lang=com.sbb.board.error.no_board}';
		
		self::$BoardID = $ID;
		mysql::Select(DB_PREFIX.'forums', 'Title, Parent', 'ID = '.$ID, NULL, 1);
		$Board = mysql::FetchObject();
		
		self::$BoardTitle = $Board->Title;
		self::GetCrumbs($Board->Parent);
		
		// Ab hier dann Foren/Kategorien und Themen im Forum auslesen (Rekursion?)
		//
		
		return 'Hier kommen die Foren der Kategorie ID \''.$ID.'\' hin.';
	}
	
	private static function GetCrumbs($Parent) {
		if($Parent != 0)
			self::AddCrumb($Parent);
		
		// Array rückwärts auslesen und Crumbs erzeugen
		$Crumbs =& self::$Crumbs;
		
		for($i = sizeof($Crumbs) - 1; $i >= 0; $i--) {
			mysql::Select(DB_PREFIX.'forums', 'Title', 'ID = '.$Crumbs[$i], NULL, 1);
			$Crumb = mysql::FetchObject();
			crumb::Add($Crumb->Title, '?page=Board&BoardID='.$Crumbs[$i]);
		}
		crumb::Add(self::$BoardTitle, '?page=Board&BoardID='.self::$BoardID);
	}
	private static function AddCrumb($BoardID) {
		if($BoardID != 0) {
			self::$Crumbs[] = $BoardID;
			
			mysql::Select(DB_PREFIX.'forums', 'Parent', 'ID = '.$BoardID, NULL, 1);
			$Board = mysql::FetchObject();
			self::AddCrumb($Board->Parent);
		} else
			return;
	}
	
	private static function GetChilds($Parent) {
		mysql::Select(DB_PREFIX.'forums', '*', 'Parent = '.$Parent, 'Position ASC');
		
		$Parts = '';
		
		$Members = mysql::GetObjects();
		if(empty($Members))
			return $Parent == 0 ? '{lang=com.sbb.board.empty}' : ''; // Hat keine Kinder
		
		foreach($Members as $Member) {
			switch ($Member->Type) {
				case Types::$CATEGORY: {
					$Parts .= '<li class="Category" id="Category'.$Member->ID.'">
						<div class="CategoryHead">
							<a href="?page=Board&BoardID='.$Member->ID.'">
								<div class="CategoryTitle">'.$Member->Title.'</div>
							</a>'.
							(!empty($Member->Description) ?
								'<div class="CategoryDescription">'.$Member->Description.'</div>' :
								''
							)
						.'</div>
						'.self::GetChilds($Member->ID).'
					</li>';
					break;
				} case Types::$FORUM: {
					$Parts .= '<li class="Forum" id="Forum'.$Member->ID.'">
						<div class="ForumContainer">
							<a href="?page=Board&BoardID='.$Member->ID.'">
								<div class="ForumTitle">'.$Member->Title.'</div>
							</a>'.
							(!empty($Member->Description) ?
								'<div class="ForumDescription">'.$Member->Description.'</div>' :
								''
							)
						.'</div>
						'.self::GetChilds($Member->ID).'
					</li>';
					break;
				} case Types::$REFERENCE: {
					$Parts .= '<li class="Reference" id="Reference'.$Member->ID.'">
						<div class="ReferenceContainer">
							<div class="ReferenceTitle">'.$Member->Title.'</div>'.
							(!empty($Member->Description) ?
								'<div class="ReferenceDescription">'.$Member->Description.'</div>' :
								''
							)
						.'</div>
						'.self::GetChilds($Member->ID).'
					</li>';
					break;
				} default:
					$Parts .= '<li><span class="ParseError">{lang=com.sbb.board.not_categorized}</span></li>';
			}
		}
		
		return '<ul '.($Parent == 0 ? 'class="Boardlist" ' : '').'>
			'.$Parts.'
		</ul>';
	}
}

class Types {
	public static
	$CATEGORY	= 0,
	$FORUM		= 1,
	$REFERENCE	= 2;
}
?>