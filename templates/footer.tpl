	<footer class="MinSize">
		<div class="Size">
			<div class="Time">
				{{ Time.Date }} - {{ Time.Time }} Uhr
				<div class="DayProgressbar" title="{{ lang=com.sbb.time.dayprogress }}"><div class="DayProgress" style="width: {{ Time.DPercent }}%;"></div></div>
				<div class="YearProgressbar" title="{{ lang=com.sbb.time.progress }}"><div class="YearProgress" style="width: {{ Time.YPercent }}%;"></div></div>
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