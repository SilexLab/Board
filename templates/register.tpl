					<form method="post">
						<table>
							<tr>
								<td><label for="Username">{lang=com.sbb.register.username}</label></td>
								<td><input type="text" name="Username" id="Username" size="30" value="{$RegisterName}" required /></td>
							</tr>
							<tr>
								<td><label for="Password">{lang=com.sbb.register.password}</label></td>
								<td><input type="password" name="Password" id="Password" size="30" value="{$RegisterPass}" required /></td>
							</tr>
							<tr>
								<td><label for="Passwordrepeat">{lang=com.sbb.register.password.repeat}</label></td>
								<td><input type="password" name="Passwordrepeat" id="Passwordrepeat" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="Email">{lang=com.sbb.register.email}</label></td>
								<td><input type="email" name="Email" id="Email" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="Emailrepeat">{lang=com.sbb.register.email.repeat}</label></td>
								<td><input type="email" name="Emailrepeat" id="Emailrepeat" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="Captcha">{lang=com.sbb.captcha}</label></td>
								<td><input type="text" name="Captcha" id="Captcha" size="30" required /></td>
							</tr>
                                                        <tr>
                                                                <td><img src="classes/captcha.class.php"></td>
                                                        </tr>
						</table>
						<input type="submit" name="Register" value="{lang=com.sbb.form.submit}" />
					</form>
                    <p>{$RegisterMessage}</p>