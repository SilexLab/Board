<?php /* Smarty version Smarty-3.1-DEV, created on 2013-02-06 00:36:46
         compiled from "/var/www/board/template/PageHome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13330430235111978e424e68-00198378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab0780d1d730679dc13e9d8228353751fb59cefa' => 
    array (
      0 => '/var/www/board/template/PageHome.tpl',
      1 => 1359307431,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13330430235111978e424e68-00198378',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5111978e4526a0_62631018',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5111978e4526a0_62631018')) {function content_5111978e4526a0_62631018($_smarty_tpl) {?><div class="w_content">
	<h1>Home</h1>
	Hallo <strong><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</strong>
</div><?php }} ?>