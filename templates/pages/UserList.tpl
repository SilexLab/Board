<div class="Container">
	<div class="container_head">
		<div class="title">{{ lang=com.sbb.page.userlist }}</div>
		<menu>
			<li>Alle Mitglieder</li>
			<li>Teammitglieder</li>
			<li>Mitgliedssuche</li>
		</menu>
	</div>
	<div class="optionsbar">
		&lt;Sortieroptionen&gt;
	</div>
	<div class="content">
		<table class="userlist">
			<thead>
				<tr>
					<th>Avatar</th>
					<th>Benutzername</th>
					<th>Registrierungsdatum</th>
					<th>Beiträge</th>
					<th>Sprache</th>
					<th>Homepage</th>
					<th>Kontaktieren</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="container_footer">
		Seitenauswahl
	</div>



{#
{% for User in Users %}
	<a href="?page=User&amp;userID={{ User.ID }}"><div style="margin: 5px; border: 1px solid; border-radius: 5px; padding: 5px;">
	<span style="color: #333;">{{ User.Username }}</span><br>
	Registered since {{ User.RegisterTime|date("d.m.y H:i") }}
	</div></a>
{% else %}
  No user was found.
{% endfor %}
#}
</div>