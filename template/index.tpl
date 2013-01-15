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
	<section class="user_panel size_wrapper_min">
		<div class="size_wrapper">
			<div class="search_bar">
				{literal}{Searchbar}{/literal}
			</div>
			<div class="user_actions">
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
	<nav class="main size_wrapper">
		<ul>
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Board</a></li>
			<li><a href="#">User</a></li>
		</ul>
	</nav>
	<section class="main_content">
		{include $current_page.template}
	</section>
	<footer class="main">
		footer
{if !$debug}
	</footer>
</body>
</html>
{/if}
