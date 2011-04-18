<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

class view {
	
	public static function DisplayBoard() {
		mysql::Select(DB_PREFIX.'categories', '*', NULL, 'Position ASC');
		$Categories = mysql::GetObjects();
		
		$Categorylist = '';
		if(empty($Categories))
			$Return = '{lang=com.sbb.category.empty}';
		
		foreach($Categories as $Category) {
			$pCat = new template('board_list');
			
			mysql::Select(DB_PREFIX.'forums', '*', 'Category = '.$Category->ID);
			$Forumlist = '';
			$Forums = mysql::GetObjects();
			if(empty($Forums))
				$Forumlist = '{lang=com.sbb.forum.empty}';
			
			foreach($Forums as $Forum) {
				$pForum = new template('board_forum_list');
				$pForum->Assign(array(
				'ForumTitle'		=> $Forum->ForumName,
				'ForumDescription'	=> $Forum->Description,
				'ForumID'			=> $Forum->ID));
				$Forumlist .= $pForum->Display(true);
				unset($pForum);
			}
				
			
			$pCat->Assign(array(
			'CategoryTitle'			=> $Category->CategoryName,
			'CategoryDescription'	=> $Category->Description,
			'CategoryID'			=> $Category->ID,
			'Forumlist'				=> $Forumlist));
			$Categorylist .= $pCat->Display(true);
			unset($pCat);
		}
		return $Categorylist;
	}
}
?>