					<form method="post">
						<table>
							<tr>
								<td><label for="username">{lang=com.sbb.register.username}</label></td>
								<td><input type="text" name="Username" id="Username" size="30" value="{$RegisterName}" required /></td>
							</tr>
							<tr>
								<td><label for="password">{lang=com.sbb.register.password}</label></td>
								<td><input type="password" name="Password" id="Password" size="30" value="{$RegisterPass}" required /></td>
							</tr>
							<tr>
								<td><label for="passwordrepeat">{lang=com.sbb.register.password.repeat}</label></td>
								<td><input type="password" name="Passwordrepeat" id="Passwordrepeat" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="email">{lang=com.sbb.register.email}</label></td>
								<td><input type="email" name="Email" id="Email" size="30" required /></td>
							</tr>
							<tr>
								<td><label for="emailrepeat">{lang=com.sbb.register.email.repeat}</label></td>
								<td><input type="email" name="Emailrepeat" id="Emailrepeat" size="30" required /></td>
							</tr>
						</table>
						<input type="submit" name="Register" value="{lang=com.sbb.form.submit}" />
					</form>
                    <p>{$RegisterMessage}</p>