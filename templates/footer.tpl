	<footer class="MinSize">
		<div class="Size">
			<form action="?page=ChangeLanguage" method="post">
				<select name="language" onChange="this.form.submit();">
					{{ Languages }}
				</select>
			</form>
			Aktuelle Sprache: {{ lang=com.sbb.language.info }}<br>
			- {{ Load }}
		</div>
	</footer>