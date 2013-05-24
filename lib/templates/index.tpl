<!DOCTYPE HTML>
<html{if $user.lang_code} lang="{$user.lang_code}"{/if}>
<head>
	<meta charset="utf-8">
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
					<form method="POST">
						<h2>{lang n='form.login'}</h2>
						{input n="user" type="user" placeholder={lang n='form.user'}}
						{input n="password" type="password" placeholder={lang n='form.password'}}
						<input type="submit" name="login" value="{lang n='form.login'}" class="highlight inline">
						<input type="submit" name="register" value="{lang n='form.register'}" class="inline">
					</form>
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
		<div class="notification">
			<noscript>
				<div class="info">
					{lang n="info.javascript"}
				</div>
			</noscript>
			{*Tösts:
			<div class="info">
				{lang n="info.javascript"}
			</div>
			<div class="error">
				{lang n="info.javascript"}
			</div>
			<div class="warning">
				{lang n="info.javascript"}
			</div>
			<div class="success">
				{lang n="info.javascript"}
			</div>*}
			{* TODO: Notifications here *}
		</div>
		<div class="w_size">
			{breadcrumbs}
			{include $page.template}
			{breadcrumbs}
		</div>
	</section>
	<footer class="main">
		<div class="w_size">
			<div class="w_content_h">
				<div class="column left">
					<div title="{lang n='footer.current_language'}" class="current_language">{lang n="language.info"}</div>
					<div title="{lang n='footer.current_style'}" class="current_theme">{$theme.name}</div>
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
