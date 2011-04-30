<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

class view {
	public static function DisplayBoard() {
		return self::GetChilds(0); // Rekursiv aufrufende Funktion
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
							<div class="CategoryTitle">'.$Member->Title.'</div>'.
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
							<div class="ForumTitle">'.$Member->Title.'</div>'.
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