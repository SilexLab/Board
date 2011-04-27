<body>
	<section class="UserBar">
		<div class="Size">
			{/* {$Username}. {$LoginLogout} */}
			<div id="LoginForm">
				<form method="post" accept-charset="utf-8" action="?page=Login">
					<div class="Wrap">
						<ul>
							<li><label for="Username">{lang=com.sbb.login.username}:</label></li>
							<li><input type="text" name="Username" id="Username" placeholder="{lang=com.sbb.login.username}" required></li>
							<div style="clear:both;"></div>
						</ul>
						<ul>
							<li><label for="Password">{lang=com.sbb.login.password}:</label></li>
							<li><input type="Password" name="Password" id="Password" placeholder="{lang=com.sbb.login.password}" required></li>
							<div style="clear:both;"></div>
						</ul>
						
						<div class="LoginFormMethode">
							<ul>
								<li><label for="RegisterMe"><input type="radio" value="1" name="Register" id="RegisterMe"> {lang=com.sbb.register.register}</label></li>
								<li><label for="LogMeIn"><input type="radio" value="0" name="register" id="LogMeIn" checked> {lang=com.sbb.login.login}</label></li>
							</ul>
						</div>
						
						<div class="LoginFormSubmit">
							<ul>
								<li><input type="submit" name="SubmitLogin" id="SubmitLogin" value="{lang=com.sbb.form.submit}"></li>
								<li><label for="StayLoggedIn"><input type="checkbox" name="StayLoggedIn" id="StayLoggedIn"> {lang=com.sbb.login.stay}</label></li>
								<div style="clear:both;"></div>
							</ul>
						</div>
					</div>
				</form>
			</div>
			<div id="LoginBarHandle">
				<div id="LoginBarToogle">{lang=com.sbb.login.bar_handle}</div>
			</div>
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
				<li class="{$MenuListForumClass}"><a href="./"><div>Forum</div></a></li>
				<li class="{$MenuListUserListClass}"><a href="?page=User"><div>Userlist</div></a></li>
				<li><div>Ich bin QL</div></li>
				<li><div>Cadi auch</div></li>
				<li><div>und Nut</div></li>
                <li><div>Angus auch</div></li>
			</ul>
			<div class="SearchForm">
				<form method="get" accept-charset="utf-8" action="">
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