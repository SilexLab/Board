					<form method="post">
						<table>
							<tr>
								<td><label for="Homepage">{{ lang=com.sbb.profile.homepage }}</label></td>
								<td><input type="url" name="Homepage" id="Homepage" value="{{ Homepage }}" size="30"></td>
							</tr>
							<tr>
								<td><label for="Signature">{{ lang=com.sbb.profile.signature }}</label></td>
								<td><textarea name="Signature" id="Signature" rows="15" cols="50" style="resize:none">{{ Signature }}</textarea></td>
							</tr>
						</table>
						<input type="submit" name="Submit" value="{{ lang=com.sbb.form.submit }}" />
					</form>
                    <p>{{ Message }}</p>