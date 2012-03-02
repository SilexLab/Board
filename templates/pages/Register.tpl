					<div class="Container">
					<form method="post">
						<table>
							<tr>
								<td><label for="Username">{{ lang=com.sbb.register.username }}</label></td>
								<td><input type="text" name="Username" id="Username" size="30" autocomplete="off" required></td>
							</tr>
							<tr>
								<td><label for="Password">{{ lang=com.sbb.register.password }}</label></td>
								<td><input type="password" name="Password" id="Password" size="30" autocomplete="off" required></td>
							</tr>
							<tr>
								<td><label for="PasswordRepeat">{{ lang=com.sbb.register.password_repeat }}</label></td>
								<td><input type="password" name="PasswordRepeat" id="PasswordRepeat" size="30" autocomplete="off" required></td>
							</tr>
							<tr>
								<td><label for="Email">{{ lang=com.sbb.register.email }}</label></td>
								<td><input type="email" name="Email" id="Email" size="30" autocomplete="off" required></td>
							</tr>
							<tr>
								<td><label for="EmailRepeat">{{ lang=com.sbb.register.email_repeat }}</label></td>
								<td><input type="email" name="EmailRepeat" id="EmailRepeat" size="30" autocomplete="off" required></td>
							</tr>
							<!--<tr>
								<td><label for="Captcha">{{ lang=com.sbb.captcha }}</label></td>
								<td><input type="text" name="Captcha" id="Captcha" size="30" required /></td>
							</tr>
                                                        <tr>
                                                                <td><img src="lib/old classes/captcha.class.php"></td>
                                                        </tr>-->
						</table>
						<input type="submit" name="Register" value="{{ lang=com.sbb.form.submit }}" />
					</form>
                    <p>{{ Message }}</p>
                	</div>