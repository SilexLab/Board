<!DOCTYPE HTML>
<html{if $user.lang_code} lang="{$user.lang_code}"{/if}>
<head>
	<meta charset="utf-8">
	<title>{$page.title} · {$title}</title>
	<link rel="shortcut icon" href="{$base_url}favicon.ico">
{foreach $style.files.css as $f}
	<link rel="stylesheet" type="text/css" href="{$f.file}"{if $f.media} media="{$f.media}"{/if}>
{/foreach}
{foreach $style.files.js as $f}
	<script type="text/javascript" src="{$f}"></script>
{/foreach}
</head>
<body>
	<section class="user_panel w_size_min">
		<div class="user_panel_content">
			<div class="w_size">
				<div class="w_content_h">
					test
				</div>
			</div>
		</div>
		<div class="w_size">
			<div class="search_bar w_content_l">
				{literal}{Searchbar}{/literal}
			</div>
			<div class="user_actions w_content_r">
				<div class="user_info">
					{literal}{Avatar}{/literal} {$user.name}
				</div>
				<div class="user_menu">
					<span id="login_bar_toggle">Login du Sack</span>
				</div>
			</div>
		</div>
	</section>
	<header class="main">
		<div class="logo w_size">
			<a href="{$base_url}">
				<img class="w_content_m_l" src="{$style.dir}images/logo.png" alt="Logo">
			</a>
			<div class="slogan">{lang node="header.slogan"}</div>
		</div>
	</header>
	<nav class="site w_size">
		<ul class="w_content_r">
			{foreach $nav as $item}
				<li{($item.active) ? ' class="active"' : ''}><a href="{$item.link}">{$item.name}</a></li>
			{/foreach}
		</ul>
	</nav>
	<noscript>
		<div class="info">
			{lang node="info.javascript"}
		</div>
	</noscript>
	<section class="main_content">
		<div class="w_size">
			{include $page.template}
		</div>
	</section>
	<footer class="main">
		<div class="w_size">
			<div class="w_content_h">
				footer
			</div>
		</div>
	</footer>
{if !$debug}
</body>
</html>
{/if}
