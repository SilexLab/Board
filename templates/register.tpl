<body>
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
</body>