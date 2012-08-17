<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.lang.php
 * Type:     function
 * Name:     lang
 * Purpose:  replace language strings
 * -------------------------------------------------------------
 */
function smarty_function_lang($params, Smarty_Internal_Template $template)
{
	return Language::Get($params['node']);
}
?>