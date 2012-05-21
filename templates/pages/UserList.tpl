<div class="container">
	<div class="container_head">
		<div class="title">{{ lang=sbb.page.userlist }}</div>
		<menu>
			<li>{{ lang=sbb.user.all_members }}</li>
			<li>{{ lang=sbb.user.teammembers }}</li>
			<li>{{ lang=sbb.user.search }}</li>
		</menu>
	</div>
	<div class="container_content">
		<div class="optionsbar">
			Sortier-/Anzeigeoptionen
		</div>
		<table class="userlist">
			<thead>
				<tr>
					<th>{{ lang=sbb.user.avatar }}</th>
					<th>{{ lang=sbb.user.username }}</th>
					<th>{{ lang=sbb.user.joined }}</th>
					<th>{{ lang=sbb.user.posts }}</th>
					<th>{{ lang=sbb.user.language }}</th>
					<th>{{ lang=sbb.user.homepage }}</th>
					<th>{{ lang=sbb.user.contact }}</th>
				</tr>
			</thead>
			<tbody>
			{% for user in users %}
				<tr>
					<td>
						<a href="{{ user.link }}">
							<img src="{{ Dir.Style }}{{ Style.Dir }}/icons/g_64_user.png" class="avatar"> {# Avatar #}
						</a>
					</td>
					<td>
						<a href="{{ user.link }}">
							<div class="username">{{ user.name }}</div>
						{# TODO: user.group #}
						{% if TUser.Name == "admin" %}
							<div class="usergroup">Administrator</div>
						{% else %}
							<div class="usergroup">User</div>
						{% endif %}
						</a>
					</td>
					<td>
						<div class="joined_date">{{ user.joined_d|default("-") }}</div>
						<div class="joined_time">{{ user.joined_t|default("-") }}</div>
					</td>
					<td>{{ user.posts }}</td>
					<td>{{ user.language }}</td>
					<td>
					{% if user.homepage %}
						<a href="{{ user.homepage }}">Link</a>
					{% else %}
						-
					{% endif %}
					</td>
					<td>PM</td>
				</tr>
			{% else %}
				<tr>
					<td colspan="7">Keine Benutzer gefunden</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</div>
	<div class="container_footer">
		Seitenauswahl/Weitere Optionen
	</div>
</div>