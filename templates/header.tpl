{$:userbar}
	<header>
		<div class="Logo Size">
			<a href="./" title="{lang=com.sbb.header.logo_title}"><img src="styles/Standard/images/Logo.png" alt="Logo"></a>
		</div>
	</header>
	<nav class="Menu">
		<div class="Size">
			<ul class="MenuList">
				{$Menu}
			</ul>
			<div class="SearchForm">
				<form method="get" accept-charset="utf-8" action="">
					<input title="Suche" type="search" value="" placeholder="Suche..." name="Search" id="Search" pattern=".+" required><input type="submit" id="SearchSubmit" value="">
				</form>
			</div>
		</div>
	</nav>
