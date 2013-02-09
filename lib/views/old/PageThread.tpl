<div class="container">
{if $posts}
	<ul>
	{foreach $posts as $post}
		<li>
			Time: <strong>{$post->GetTime()|date_format:"%d.%m.%Y, %R"}</strong><br>
			<br>
			Subject: <strong>{$post->GetSubject()}</strong><br>
			Message: <strong>{$post->GetMessage()}</strong><br>
			<br>
			User: <strong><a href="{$post->GetUser()->GetLink()}">{$post->GetUser()->Name()}</a></strong><br><br>
		</li>
	{/foreach}
	</ul>
{else}
	Dafuq? The Thread is empty! {* So ist das nunmal *}
{/if}
</div>