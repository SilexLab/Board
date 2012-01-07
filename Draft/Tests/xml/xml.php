<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>XML-Parser Test</title>
</head>

<body>
<pre>
<?php
array(
	'name' => 'a',
	'attrs' => array(),
	'cdata' => '',
	'children' => array(
		0 => array(
			'name' => 'b',
			'attrs' => array(
				'pack' => 'blörb',
				'blub' => 'test'
			),
			'cdata' => '',
			'children' => array(
				0 => array(
					'name' => 'c',
					'attrs' => array(
						'param' => 'blub'
					),
					'cdata' => 'text',
					'children' => array()
				),
				1 => array(
					'name' => 'c',
					'attrs' => array(
						'param' => 'blab'
					),
					'cdata' => 'stuff',
					'children' => array()
				)
			)
		),
		1 => array(
			'name' => 'd',
			'attrs' => array(),
			'cdata' => '',
			'children' => array(
				0 => array(
					'name' => 'c',
					'attrs' => array(),
					'cdata' => 'code',
					'children' => array()
				)
			)
		)
	)
);

const T = "\t";
const BR = "\n";
//$Obj = simplexml_load_file('test.xml');
//print_r($Obj);
//if(!$Obj) die('error');

/*foreach($Obj->xpath('/a/b/c') as $Node) {
	echo $Node.BR;
	foreach($Node->attributes() as $Key => $Value) {
		echo T.$Key.T.$Value.BR;
	}
}*/

class XML {
	private $Obj;
	
	public function __construct($Path) {
		$this->Obj = simplexml_load_file($Path);
	}
	
	public function GetTree($Name, SimpleXMLElement $Obj = NULL) {
		if(!$Obj)
			$Obj = $this->Obj;
		
		$Tree = array(
			'name' => $Name,
			'attributes' => $this->GetAttributes($Obj),
			'cdata' => $this->GetCDATA($Obj),
			'children' => $this->GetChildren($Obj, true)
		);
		
		return $Tree;
	}
	
	public function GetAttributes(SimpleXMLElement $Obj = NULL) {
		if(!$Obj)
			$Obj = $this->Obj;
		
		$Attributes = array();
		foreach($Obj->attributes() as $Key => $Value) {
			$Attributes[$Key] = (string)$Value;
		}
		return $Attributes;
	}
	
	public function GetCDATA(SimpleXMLElement $Obj = NULL) {
		if(!$Obj)
			$Obj = $this->Obj;
		
		return (string)trim($Obj);
	}
	
	public function GetChildren(SimpleXMLElement $Obj = NULL, $Recursive = false) {
		if(!$Obj)
			$Obj = $this->Obj;
		
		$Children = array();
		foreach($Obj->children() as $Key => $Child) {
			if($Recursive)
				$Children[] = $this->GetTree($Key, $Child);
			else
				$Children[] = $Child; 
		}
		return $Children;
	}
}

$XML = new XML('test.xml');
print_r($XML->GetTree('a'));
?>
</pre>
</body>
</html>