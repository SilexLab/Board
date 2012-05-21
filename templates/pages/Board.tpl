<ul class="board">
{% for entry in board %}
	{% if entry.type in range(0, 2) %}
		{% if entry.type == 0 %}
			<li class="category">
		{% elseif entry.type == 1 %}
			<li class="forum">
		{% elseif entry.type == 2 %}
			<li class="link">
		{% endif %}
			<div class="container">
				<div class="container_head">
				{% if entry.type == 1 %}
					<div class="board_top">
						<div class="board_info">
							<a href="{{ entry.link }}">
								<div class="title">{{ entry.title }}</div>
							{% if entry.description %}
								<div class="description">{{ entry.description }}</div>
							{% endif %}
							</a>
						</div>
						<div class="board_post">
							<p>{{ entry.last_post }}</p>
							<p>{{ entry.last_post_user }}</p>
						</div>
					</div>
					<div class="board_bottom">
						<div class="stats">{{ entry.stats }}</div>
					</div>
				{% else %}
					<a href="{{ entry.link }}">
						<div class="title">{{ entry.title }}</div>
					{% if entry.description %}
						<div class="description">{{ entry.description }}</div>
					{% endif %}
					</a>
				{% endif %}
				</div>
			{% if entry.sub_board %}
				<div class="container_content">
					<ul class="sub_board">
					{% for sub_entry in entry.sub_board %}
						{% if sub_entry.type in range(0, 2) %}
							{% if sub_entry.type == 0 %}
								<li class="category">
							{% elseif sub_entry.type == 1 %}
								<li class="forum">
							{% elseif sub_entry.type == 2 %}
								<li class="link">
							{% endif %}
								<div class="container_head">
								{% if sub_entry.type == 1 %}
									<div class="board_top">
										<div class="board_info">
											<a href="{{ sub_entry.link }}">
												<div class="title">{{ sub_entry.title }}</div>
											{% if sub_entry.description %}
												<div class="description">{{ sub_entry.description }}</div>
											{% endif %}
											</a>
										</div>
										<div class="board_post">
											<p>{{ sub_entry.last_post }}</p>
											<p>{{ sub_entry.last_post_user }}</p>
										</div>
									</div>
									<div class="board_bottom">
										<div class="stats">{{ sub_entry.stats }}</div>
									{% if sub_entry.sub_board %}
										<ul class="sub_sub_board">
										{% for sub_sub_entry in sub_entry.sub_board %}
											<li><a href="{{ sub_sub_entry.link }}">{{ sub_sub_entry.title }}</a></li>
										{% endfor %}
										</ul>
									{% endif %}
									</div>
								{% else %}
									<a href="{{ sub_entry.link }}">
										<div class="title">{{ sub_entry.title }}</div>
									{% if sub_entry.description %}
										<div class="description">{{ sub_entry.description }}</div>
									{% endif %}
									</a>
								{% endif %}
								</div>
							</li>
						{% endif %}
					{% endfor %}
					</ul>
				</div>
			{% endif %}
			</div>
		</li>
	{% endif %}
{% endfor %}
</ul>
{% if current_board.ID > 0 and current_board.type != 0 %}
<div class="container">
	<div class="container_head">
		<div class="title">Themen</div>
	</div>
	<div class="container_content">
		<ul>
		{% for thread in threads %}
			<li>
				<a href="{{ thread.link }}">{{ thread.topic }}</a>
			</li>
		{% else %}
			<li>
				{{ lang=sbb.board.no_threads }} [sbb.board.no_threads]
			</li>
		{% endfor %}
		</ul>
	</div>
</div>
{% endif %}