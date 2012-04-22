<ul class="board">
{% for Entry in Board %}
{# Category #}
	{% if Entry.Type == 0 %}
		<li class="category">
			<div class="Container">
				<div class="category_content">
					<a href="{{ Entry.Link }}">
						<div class="title">{{ Entry.Title }}</div>
					{% if Entry.Description %}
						<div class="description">{{ Entry.Description }}</div>
					{% endif %}
					</a>
				</div>
{# Forum #}
	{% elseif Entry.Type == 1 %}
		<li class="forum">
			<div class="Container">
				<div class="forum_content">
					<div class="board_info">
						<a href="{{ Entry.Link }}">
							<div class="board_inner">
								<div class="title">{{ Entry.Title }}</div>
							{% if Entry.Description %}
								<div class="description">{{ Entry.Description }}</div>
							{% endif %}
								<div class="stats">{{ Entry.Stats }}</div>
							</div>
						</a>
					</div>
					<div class="board_post">
						<p>{{ Entry.LastPost }}</p>
						<p>{{ Entry.LastPostUser }}</p>
					</div>
				</div>
{# Link #}
	{% elseif Entry.Type == 2 %}
		<li class="link">
			<div class="Container">
				<div class="link_content">
					<a href="{{ Entry.Link }}">
						<div class="link_inner">
							<div class="title">{{ Entry.Title }}</div>
						{% if Entry.Description %}
							<div class="description">{{ Entry.Description }}</div>
						{% endif %}
							<div class="stats">{{ Entry.Stats }}</div>
						</div>
					</a>
				</div>
	{% endif %}
		{# Sub Board #}
			{% if Entry.SubBoard %}
				<ul class="sub_board">
				{% for SubEntry in Entry.SubBoard %}
				{# Category #}
					{% if SubEntry.Type == 0 %}
						<li class="category">
							<div class="category_content">
								<a href="{{ SubEntry.Link }}">
									<div class="title">{{ SubEntry.Title }}</div>
								{% if SubEntry.Description %}
									<div class="description">{{ SubEntry.Description }}</div>
								{% endif %}
								</a>
							</div>
						</li>
				{# Forum #}
					{% elseif SubEntry.Type == 1 %}
						<li class="forum">
							<div class="forum_content">
								<div class="board_info">
									<a href="{{ SubEntry.Link }}">
										<div class="board_inner">
											<div class="title">{{ SubEntry.Title }}</div>
										{% if SubEntry.Description %}
											<div class="description">{{ SubEntry.Description }}</div>
										{% endif %}
											<div class="stats">{{ SubEntry.Stats }}</div>
										</div>
									</a>
								</div>
								<div class="board_post">
									<p>{{ SubEntry.LastPost }}</p>
									<p>{{ SubEntry.LastPostUser }}</p>
								</div>
							</div>
						</li>
				{# Link #}
					{% elseif SubEntry.Type == 2 %}
						<li class="link">
							<div class="link_content">
								<a href="{{ SubEntry.Link }}">
									<div class="link_inner">
										<div class="title">{{ SubEntry.Title }}</div>
									{% if SubEntry.Description %}
										<div class="description">{{ SubEntry.Description }}</div>
									{% endif %}
										<div class="stats">{{ SubEntry.Stats }}</div>
									</div>
								</a>
							</div>
						</li>
					{% endif %}
				{% endfor %}
				</ul>
			{% endif %}
		{# End Sub Board #}
{# End #}
	{% if Entry.Type in range(0, 2) %}
			</div>
		</li>
	{% endif %}
{% endfor %}
</ul>
