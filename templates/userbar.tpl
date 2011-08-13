	<section class="UserBar">
		<div class="Size">
		{% if not User.LoggedIn %}
			<div id="LoginForm">
				<form method="post" accept-charset="utf-8" action="?page=Login">
					<div class="Wrap">
						<ul>
							<li><label for="Username">{{ lang=com.sbb.login.username }}:</label></li>
							<li><input type="text" name="Username" id="Username" placeholder="{{ lang=com.sbb.login.username }}" required></li>
							<div style="clear:both;"></div>
						</ul>
						<ul>
							<li><label for="Password">{{ lang=com.sbb.login.password }}:</label></li>
							<li><input type="password" name="Password" id="Password" placeholder="{{ lang=com.sbb.login.password }}" required></li>
							<div style="clear:both;"></div>
						</ul>
						
						<div class="LoginFormMethode">
							<ul>
								<li><input type="radio" value="1" name="Register" id="RegisterMe"><label for="RegisterMe" class="Check"></label><label for="RegisterMe" class="Text">{{ lang=com.sbb.register.register }}</label></li>
								<li><input type="radio" value="0" name="Register" id="LogMeIn" checked><label for="LogMeIn" class="Check"></label><label for="LogMeIn" class="Text">{{ lang=com.sbb.login.login }}</label></li>
							</ul>
						</div>
						
						<div class="LoginFormSubmit">
							<ul>
								<li><input type="submit" name="SubmitLogin" id="SubmitLogin" value="{{ lang=com.sbb.form.submit }}"></li>
								<li><input type="checkbox" name="StayLoggedIn" id="StayLoggedIn"><label for="StayLoggedIn" class="Check"></label><label for="StayLoggedIn" class="Text">{{ lang=com.sbb.login.stay }}</label></li>
								<div style="clear:both;"></div>
							</ul>
						</div>
					</div>
				</form>
			</div>
			<div id="LoginBarHandle">
				<div id="LoginBarToogle">{{ lang=com.sbb.login.bar_handle }}</div>
			</div>
		{% else %}
			<div class="UserTabs">
				USERBAR: <strong>Logged In</strong>!
			</div>
		{% endif %}
		</div>
	</section>