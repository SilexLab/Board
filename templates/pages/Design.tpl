{# Default #}
<div class="container">
	<div class="container_head">
		<div class="title">Überschrift der Kopfleiste</div>
	</div>
	<div class="container_content">
	</div>
	<div class="container_footer">
	</div>
</div>

{# Default with description #}
<div class="container">
	<div class="container_head">
		<div class="title">Überschrift der Kopfleiste</div>
		<div class="description">Beschreibung des Inhalts</div>
	</div>
	<div class="container_content">
	</div>
	<div class="container_footer">
	</div>
</div>

{# Menu #}
<div class="container">
	<div class="container_head">
		<div class="title">Überschrift der Kopfleiste mit Menü</div>
		<menu>
			<li>
				<div class="menu_title">Menüeintrag 1</div>
			</li>
			<li>
				<div class="menu_title">Menüeintrag 2</div>
			</li>
			<li>
				<div class="menu_title">Menüeintrag 3</div>
			</li>
		</menu>
	</div>
	<div class="container_content">
	</div>
	<div class="container_footer">
	</div>
</div>

{# Iconmenu #}
<div class="container">
	<div class="container_head">
		<div class="title">Überschrift der Kopfleiste mit Symbolmenü</div>
		<menu class="icon_menu">
			<li>
				<div class="menu_icon"></div>
				<div class="menu_title">Menüeintrag 1</div>
			</li>
			<li>
				<div class="menu_icon"></div>
				<div class="menu_title">Menüeintrag 2</div>
			</li>
			<li>
				<div class="menu_icon"></div>
				<div class="menu_title">Menüeintrag 3</div>
			</li>
		</menu>
	</div>
	<div class="container_content">
	</div>
	<div class="container_footer">
	</div>
</div>

{# Step-Progress-Bar #}
<div class="container">
	<div class="container_head">
		<div class="title">Überschrift der Kopfleiste mit "Schrittfortschritt"</div>
		<div class="step_bar">
			<style type="text/css">
				.step_bar .progress { width: 33.3333333333%; } /* Current Progress */
				.step_bar .step_bullet_wrap { margin-right: 33.3333333333%; } /* 100 / num of steps - 1 (100 / 4-1 = 33.333...)*/
			</style>
			<div class="progress"></div>
			<div class="step_bullet_wrap done">
				<div class="step_bullet">1</div>
			</div>
			<div class="step_bullet_wrap current">
				<div class="step_bullet">2</div>
			</div>
			<div class="step_bullet_wrap">
				<div class="step_bullet">3</div>
			</div>
			<div class="step_bullet_wrap">
				<div class="step_bullet">4</div>
			</div>
		</div>
	</div>
	<div class="container_content">
	</div>
	<div class="container_footer">
	</div>
</div>

<div class="container">
	Forenliste:
</div>

{# Forum List #}
<ul class="board">
	<li class="category">
		<div class="container">
			<div class="container_head">
				<a href="javascript:false;">
					<div class="title">Kategorietitel</div>
					<div class="description">Beschreibung der Kategorie</div>
				</a>
			</div>
			<div class="container_content">
				{# Subforum #}
				<ul class="sub_board">
					<li class="forum">
						<div class="container_head">
							<div class="board_top">
								<div class="board_info">
									<a href="javascript:false;">
										<div class="title">Forentitel</div>
										<div class="description">Beschreibung des Forums der Kategorie</div>
									</a>
								</div>
								<div class="board_post">
									<p>20.05.2012 - 20:40</p>
									<p>Noxi Foxi</p>
								</div>
							</div>
							<div class="board_bottom">
								<div class="stats">Threads: 5, Posts: 6, Views: 23</div>
							</div>
						</div>
					</li>
					{# Subforum with subsubforum #}
					<li class="forum">
						<div class="container_head">
							<div class="board_top">
								<div class="board_info">
									<a href="javascript:false;">
										<div class="title">Awesome Forentitel</div>
										<div class="description">Beschreibung des Awesome Forums der Kategorie</div>
									</a>
								</div>
								<div class="board_post">
									<p>20.05.2012 - 21:42</p>
									<p>onkelz</p>
								</div>
							</div>
							<div class="board_bottom">
								<div class="stats">Threads: 8, Posts: 42, Views: 593</div>
								<ul class="sub_sub_board">
									<li><a href="javascript:false;">Unter-Unter-Forum 1</a></li>
									<li><a href="javascript:false;">Unter-Unter-Forum 2</a></li>
									<li><a href="javascript:false;">Unter-Unter-Forum 3</a></li>
								</ul>
							</div>
						</div>
					</li>
					{# Link #}
					<li class="link">
						<div class="container_head">
							<div class="board_top">
								<a href="javascript:false;">
									<div class="title">Linktitel</div>
									<div class="description">Beschreibung des Links der Kategorie</div>
								</a>
							</div>
						</div>
					</li>
					{# Category #}
					<li>
						<div class="container_head">
							<div class="board_top">
								<a href="javascript:false;">
									<div class="title">Subkategorietitel</div>
									<div class="description">Beschreibung der Subkategorie der Kategorie</div>
								</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</li>
	<li class="forum">
		<div class="container">
			<div class="container_head">
				<div class="board_top">
					<div class="board_info">
						<a href="javascript:false;">
							<div class="title">Forumtitel</div>
							<div class="description">Beschreibung des Forums</div>
						</a>
					</div>
					<div class="board_post">
						<p>20.05.2012 - 20:40</p>
						<p>Noxi Foxi</p>
					</div>
				</div>
				<div class="board_bottom">
					<div class="stats">Threads: 5, Posts: 6, Views: 23</div>
				</div>
			</div>
		</div>
	</li>
	<li class="category">
		<div class="container">
			<div class="container_head">
				<a href="javascript:false;">
					<div class="title">Kategorietitel</div>
					<div class="description">Beschreibung der Kategorie</div>
				</a>
			</div>
		</div>
	</li>
	<li class="link">
		<div class="container">
			<div class="container_head">
				<a href="javascript:false;">
					<div class="title">Linktitel</div>
					<div class="description">Beschreibung des Links</div>
				</a>
			</div>
		</div>
	</li>
</ul>