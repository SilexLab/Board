	<footer class="Minsize">
		<div class="size">
			<div class="time">
				<div class="date">
					<div class="d_date" title="{lang node="sbb.footer.current_date"}">{$Time.Date}</div>
					<div class="d_time" title="{lang node="sbb.footer.current_time"}">{$Time.Time}</div>
				</div>
				<div class="progressbar_trim day">
					<div class="progressbar" title="{lang node="sbb.time.dayprogress"}">
						<div class="progress" style="width: {$Time.DPercent}%;">
							<div class="shine"></div>
						</div>
					</div>
				</div>
				<div class="progressbar_trim year">
					<div class="progressbar" title="{lang node="sbb.time.progress"}">
						<div class="progress" style="width: {$Time.YPercent}%;">
							<div class="shine"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="info">
				<div class="i_language" title="{lang node="sbb.footer.current_language"}">{lang node="sbb.language.info"}</div>
				<div class="i_style" title="{lang node="sbb.footer.current_style"}">{$Style.Name}</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		<div class="Legal">
			<div class="size">
				<a href="http://www.silexboard.org/">
					<span class="Copyright">{lang node="sbb.forumsoftware"}:</span> Silex Bulletin Board {$Version.Version} <span class="Copyright">–</span> © 2011 - 2012 SilexBoard.org
				</a><br>
				<a href="https://github.com/SilexBoard/Board/commit/{$Version.SHA}">
					<span class="Copyright">{$Version.SHA}</span>
				</a>
			</div>
		</div>
	</footer>