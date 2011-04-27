<?php
/**
 * @author		SilexBoard Team
 *					Nox Nebula
 * @copyright	2011 SilexBoard
 */
 
 class menu {
	 
	 public static function Parse($active = '') {
		mysql::Select('menu','*'); 
		while ($row = mysql::FetchObject()) {
			if($active == $row->MenuName) {
				$Return .= '				<li class="active"><a href="'.$row->Link.'"><div>'.$row->MenuName.'</div></a></li>';				
			}
			else {
				$Return .= '				<li><a href="'.$row->Link.'"><div>'.$row->MenuName.'</div></a></li>';	
			}
		}
		return $Return;
	 } 
}
 
 ?>