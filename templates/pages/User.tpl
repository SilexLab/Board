<div class="user_avatar">
	<img src="{$style.dir}/icons/g_256_user.png" class="avatar">
</div>
<div class="container user">
	<div class="container_head">
		<div class="title">{lang node="sbb.user.profile_of"} "{$profile.username}"</div>
	</div>
	<div class="container_content">
		<div class="info">
			<span class="group" title="{lang node="sbb.user.profile.group"}">{$profile.group}</span>
			<span class="gender male" title="{lang node="sbb.user.profile.gender"}">{lang node="sbb.user.gender.male"}</span>
			<span class="joined" title="{lang node="sbb.user.profile.joined"}">{$profile.joined}</span>
			<span class="activity" title="{lang node="sbb.user.profile.activity"}">{$profile.activity}</span>
			<span class="language" title="{lang node="sbb.user.profile.language"}">{$profile.language}</span>
			<span class="birthday" title="{lang node="sbb.user.profile.birthday"}">{$profile.birthday}</span>
			<span class="age" title="{lang node="sbb.user.profile.age"}">{$profile.age}</span>
		</div>
	</div>
	<div class="container_content">
		<div class="signature" title="{lang node="sbb.user.profile.signature"}">
			{$profile.signature}
		</div>
	</div>
	[More informations]
</div>
<div class="container">
	[Even more informations]
</div>