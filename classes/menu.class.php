<?php
/**
 * @author		SilexBoard Team
 *					Angus, Nox Nebula
 * @copyright	2011 SilexBoard
 */

class menu {
	public static function Parse() {
		$Page = $_GET['page'];
													//    V- Kann dann durch Standardseite im ACP geändert werden
		if($Page == '' || $Page == 'Board' || $Page == 'Forum' || $Page == 'Topic')
			$Page = './';
		
		mysql::Select(DB_PREFIX.'menu','*');
		while ($row = mysql::FetchObject()) {
			if($Page == $row->Link || '?page='.$Page == $row->Link)
				$Return .= '				<li class="active"><a href="'.$row->Link.'"><div>'.$row->MenuName.'</div></a></li>';
			else
				$Return .= '				<li><a href="'.$row->Link.'"><div>'.$row->MenuName.'</div></a></li>';
		}
		return $Return;
	}
}
?>