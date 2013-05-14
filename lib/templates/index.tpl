<!DOCTYPE HTML>
<html{if $user.lang_code} lang="{$user.lang_code}"{/if}>
<head>{include "functions.tpl"}	<meta charset="utf-8">
	<title>{$page.title} · {$title}</title>
	<link rel="shortcut icon" href="{$base_url}favicon.ico">
{foreach $theme.files.css as $f}
	<link rel="stylesheet" type="text/css" href="{$f.file}"{if $f.media} media="{$f.media}"{/if}>
{/foreach}
{if false}{literal}<style type="text/css">body{font-family:"Comic Sans MS";}</style>{/literal}{/if}
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
			<div class="slogan">{lang n='header.slogan'}</div>
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
				<form method="post">
					<div id="main_search">
						<input type="search" name="search" placeholder="{lang n='form.search'}..." value=""><input type="submit" value="" title="{lang n='form.search'}">
					</div>
				</form>
			</div>
			<ul class="user_actions w_content_r">
				<li>
					<a id="user_panel_toggle" href="{$base_uri}Login">
						<img src="{$user.avatar}" alt="Avatar" id="user_avatar">{$user.name}
					</a>
				</li>
			</ul>
		</nav>
	</section>
	<section class="main_content">
		{if $dlog}
		<div class="debug w_size">
			<h3>Debug</h3><br>
			{$dlog}
		</div>
		{/if}
		<noscript>
			<div class="info">
				{lang n="info.javascript"}
			</div>
		</noscript>
		{* Notifications here *}
		<div class="w_size">
			{include $page.template}
		</div>
	</section>
	<footer class="main">
		<div class="w_size">
			{* Column design *}
			<div class="w_content_h">
				<div class="column left">
					<img src="{$theme.dir}icons/g_16_globe.png" alt="{lang n='footer.current_language'}"> {lang n="language.info"}<br>
					<img src="{$theme.dir}icons/g_16_brush.png" alt="{lang n='footer.current_style'}"> {$theme.name}
				</div>
				<div class="column right">
					<div class="time_graph">
						<div class="day">
							<span title="{$time.title_date}" class="date">{$time.date}</span><span title="{$time.title_time}" class="time">{$time.time}</span>
							<div class="progressbar" title="{$time.title_day}">
								<div class="progress" style="width: {$time.day_progress}%"></div>
							</div>
						</div>
						<div class="year">
							<span title="{lang n='time.current.week'}" class="week">{$time.week}</span>
							<div class="progressbar" title="{$time.title_year}">
								<div class="progress" style="width: {$time.year_progress}%"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="column center">
					<div class="about">
						Silex Bulletin Board {$sbb.version} – © 2011 - 2013 <a href="https://silexboard.org/" title="{lang n='forumsoftware'}">silexboard.org</a><br>
						<a href="{$sbb.url}" title="GitHub">{$sbb.id}</a>
					</div>
				</div>
			</div>
			<div class="os_wrapper">
				<div class="os">
					<img src="{$base_url}images/linux.png" alt="Linux"> <img src="{$base_url}images/windows.png" alt="Windows"><br>
					Made on Linux and Windows.
				</div>
			</div>
		</div>
	</footer>
{if !$debug}
</body>
</html>
{/if}
