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
				<a href="http://www.silexboard.org/"><span class="Copyright">{{ lang=com.sbb.forumsoftware }}:</span> Silex Bulletin Board {{ Version.Version }} <span class="Copyright">–</span> © 2011 - 2012 SilexBoard.org</a><br>
				<a href="https://github.com/SilexBoard/Board/commit/{{ Version.SHA }}"><span class="Copyright">{{ Version.SHA }}</span></a>
			</div>
		</div>
	</footer>