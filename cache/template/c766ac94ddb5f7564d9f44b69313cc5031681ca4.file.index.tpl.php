<?php /* Smarty version Smarty-3.1-DEV, created on 2013-02-06 00:36:46
         compiled from "/var/www/board/template/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2335369005111978e087915-16225231%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c766ac94ddb5f7564d9f44b69313cc5031681ca4' => 
    array (
      0 => '/var/www/board/template/index.tpl',
      1 => 1360020806,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2335369005111978e087915-16225231',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'page' => 0,
    'title' => 0,
    'base_url' => 0,
    'style' => 0,
    'f' => 0,
    'nav' => 0,
    'item' => 0,
    'debug' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5111978e3f1b19_14798378',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5111978e3f1b19_14798378')) {function content_5111978e3f1b19_14798378($_smarty_tpl) {?><?php if (!is_callable('smarty_function_lang')) include '/var/www/board/lib/smarty/plugins/function.lang.php';
?><!DOCTYPE HTML>
<html<?php if ($_smarty_tpl->tpl_vars['user']->value['lang_code']){?> lang="<?php echo $_smarty_tpl->tpl_vars['user']->value['lang_code'];?>
"<?php }?>>
<head>
	<meta charset="utf-8">
	<title><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
 · <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
favicon.ico">
<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['style']->value['files']['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['f']->value['file'];?>
"<?php if ($_smarty_tpl->tpl_vars['f']->value['media']){?> media="<?php echo $_smarty_tpl->tpl_vars['f']->value['media'];?>
"<?php }?>>
<?php } ?>
<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['style']->value['files']['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['f']->value;?>
"></script>
<?php } ?>
</head>
<body>
	<section class="user_panel w_size_min">
		<div id="user_panel_content">
			<div class="w_size">
				<div class="w_content_h">
					Userpanel test thing<br>
					With many lines<br>
					and<br>
					Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
				</div>
			</div>
		</div>
		<div class="w_size">
			<div class="search_bar w_content_l">
				{Searchbar}
			</div>
			<div class="user_actions w_content_r">
				<div class="user_info">
					{Avatar} <?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>

				</div>
				<div class="user_menu">
					<span id="user_panel_toggle">Login du Sack</span>
				</div>
			</div>
		</div>
	</section>
	<header class="main">
		<div class="logo w_size">
			<a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
">
				<img class="w_content_m_l" src="<?php echo $_smarty_tpl->tpl_vars['style']->value['dir'];?>
images/logo.png" alt="Logo">
			</a>
			<div class="slogan"><?php echo smarty_function_lang(array('node'=>"header.slogan"),$_smarty_tpl);?>
</div>
		</div>
	</header>
	<nav class="site w_size">
		<ul class="w_content_r">
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
				<li<?php echo $_smarty_tpl->tpl_vars['item']->value['active'] ? ' class="active"' : '';?>
><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></li>
			<?php } ?>
		</ul>
	</nav>
	<noscript>
		<div class="info">
			<?php echo smarty_function_lang(array('node'=>"info.javascript"),$_smarty_tpl);?>

		</div>
	</noscript>
	<section class="main_content">
		<div class="w_size">
			<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['page']->value['template'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		</div>
	</section>
	<footer class="main">
		<div class="w_size">
			<div class="w_content_h">
				footer
			</div>
		</div>
	</footer>
<?php if (!$_smarty_tpl->tpl_vars['debug']->value){?>
</body>
</html>
<?php }?>
<?php }} ?>