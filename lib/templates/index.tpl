<!DOCTYPE HTML>
<html{if $user.lang_code} lang="{$user.lang_code}"{/if}>
<head>{include "functions.tpl"}	<meta charset="utf-8">
	<title>{$page.title} · {$title}</title>
	<link rel="shortcut icon" href="{$base_url}favicon.ico">
{foreach $theme.files.css as $f}
	<link rel="stylesheet" type="text/css" href="{$f.file}"{if $f.media} media="{$f.media}"{/if}>
{/foreach}
{foreach $theme.files.js as $f}
	<script type="text/javascript" src="{$f}"></script>
{/foreach}
</head>
<body>
	<header class="main">
		<div class="logo w_size">
			<a href="{$base_url}">
				<img class="w_content_m_l" src="{$theme.logo}" alt="Logo">
			</a>
			<div class="slogan">{lang node="header.slogan"}</div>
		</div>
	</header>
	<nav class="site w_size">
		<ul class="w_content_r">
			{foreach $nav.site as $item}
				<li{($item.active) ? ' class="active"' : ''}><a href="{$item.link}">{$item.name}</a></li>
			{/foreach}
		</ul>
	</nav>
	<section class="user_panel w_min_size">
		<div id="user_panel_content">
			<div class="w_size">
				<div class="w_content" id="user_panel_content_inner">
					Userpanel test thing<br>
					With many lines<br>
					and<br>
					Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
				</div>
			</div>
		</div>
		<nav class="user w_size">
			<div class="search_bar w_content_l">
				{literal}{Searchbar}{/literal}
			</div>
			<ul class="user_actions w_content_r">
				<li><a id="user_panel_toggle" href="{$base_uri}Login">{literal}{Avatar}{/literal} {$user.name}</a></li>
			</ul>
		</nav>
	</section>
	<section class="main_content">
		<noscript>
			<div class="info">
				{lang node="info.javascript"}
			</div>
		</noscript>
		{* Notifications here *}
		<div class="w_size">
			{include $page.template}
		</div>
	</section>
	<footer class="main">
		<div class="w_size">
			<div class="w_content_h">
				<div class="time_graph">
					<div class="date">
						#
					</div>
				</div>
				<img src="{$theme.dir}icons/g_16_globe.png" alt="{lang node='footer.current_language'}"> {lang node="language.info"}<br>
				<img src="{$theme.dir}icons/g_16_brush.png" alt="{lang node='footer.current_style'}"> {$theme.name}<br>
				<br><br>
				<div class="os">
					<img src="images/linux.png" alt="Linux"> <img src="images/windows.png" alt="Windows"> Made on Linux and Windows.
				</div>
				<div class="about">
					Silex Bulletin Board {$sbb.version} – © 2011 - 2013 <a href="https://silexboard.org/" title="{lang node='forumsoftware'}">silexboard.org</a><br>
					<a href="https://github.com/SilexBoard/Board/commit/{$sbb.sha}" title="GitHub">{$sbb.sha}</a>
				</div>
			</div>
		</div>
	</footer>
{if !$debug}
</body>
</html>
{/if}
