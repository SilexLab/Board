<?php /* Smarty version Smarty-3.1-DEV, created on 2013-02-10 00:00:45
         compiled from "/var/www/board/lib/views/PageHome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:968837235116d51d98d632-92653954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '226e4fe0c8844c25bb31d1f6346d3f193f6279db' => 
    array (
      0 => '/var/www/board/lib/views/PageHome.tpl',
      1 => 1359307431,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '968837235116d51d98d632-92653954',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5116d51d995ee2_00999765',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5116d51d995ee2_00999765')) {function content_5116d51d995ee2_00999765($_smarty_tpl) {?><div class="w_content">
	<h1>Home</h1>
	Hallo <strong><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</strong>
</div><?php }} ?>