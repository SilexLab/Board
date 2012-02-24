	<footer class="MinSize">
		<div class="Size">
			{# <form action="?page=ChangeLanguage" method="post">
				<select name="language" onChange="this.form.submit();">
					{{ Languages }}
				</select>
			</form>
            <form action="?page=ChangeStyle" method="post">
				<select name="style" onChange="this.form.submit();">
					{% for Style in StyleList %}
                    	<option value="{{ Style }}">{{ Style }}</option>
                    {% endfor %}
				</select>
			</form> #}

			Aktuelle Sprache: {{ lang=com.sbb.language.info }}<br>
			Aktueller Style: {{ Style.Name }}<br>
			<br>
		</div>
		<div class="Legal">
			<div class="Size">
				<a href="http://www.silexboard.org/">{{ lang=com.sbb.copyright }}</a>
			</div>
		</div>
	</footer>