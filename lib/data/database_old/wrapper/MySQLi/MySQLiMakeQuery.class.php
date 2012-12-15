<?php
/**
 * @author     Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class MySQLiMakeQuery {
	public
		$Query = '';
	private
		$DB    = null,
		$Table = '';

	public function __construct($QueryList, Database $DB) {
		$this->DB = $DB;
		foreach ($QueryList as $Q) {
			if(isset($Q[0]['QUERY']))
				$this->Query .= $this->Query($Q[0]['QUERY']);
			else if(isset($Q[0]['TABLE']))
				$this->Query .= $this->FromList($Q).' ';
			else
				throw new DatabaseException('Undefinied query type', 0);
		}
		$this->Query = trim($this->Query);
	}

	private function Query($Query) {
		if($Query{strlen($Query) - 1} == ';')
			return $Query;
		if($Query{strlen($Query) - 1} == ' ')
			$Query = $this->Query(trim($Query));
		return $Query.'; ';
	}

	private function FromList($Q) {
		$this->Table = '`'.$Q[0]['TABLE'].'`';
		switch($Q[1]['TYPE']) {
			case 'SELECT':
				return $this->Select($Q);
			case 'INSERT':
				return $this->Insert($Q);
			case 'UPDATE':
				return $this->Update($Q);
			case 'REPLACE':
				return $this->Replace($Q);
			case 'DELETE':
				return $this->Delete($Q);
			case 'EXISTS':
				return $this->Exists($Q);
			default:
				throw new DatabaseException('"'.$Q[1]['TYPE'].'" is not a valid query action', 0);
		}
	}

	private function Select($Q) {
		return 'SELECT '.$this->MakeColumns($Q[1]['VALUE']).' FROM '.$this->Table.$this->AddSpecifications($Q);
	}

	private function Insert($Q) {
		$Col = $this->MakeWriteColumns($Q[1]['VALUE']);
		return 'INSERT INTO '.$this->Table.' ('.trim($Col[0], ', ').') VALUES ('.trim($Col[1], ', ').');';
	}

	private function Update($Q) {
		$Updates = '';
		foreach($Q[1]['VALUE'] as $Column => $Value) {
			$Updates .= '`'.trim($Column, '`').'` = '.(is_string($Value) ?
				'\''.$this->DB->EscapeString($Value).'\'' :
				$this->DB->EscapeString($Value)).', ';
		}
		
		return 'UPDATE '.$this->Table.' SET '.trim($Updates, ', ').$this->AddSpecifications($Q);
	}

	private function Replace($Q) {
		$Col = $this->MakeWriteColumns($Q[1]['VALUE']);
		return 'REPLACE INTO '.$this->Table.' ('.trim($Col[0], ', ').') VALUES ('.trim($Col[1], ', ').');';
	}

	private function Delete($Q) {
		return 'DELETE FROM '.$this->Table.$this->AddSpecifications($Q);
	}

	private function Exists($Q) {
		if(!isset($Q[2]['WHERE']))
			throw new DatabaseException('The Exists Command have to be in this form: "(...)->Table(...)->Exists()->Where(...);", the Where is missing', 0);
			
		return 'SELECT * FROM '.$this->Table.' WHERE '.$Q[2]['WHERE'].';';
	}

	private function MakeColumns($C) {
		if(is_array($C)) {
			$tmpC = '';
			foreach($C as $Column)
				$tmpC .= '`'.$Column.'`, ';
			return rtrim($tmpC, ', ');
		}
		return $C == '*' ? $C : '`'.trim($C, '`').'`';
	}

	private function MakeWriteColumns(array $C) {
		$Columns = '';
		$Values = '';
		foreach($C as $Column => $Value) {
			$Columns .= '`'.trim($Column, '`').'`, ';
			$Values .= (is_string($Value) ? '\''.$this->DB->EscapeString($Value).'\'' : $this->DB->EscapeString($Value)).', ';
		}
		return array($Columns, $Values);
	}

	private function AddSpecifications($Q) {
		$Query = '';
		$P = array('WHERE' => 0, 'ORDER' => 0, 'LIMIT' => 0);
		$C = array('WHERE', 'ORDER', 'LIMIT');
		for($i = 2; $i < sizeof($Q); $i++)
			for($j = 0; $j < 3; $j++)
				if(isset($Q[$i][$C[$j]]))
					$P[$C[$j]] = $i;

		if($P['WHERE'])
			$Query .= ' WHERE '.$Q[$P['WHERE']]['WHERE'];
		if($P['ORDER'])
			$Query .= $this->MakeOrder($Q[$P['ORDER']]['ORDER']);
		if($P['LIMIT'])
			$Query .= ' LIMIT '.$Q[$P['LIMIT']]['LIMIT'];
		
		return $Query.';';
	}

	private function MakeOrder(array $O) {
		$Columns = $this->MakeColumns($O[0]);
		$SortDirection = $O[1] ? 'ASC' : 'DESC';
		
		return ' ORDER BY '.$Columns.' '.$SortDirection;
	}
}
?>