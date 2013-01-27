<!DOCTYPE HTML>
<html{if $user.lang_code} lang="{$user.lang_code}"{/if}>
<head>
	<meta charset="utf-8">
	<title>{$current_page.title} · {$title}</title>
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
	</header>
	<nav class="main w_size">
		<ul class="w_content_r">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Board</a></li>
			<li><a href="#">User</a></li>
		</ul>
	</nav>
	<section class="main_content w_size">
		{include $current_page.template}
	</section>
	<footer class="main w_size">
		<div class="w_content_h">
			footer
		</div>
	</footer>
{if !$debug}
</body>
</html>
{/if}
