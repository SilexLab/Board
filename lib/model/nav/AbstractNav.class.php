<?php

abstract class AbstractNav {
	abstract public function GetList();
	abstract public function Add($Name, $Link, $Target = false);
	abstract public function Remove($Name);
}
