<body>
	{$message}
	<form method="post">
		<table>
			<tr>
				<td><label for="homepage">{lang=com.sbb.profile.homepage}</label></td>
				<td><input type="url" name="homepage" id="homepage" size="30" /></td>
			</tr>
			<tr>
				<td><label for="signature">{lang=com.sbb.profile.signature}</label></td>
				<td><textarea name="signature" id="signature" rows="15" cols="50"></textarea></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="{lang=com.sbb.form.submit}" />
	</form>
<a href="logout.php">{lang=com.sbb.user.logout}</a>
</body>