	<footer>
		<div class="Size">
            <form action="?page=ChangeLanguage" method="post">
                <select name="language" onChange="this.form.submit();">
                	{{ Languages }}
                </select>
            </form>
			Aktuelle Sprache: {{ lang#com.sbb.language }}<br>
			- {{ Load }}
		</div>
	</footer>