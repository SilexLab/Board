{* Board list *}
{function boardlist level=0}
{$list_class = ['boardlist', 'sub_board', 'sub_sub_board']}
<ul class="{$list_class[$level]}">
	{foreach $boards as $cur}
		{* Category *}
		{if $cur.board.type == 0}
			<li class="category">
				<div class="title">
					<a href="{$cur.board.link}">{$cur.board.title}</a>
				</div>
				{if $cur.board.desc && $level < 2}
					<div class="description">
						{$cur.board.desc}
					</div>
				{/if}
		{* Forum *}
		{elseif $cur.board.type == 1}
			<li class="forum">
				<div class="title">
					<a href="{$cur.board.link}">{$cur.board.title}</a>
				</div>
				{if $cur.board.desc && $level < 2}
					<div class="description">
						{$cur.board.desc}
					</div>
				{/if}
				{if $level < 2}
					<div class="lastpost">
						{if $cur.board.lastPost}
							<div class="title">
								{$cur.board.lastPost.title}
							</div>
							<div class="user">
								{$cur.board.lastPost.user.name}
							</div>
							<div class="time">
								{$cur.board.lastPost.time} {* TODO: Format the date *}
							</div>
						{else}
							<em>None</em> {* TODO: language var *}
						{/if}
					</div>
				{/if}
		{* Link *}
		{elseif $cur.board.type == 2}
			<li class="link">
				<div class="title">
					<a href="{$cur.board.link}">{$cur.board.title}</a>
				</div>
			{if $cur.board.desc && $level < 2}
				<div class="description">
					{$cur.board.desc}
				</div>
			{/if}
		{/if}
		{if $cur.sub_boards}
			{boardlist boards=$cur.sub_boards level=$level+1}
		{/if}
			</li>
	{/foreach}
</ul>
{/function}

<div class="w_content board_list">
{boardlist boards=$boards}
</div>
