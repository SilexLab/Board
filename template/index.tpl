<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>{$page.title} - {$page_title}</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="{$style.dir}style.php?p={$page.page}">

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" src="js/jquery.animate-shadow-min.js"></script>
	{foreach $style.files.js as $file}
		<script src="{$file|escape}" type="text/javascript"></script>
	{/foreach}
</head>
<body>
	<section class="site_container min_size">
		{* userbar *}
		<section class="user_bar">
			<div class="size">
			{if $User.ID == 0}
				<div id="login_form">
					<form method="post" accept-charset="utf-8">
						<div class="wrap">
							<div class="login_user_info">
								<ul>
									<li><input type="text" name="username" id="username" placeholder="{lang node="sbb.login.username"}" required></li>
									<li><input type="password" name="Password" id="Password" placeholder="{lang node="sbb.login.password"}"></li>
								</ul>
							</div>
							<div class="login_method">
								<ul>
									<li><input type="radio" value="1" name="Register" id="RegisterMe"><label for="RegisterMe"></label><label for="RegisterMe">{lang node="sbb.register.register"}</label></li>
									<li><input type="radio" value="0" name="Register" id="LogMeIn" checked><label for="LogMeIn"></label><label for="LogMeIn">{lang node="sbb.login.login"}</label></li>
								</ul>
							</div>
							<div class="login_submit">
								<ul>
									<li><input type="submit" name="Login" id="Login" value="{lang node="sbb.form.submit"}"></li>
									<li><input type="checkbox" name="StayLoggedIn" id="StayLoggedIn"><label for="StayLoggedIn"></label><label for="StayLoggedIn">{lang node="sbb.login.stay"}</label></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
				<div id="login_bar_handle">
					<a href="?page=Login" id="login_bar_toggle"> {* TODO: Make Link *}
						<span id="login_bar_inner">{lang node="sbb.login.bar_handle"}</span>
					</a>
				</div>
			{else}
				<div class="user_tabs">
					<ul>
						<li id="username"><a href="?page=User&amp;UserID={$User.ID}">{$User.Name}</a></li>
						<li id="settings"><a href="javascript:false;">settings</a></li>
						<li id="logout"><form method="post"><input type="submit" name="Logout" value="{lang node="sbb.logout.logout"}"></form></li>
					</ul>
				</div>
			{/if}
			</div>
		</section>
		{* header *}
		<header class="min_size">
			<div class="logo_block">
				<div class="logo size">
					<a href="./" title="{lang node="sbb.header.logo_title"}">
						<img src="{$logo}" alt="Logo">
					</a>
					<div class="slogan">
						{lang node="sbb.header.slogan"}
					</div>
				</div>
			</div>
		</header>
		<nav class="menu">
			<div class="size">
				<ul class="menu_list">
				{foreach $Menu as $menu_item}
					<li{($menu_item.Active) ? ' class="active"' : ''}><a href="{$menu_item.Link}">{$menu_item.Name}</a></li>
				{/foreach}
				</ul>
				{*<ul class="sub_menu">
				</ul>*}
				<div id="search_form">
					<form method="get" accept-charset="utf-8" action="?page=search"> {* TODO: Make Link *}
						<input title="{lang node="sbb.header.search.title"}" type="search" value="" placeholder="{lang node="sbb.header.search.placeholder"}" name="search" id="search" pattern=".+" required><input type="submit" id="search_submit" value="">
					</form>
				</div>
			</div>
		</nav>
		{* body *}
		<section class="content">
			{* notifications *}
			{foreach $notifications as $notification}
				<div class="notification {$notification.type}">
					<div class="notification_inner">
						<div class="size">
							<div class="notification_content">{$notification.message}</div>
						</div>
					</div>
				</div>
			{/foreach}
			{* page content *}
			<div class="size">
				{* breadcrumbs *}
				<div class="container">
					<nav class="bread_crumbs">
						{foreach $crumbs as $crumb}
							<div class="crust">
								<a href="{$crumb.link}" class="crumb">
									<span class="crumb_wrap">{$crumb.title}</span>
								</a>
							</div>
						{/foreach}
					</nav>
				</div>
				{* page *}

				{$include_page=$page.template|default:'Home'}
				{include file="$include_page"}

				{* breadcrumbs again*}
				<div class="container">
					<nav class="bread_crumbs">
						{foreach $crumbs as $crumb}
							<div class="crust">
								<a href="{$crumb.link}" class="crumb">
									<span class="crumb_wrap">{$crumb.title}</span>
								</a>
							</div>
						{/foreach}
					</nav>
				</div>
			</div>
		</section>
		{* footer *}
		<footer class="min_size">
			<div class="size">
				<div class="time">
					<div class="date">
						<div class="d_date" title="{lang node="sbb.footer.current_date"}">{$time.date}</div>
						<div class="d_time" title="{lang node="sbb.footer.current_time"}">{$time.time}</div>
					</div>
					<div class="progressbar_trim day">
						<div class="progressbar" title="{lang node="sbb.time.dayprogress"}">
							<div class="progress" style="width: {$time.d_percent}%;">
								<div class="shine"></div>
							</div>
						</div>
					</div>
					<div class="progressbar_trim year">
						<div class="progressbar" title="{lang node="sbb.time.progress"}">
							<div class="progress" style="width: {$time.y_percent}%;">
								<div class="shine"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="info">
					<div class="i_language" title="{lang node="sbb.footer.current_language"}">{lang node="sbb.language.info"}</div>
					<div class="i_style" title="{lang node="sbb.footer.current_style"}">{$style.name}</div>
				</div>
				{*<div style="clear: both;"></div>*}
			</div>
			<div class="Legal">
				<div class="size">
					<a href="http://www.silexboard.org/">
						<span class="Copyright">{lang node="sbb.forumsoftware"}:</span> Silex Bulletin Board {$version.full} <span class="Copyright">–</span> © 2011 - 2012 SilexBoard.org
					</a><br>
					<a href="https://github.com/SilexBoard/Board/commit/{$version.sha}">
						<span class="Copyright">{$version.sha}</span>
					</a>
				</div>
			</div>
		</footer>
	</section>
</body>
</html>