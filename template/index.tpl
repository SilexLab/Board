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
					Login du Sack
				</div>
			</div>
		</div>
	</section>
	<header class="main size_wrapper_min">
	</header>
	<nav class="main size_wrapper">
		<ul>
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Board</a></li>
			<li><a href="#">User</a></li>
		</ul>
	</nav>
	<section class="main_content">
		<nav class="sub">
			<ul>
				<li class="active">All</li>
				<li>Team</li>
				<li>Search</li>
				<li>Banned</li>
			</ul>
		</nav>
		<div class="content_wrapper">
			<h1>Content headline</h1>
			Content<br>
			Content<br>
			asdisdfjlksdjfklsajdf kljsadklfjsdklfsd afsdafsdContent<br>
			asfnjaklsdfj89weur 0rew789as zudf89azu uids
		</div>
	</section>
	<footer class="main">
		footer
{if !$debug}
	</footer>
</body>
</html>
{/if}
