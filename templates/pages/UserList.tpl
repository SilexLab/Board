<div class="Container">
	<div class="container_head">
		<div class="title_menu">{{ lang=sbb.page.userlist }}</div>
		<menu>
			<li>{{ lang=sbb.user.all_members }}</li>
			<li>{{ lang=sbb.user.teammembers }}</li>
			<li>{{ lang=sbb.user.search }}</li>
		</menu>
	</div>
	<div class="optionsbar">
		Sortier-/Anzeigeoptionen
	</div>
	<div class="content">
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
			{% for TUser in Users %}
				<tr>
					<td>
						<a href="?page=User&amp;UserID={{ TUser.ID }}">
							<img src="{{ Dir.Style }}{{ Style.Dir }}/icons/g_64_user.png" class="avatar"> {# Avatar #}
						</a>
					</td>
					<td>
						<a href="?page=User&amp;UserID={{ TUser.ID }}">
							<div class="username">{{ TUser.Name }}</div>
						{# TODO: TUser.Group #}
						{% if TUser.Name == "admin" %}
							<div class="usergroup">Administrator</div>
						{% else %}
							<div class="usergroup">User</div>
						{% endif %}
						</a>
					</td>
					<td>
						<div class="joined_date">{{ TUser.Joined_D|default("-") }}</div>
						<div class="joined_time">{{ TUser.Joined_T|default("-") }}</div>
					</td>
					<td>{{ TUser.Posts }}</td>
					<td>{{ TUser.Language }}</td>
					<td>
					{% if TUser.Homepage %}
						<a href="{{ TUser.Homepage }}">Link</a>
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