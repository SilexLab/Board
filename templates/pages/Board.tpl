<ul class="board">
	<li class="category">
		<div class="Container">
			<div class="category_content">
				<a href="javascript:void(0);">
					<div class="title">Kategorietitel</div>
					<div class="description">Beschreibung der Kategorie, wenn man's unbedingt will</div>
				</a>
			</div>
			<ul class="sub_board">
				<li class="forum">
					<div class="forum_content">
						<div class="board_info">
							<a href="javascript:void(0);">
								<div class="board_inner">
									<div class="title">Forentitel</div>
									<div class="description">Beschreibung des Unterforums...</div>
									<div class="stats">Statistiken (Themen, Beiträge)</div>
								</div>
							</a>
						</div>
						<div class="board_post">
							<p>Letzter Post, Titel des Themas</p>
							<p>Benutzername des Postserstellers</p>
						</div>
					</div>
				</li>
				<li class="category">
					<div class="category_content">
						<a href="javascript:return;">
							<div class="title">Unterkategorietitel</div>
							<div class="description">Beschreibung der Unterkategorie...</div>
						</a>
					</div>
				</li>
			</ul>
		</div>
	</li>
	<li class="forum">
		<div class="Container">
			<div class="forum_content">
				<div class="board_info">
					<a href="javascript:void(0);">
						<div class="board_inner">
							<div class="title">Forentitel</div>
							<div class="description">Beschreibung des Forums, hier und da</div>
							<div class="stats">Statistiken (Themen, Beiträge)</div>
						</div>
					</a>
				</div>
				<div class="board_post">
					<p>Letzter Post, Titel des Themas</p>
					<p>Benutzername des Postserstellers</p>
				</div>
			</div>
			<ul class="sub_board">
				<li class="forum">
					<div class="forum_content">
						<div class="board_info">
							<a href="javascript:void(0);">
								<div class="board_inner">
									<div class="title">Forentitel</div>
									<div class="description">Beschreibung des Unterforums...</div>
									<div class="stats">Statistiken (Themen, Beiträge)</div>
								</div>
							</a>
						</div>
						<div class="board_post">
							<p>Letzter Post, Titel des Themas</p>
							<p>Benutzername des Postserstellers</p>
						</div>
					</div>
				</li>
				<li class="link">
					<div class="link_content">
						<a href="javascript:void(0);">
							<div class="link_inner">
								<div class="title">Linktitel</div>
								<div class="description">Beschreibung des Links...</div>
							</div>
						</a>
					</div>
				</li>
			</ul>
		</div>
	</li>
	<li class="forum">
		<div class="Container">
			<div class="forum_content">
				<div class="board_info">
					<a href="javascript:void(0);">
						<div class="board_inner">
							<div class="title">Forentitel</div>
							<div class="description">Beschreibung der Forums, hier und da</div>
							<div class="stats">Statistiken (Themen, Beiträge)</div>
						</div>
					</a>
				</div>
				<div class="board_post">
					<p>Letzter Post, Titel des Themas</p>
					<p>Benutzername des Postserstellers</p>
				</div>
			</div>
		</div>
	</li>
	<li class="link">
		<div class="Container">
			<div class="link_content">
				<a href="javascript:void(0);">
					<div class="link_inner">
						<div class="title">Linktitel</div>
						<div class="description">Beschreibung des Links...</div>
					</div>
				</a>
			</div>
		</div>
	</li>
</ul>



















{#
<ul class="Board">
{% for Board in Boards %}
	{% if Board.ParentID == 0 %}
		<li class="Container">
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
#}