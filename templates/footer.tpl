	<footer class="MinSize">
		<div class="Size">
			<form action="?page=ChangeLanguage" method="post">
				<select name="language" onChange="this.form.submit();">
					{{ Languages }}
				</select>
			</form>
			Aktuelle Sprache: {{ lang=com.sbb.language.info }}<br>
			Aktueller Style: {{ CurrentStyle }}<br>
			- {{ Load }}<br>
			<br>
			<a href="http://www.silexboard.org/">{{ lang=com.sbb.copyright }}</a>
		</div>
	</footer>