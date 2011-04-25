<body>
	<section class="UserBar">
		<div class="Size">
			{$Username}. {$LoginLogout}
		</div>
	</section>
	<header>
		<div class="Logo Size">
			<a href="./" title="{lang=com.sbb.header.logo_title}"><img src="styles/Standard/images/Logo.png" alt="Logo"></a>
		</div>
	</header>
	<nav class="Menu">
		<div class="Size">
			<ul class="MenuList">
				<li class="active"><div>Forum</div></li>
				<li><div>Ich bin QL</div></li>
				<li><div>Cadi auch</div></li>
				<li><div>und Nut</div></li>
			</ul>
			<div class="SearchForm">
				<form method="GET" accept-charset="utf-8" action="">
					<input title="Suche" type="search" value="" placeholder="Suche..." name="Search" id="Search" pattern=".+" required><input type="submit" id="SearchSubmit" value="">
				</form>
			</div>
		</div>
	</nav>
	<section class="Content">
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					<span class="Crust">
						<a href="./" class="Crumb">Home</a>
						<span class="Arrow"><span></span></span>
					</span>
					<span class="Crust">
						<a href="./" class="Crumb">Next Crumb</a>
						<span class="Arrow"><span></span></span>
					</span>
				</nav>
				<div class="ContentContainer">
					{/* {$Teste} dich doch selbst! */}
					{$Content}
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="Size">
			FOOTER !!
		</div>
	</footer>
</body>