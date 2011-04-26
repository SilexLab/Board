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
				<li class="{$MenuListForumClass}"><a href="./"><div>Forum</div></a></li>
				<li class="{$MenuListUserListClass}"><a href="?page=User"><div>Userlist</div></a></li>
				<li><div>Ich bin QL</div></li>
				<li><div>Cadi auch</div></li>
				<li><div>und Nut</div></li>
                <li><div>Angus auch</div></li>
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
	{$message}
	<form method="post">
		<table>
			<tr>
				<td><label for="username">{lang=com.sbb.register.username}</label></td>
				<td><input type="text" name="username" id="username" size="30" required /></td>
			</tr>
			<tr>
				<td><label for="password">{lang=com.sbb.register.password}</label></td>
				<td><input type="password" name="password" id="password" size="30" required /></td>
			</tr>
			<tr>
				<td><label for="passwordrepeat">{lang=com.sbb.register.password.repeat}</label></td>
				<td><input type="password" name="passwordrepeat" id="passwordrepeat" size="30" required /></td>
			</tr>
			<tr>
				<td><label for="email">{lang=com.sbb.register.email}</label></td>
				<td><input type="email" name="email" id="email" size="30" required /></td>
			</tr>
			<tr>
				<td><label for="emailrepeat">{lang=com.sbb.register.email.repeat}</label></td>
				<td><input type="email" name="emailrepeat" id="emailrepeat" size="30" required /></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="{lang=com.sbb.form.submit}" />
	</form>
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