	<section class="UserBar">
		<div class="Size">
		{% if User.ID == 0 %}
			<div id="LoginForm">
				<form method="post" accept-charset="utf-8" action="?page=Login">
					<div class="Wrap">
						<div class="LoginUserInfo">
							<ul>
								<li><input type="text" name="Username" id="Username" placeholder="{{ lang=com.sbb.login.username }}" required></li>
								<li><input type="password" name="Password" id="Password" placeholder="{{ lang=com.sbb.login.password }}" required></li>
								<li class="Clear"></li>
							</ul>
						</div>
						<div class="LoginMethod">
							<ul>
								<li><input type="radio" value="1" name="Register" id="RegisterMe"><label for="RegisterMe" class="Check"></label><label for="RegisterMe" class="Text">{{ lang=com.sbb.register.register }}</label></li>
								<li><input type="radio" value="0" name="Register" id="LogMeIn" checked><label for="LogMeIn" class="Check"></label><label for="LogMeIn" class="Text">{{ lang=com.sbb.login.login }}</label></li>
								<li class="Clear"></li>
							</ul>
						</div>
						<div class="LoginSubmit">
							<ul>
								<li><input type="submit" name="Login" id="Login" value="{{ lang=com.sbb.form.submit }}"></li>
								<li><input type="checkbox" name="StayLoggedIn" id="StayLoggedIn"><label for="StayLoggedIn" class="Check"></label><label for="StayLoggedIn" class="Text">{{ lang=com.sbb.login.stay }}</label></li>
								<li class="Clear"></li>
							</ul>
						</div>
					</div>
					<div style="clear: both;"></div>
				</form>
			</div>
			<div id="LoginBarHandle">
				<div id="LoginBarToogle">
					<div id="LoginBarInner">{{ lang=com.sbb.login.bar_handle }}</div>
				</div>
			</div>
		{% else %}
			<div class="UserTabs">
				<ul>
					<li id="Username"><a href="?page=User&amp;userID={{ User.ID }}">{{ User.Username }}</a></li>
					<li id="Settings"><a href="javascript:false;">Settings</a></li>
					<li id="Logout"><a href="?page=Logout">{{ lang=com.sbb.logout.logout }}</a></li>
				</ul>
			</div>
		{% endif %}
		</div>
	</section>