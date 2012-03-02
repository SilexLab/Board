<ul class="Board">
{% for Board in Boards %}
	{% if Board.ParentID == 0 %}
		<li class="BoardCategory">
			<div class="BoardHead">
				<p><a class="BoardTitle" href="?page=Board&amp;BoardID={{ Board.ID }}">{{ Board.Title }}</a></p>
				<p>{{ Board.Description }}</p>
			</div>
			<ul class="BoardForum">
			{% for Board2 in Boards %}
				{% if Board2.ParentID == Board.ID %}
					<li class="BoardList">
						<div class="ListLeft">
							<div class="ListIcon"><img src="styles/Standard/images/ListStyle.png" width="32" height="32"></div>
							<div class="ListTextLeft">
								<p><a class="bla" href="?page=Board&amp;BoardID={{ Board2.ID }}">{{ Board2.Title }}</a></p>
								<p>Beschreibung</p>
							</div>
						</div>
						<div class="ListMiddle">
							<p>Thema: Bla</p>
							<p>Benutzer, 21.12.2011</p>
						</div>
						<div class="ListRight">
							<p>23 Themen</p>
							<p>401 Beiträge</p>
						</div>
					</li>
				{% endif %}
			{% endfor %}
			</ul>
	{% else %}
		</li>
	{% endif %}
{% else %}
	No Boards
{% endfor %}
</ul>