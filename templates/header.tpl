{include file="userbar.tpl"}
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
		<nav class="Menu">
			<div class="size">
				<ul class="MenuList">
				{foreach $Menu as $MenuPoint}
					{if $MenuPoint.Active}
					<li class="active"><a href="{$MenuPoint.Link}"><span>{$MenuPoint.Name}</span></a></li>
					{else}
					<li><a href="{$MenuPoint.Link}"><span>{$MenuPoint.Name}</span></a></li>
					{/if}
				{/foreach}
				</ul>
				{*<ul class="sub_menu">
				</ul>*}
				<div id="SearchForm">
					<form method="get" accept-charset="utf-8">
						<input title="{lang node="sbb.header.search.title"}" type="search" value="" placeholder="{lang node="sbb.header.search.placeholder"}" name="search" id="Search" pattern=".+" required><input type="submit" id="SearchSubmit" value="">
					</form>
				</div>
			</div>
		</nav>
	</header>