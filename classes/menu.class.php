<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */

class menu {
	public static function Parse() {
		$Page = $_GET['page'];
		
		if($Page == '' || $Page == 'home')
			$Page = './';
		
		mysql::Select('menu','*');
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