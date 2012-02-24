	<footer class="MinSize">
		<div class="Size">
			<div class="Time">
				{{ Time.Date }} - {{ Time.Time }} Uhr
				<div class="TimeProgressbar"><div class="TimeProgress" style="width: {{ 250 * Time.Percent }}px;"></div></div>
			</div>
			Aktuelle Sprache: {{ lang=com.sbb.language.info }}<br>
			Aktueller Style: {{ Style.Name }}
			<div style="clear: both;"></div>
		</div>
		<div class="Legal">
			<div class="Size">
				<a href="http://www.silexboard.org/">{{ lang=com.sbb.copyright }}</a>
			</div>
		</div>
	</footer>