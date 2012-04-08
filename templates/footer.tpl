	<footer class="MinSize">
		<div class="Size">
			<div class="Time">
				{{ Time.Date }} - {{ Time.Time }} Uhr
				<div class="progressbar_trim day">
					<div class="progressbar" title="{{ lang=com.sbb.time.dayprogress }}">
						<div class="progress" style="width: {{ Time.DPercent }}%;">
							<div class="shine"></div>
						</div>
					</div>
				</div>
				<div class="progressbar_trim year">
					<div class="progressbar" title="{{ lang=com.sbb.time.progress }}">
						<div class="progress" style="width: {{ Time.YPercent }}%;">
							<div class="shine"></div>
						</div>
					</div>
				</div>
			</div>
			<strong>{{ lang=com.sbb.footer.current_language }}:</strong> {{ lang=com.sbb.language.info }}<br>
			<strong>{{ lang=com.sbb.footer.current_style }}:</strong> {{ Style.Name }}
			<div style="clear: both;"></div>
		</div>
		<div class="Legal">
			<div class="Size">
				<a href="http://www.silexboard.org/"><span class="Copyright">{{ lang=com.sbb.forumsoftware }}:</span> Silex Bulletin Board {{ Version.Version }} <span class="Copyright">–</span> © 2011 - 2012 SilexBoard.org</a><br>
				<a href="https://github.com/SilexBoard/Board/commit/{{ Version.SHA }}"><span class="Copyright">{{ Version.SHA }}</span></a>
			</div>
		</div>
	</footer>