Silex Bulletin Board coding style
=================================

PHP (and Javascript)
--------------------

###Indentation (Brace style)

In SilexBoard source we use a sort of _"the one true brace style"_ (__1TBS__) for everything.
Example:

```php
<?php
class Classname {
	protected
		$ProtectedVar,
		$Another;

	public function __construct($Var) {
		if($Var == 1) {
			for($i = 0; $i < 2; $i++) {
				$t = time();
				$Var += $i;
			}
			$Var = 2;
		} else
			$Var++;

		while($Var < 10) {
			print($Var);
			$Var++;
		}
	}
}
?>
```

###Spacing

We use tabulators to indent subordinated code.
Between the function- or statement names and their brackets there are no spaces.
Operators (except "++", "--", "::", "->" or ".") have spaces before and after.
Example:

```php
<?php
function Example($Var) {
	// Comment
	if(is_int($Var)) {
		$Var++;

		if($Var > 10)
			$Var--;
		else if($Var <= 10)
			$Var += 20;

		$Var = max(++$Var, 29);
	}
	return $Var;
}
?>
```

###Naming

In SilexBoard variables and function-/methodnames are CamelCase.
The first letter is always capitalised, except in special cases.
Example:

```php
<?php
class ExampleClass implements IExampleInterface {
	public static function DoSomething($Var) {
		for($i = 0; $i < 1; $i++)
			echo 'Whoooooooo';
		return 'Year: '.$Var;
	}
}

$VarOutput = ExampleClass::DoSomething(2012);
echo $VarOutput;
?>
```

HTML / TPL
----------
Example:

```html
<div class="class_name">
	<span id="var">{{ var_name }}</span>
	{% if var_name > 10 %}
		<div class="another_class_name">{{ var.arraykey }}</div>
	{% endif %}
</div>
```

CSS
---
Example:

```css
.class_name {
	color: #dedede;
	background: #333333;
}
	.class_name .another_class_name {
		background: white;
		border-radius: 10px 20px 5px 2px;
		padding: 10px 5px;
	}
```