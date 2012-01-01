<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SQL {
	private static $Table, $DB;
	
	// Make a query string from a querylist
	public static function Make(array $List, &$Database, $Prepared = false) {
		self::$Table = '`'.trim($List['TABLE'], '`').'`';
		self::$DB = $Database;
		
		if(isset($List['SELECT']))
			return self::MakeSelect($List);
		
		if(isset($List['INSERT']))
			return self::MakeInsert($List, $Prepared);
			
		if(isset($List['REPLACE']))
			return self::MakeReplace($List, $Prepared);
		
		if(isset($List['UPDATE']))
			return self::MakeUpdate($List, $Prepared);
		
		if(isset($List['DELETE']))
			return self::MakeDelete($List);
		
		if(isset($List['EXISTS']))
			return self::MakeExists($List);
		
		if(isset($List['QUERY']))
			return $List['QUERY'];
		
		return false;
	}
	
// Make Queries
	private static function MakeSelect($L) {
		$Query = 'SELECT '.self::MakeColumns($L['SELECT']).' FROM '.self::$Table;
		if(isset($L['WHERE']))
			$Query .= ' WHERE '.$L['WHERE'];
		if(isset($L['ORDER']))
			$Query .= self::MakeOrder($L['ORDER']);
		if(isset($L['LIMIT']))
			$Query .= ' LIMIT '.$L['LIMIT'];
		
		return $Query.';';
	}
	
	private static function MakeInsert($L, $P) {
		$Columns = '';
		$Values = '';
		foreach($L['INSERT'] as $Column => $Value) {
			$Columns .= '`'.trim($Column, '`').'`, ';
			
			if($P)
				$Values .= '?, ';
			else
				$Values .= (is_numeric($Value) ?
							self::$DB->RealEscapeString($Value) :
							'\''.self::$DB->RealEscapeString($Value).'\'').', ';
		}
		
		return 'INSERT INTO '.self::$Table.' ('.trim($Columns, ', ').') VALUES ('.trim($Values, ', ').');';
	}
	
	private static function MakeReplace($L, $P) {
		$Columns = '';
		$Values = '';
		foreach($L['REPLACE'] as $Column => $Value) {
			$Columns .= '`'.trim($Column, '`').'`, ';
			
			if($P)
				$Values .= '?, ';
			else
				$Values .= (is_numeric($Value) ?
							self::$DB->RealEscapeString($Value) :
							'\''.self::$DB->RealEscapeString($Value).'\'').', ';
		}
		
		return 'REPLACE INTO '.self::$Table.' ('.trim($Columns, ', ').') VALUES ('.trim($Values, ', ').');';
	}
	
	private static function MakeUpdate($L, $P) {
		if(!isset($L['WHERE']))
			return false;
		
		$Updates = '';
		foreach($L['UPDATE'] as $Column => $Value) {
			if($P)
				$Updates .= '`'.trim($Column, '`').'` = ?, ';
			else
				$Updates .= '`'.trim($Column, '`').'` = '.(is_numeric($Value) ?
							self::$DB->RealEscapeString($Value) :
							'\''.self::$DB->RealEscapeString($Value).'\'').', ';
		}
		
		return 'UPDATE '.self::$Table.' SET '.trim($Updates, ', ').' WHERE '.$L['WHERE'].';';
	}
	
	private static function MakeDelete($L) {
		if(!isset($L['WHERE']))
			return false;
		
		return 'DELETE FROM '.self::$Table.' WHERE '.$L['WHERE'].';';
	}
	
	private static function MakeExists($L) {
		if(!isset($L['WHERE']))
			return false;
		
		return 'SELECT * FROM '.self::$Table.' WHERE '.$L['WHERE'].';';
	}
	
	private static function MakeColumns($C) {
		if(is_array($C)) {
			$tmpC = '';
			foreach($C as $Column)
				$tmpC .= '`'.$Column.'`, ';
			return rtrim($tmpC, ', ');
		}
		return $C == '*' ? $C : '`'.trim($C, '`').'`';
	}
	
	/*private static function MakeWhere(array $W) {
		$Wheres = '';
		foreach($W as $Where) {
			$Operator = trim(strtoupper($Where[1]));
			if(!in_array($Operator, array('=', '<>', '!=', '>', '<', '>=', '<=', 'BETWEEN', 'LIKE', 'IN')))
				return '';
			
			$Value = $Where[2];
			if(!is_numeric($Value))
				$Value = '\''.$Value.'\'';
			
			$Wheres .= '`'.$Where[0].'` '.$Operator.' '.$Value.' AND ';
		}
		return ' WHERE '.trim($Wheres, ' AND ').';';
	}*/
	
	private static function MakeOrder(array $O) {
		$Columns = self::MakeColumns($O[0]);
		$SortDirection = $O[1] ? 'ASC' : 'DESC';
		
		return ' ORDER BY '.$Columns.' '.$SortDirection;
	}
}
?>