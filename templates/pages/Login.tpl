					<div class="Container">
					<form method="post">
						<table>
							<tr>
								<td><label for="Username">{{ lang=com.sbb.login.username }}</label></td>
								<td><input type="text" name="Username" id="Username" size="30" autocomplete="off" required></td>
							</tr>
							<tr>
								<td><label for="Password">{{ lang=com.sbb.login.password }}</label></td>
								<td><input type="password" name="Password" id="Password" size="30" autocomplete="off" required></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="checkbox" name="StayLoggedIn" id="StayLoggedIn" size="30" value="1"><label for="StayLoggedIn">{{ lang=com.sbb.login.stay }}</label></td>
							</tr>
						</table>
						<input type="submit" name="Login" value="{{ lang=com.sbb.form.submit }}" />
					</form>
                    <p>{{ Message }}</p>
                	</div>