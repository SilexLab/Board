<div class="container">
	<div class="container_head">
		<div class="title">{lang node="sbb.page.userlist"}</div>
		<menu>
			<li>{lang node="sbb.user.all_members"}</li>
			<li>{lang node="sbb.user.teammembers"}</li>
			<li>{lang node="sbb.user.search"}</li>
		</menu>
	</div>
	<div class="container_content">
		<div class="optionsbar">
			Sortier-/Anzeigeoptionen
		</div>
		<table class="userlist">
			<thead>
				<tr>
					<th>{lang node="sbb.user.avatar"}</th>
					<th>{lang node="sbb.user.username"}</th>
					<th>{lang node="sbb.user.joined"}</th>
					<th>{lang node="sbb.user.posts"}</th>
					<th>{lang node="sbb.user.language"}</th>
					<th>{lang node="sbb.user.homepage"}</th>
					<th>{lang node="sbb.user.contact"}</th>
				</tr>
			</thead>
			<tbody>
			{foreach $users as $user}
				<tr>
					<td>
						<a href="{$user.link}">
							<img src="{$theme.dir}/icons/g_64_user.png" class="avatar"> {* Avatar *}
						</a>
					</td>
					<td>
						<a href="{$user.link}">
							<div class="username">{$user.name}</div>
						{* TODO: user.group *}
						{if $user.Name == "admin"}
							<div class="usergroup">Administrator</div>
						{else}
							<div class="usergroup">User</div>
						{/if}
						</a>
					</td>
					<td>
						<div class="joined_date">{$user.joined_d|default:'-'}</div>
						<div class="joined_time">{$user.joined_t|default:'-'}</div>
					</td>
					<td>{$user.posts}</td>
					<td>{$user.language}</td>
					<td>
					{if $user.homepage}
						<a href="{$user.homepage}">Link</a>
					{else}
						-
					{/if}
					</td>
					<td>PM</td>
				</tr>
			{foreachelse}
				<tr>
					<td colspan="7">Keine Benutzer gefunden</td>
				</tr>
			{/foreach}
			</tbody>
		</table>
	</div>
	<div class="container_footer">
		Seitenauswahl/Weitere Optionen
	</div>
</div>