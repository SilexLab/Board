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
								<li class="Clear"></li>
							</ul>
						</div>
						<div class="login_method">
							<ul>
								<li><input type="radio" value="1" name="Register" id="RegisterMe"><label for="RegisterMe" class="Check"></label><label for="RegisterMe" class="Text">{lang node="sbb.register.register"}</label></li>
								<li><input type="radio" value="0" name="Register" id="LogMeIn" checked><label for="LogMeIn" class="Check"></label><label for="LogMeIn" class="Text">{lang node="sbb.login.login"}</label></li>
								<li class="Clear"></li>
							</ul>
						</div>
						<div class="login_submit">
							<ul>
								<li><input type="submit" name="Login" id="Login" value="{lang node="sbb.form.submit"}"></li>
								<li><input type="checkbox" name="StayLoggedIn" id="StayLoggedIn"><label for="StayLoggedIn" class="Check"></label><label for="StayLoggedIn" class="Text">{lang node="sbb.login.stay"}</label></li>
								<li class="Clear"></li>
							</ul>
						</div>
					</div>
					<div style="clear: both;"></div>
				</form>
			</div>
			<div id="login_bar_handle">
				<div id="login_bar_toggle">
					<div id="login_bar_inner">{lang node="sbb.login.bar_handle"}</div>
				</div>
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