{* Board list *}
{function boardlist level=0}
{$list_class = ['boardlist', 'sub_board', 'sub_sub_board']}
{$type = ['category', 'forum', 'link']}
<ul class="{$list_class[$level]}">
	{foreach $boards as $cur}
		{if $level >= 2}
			<li class="{$type[$cur.board.type]}">
				<div class="title">
					<a href="{$cur.board.link}">{$cur.board.title}</a>
				</div>
			</li>
		{else}
			<li class="{$type[$cur.board.type]}">
				{if $cur.board.type == 1}<div class="left_cell">{/if}
				<div class="title">
					<a href="{$cur.board.link}">{$cur.board.title}</a>
				</div>
				{if $cur.board.desc}
					<div class="description">
						{$cur.board.desc}
					</div>
				{/if}
				{if $cur.board.type == 1}
					</div>
					<div class="right_cell">
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
					</div>
					<div class="clear"></div>
				{/if}
				{if $cur.sub_boards}
					{boardlist boards=$cur.sub_boards level=$level+1}
				{/if}
			</li>
		{/if}
	{/foreach}
</ul>
{/function}

<div class="w_content board_list">
<h1>{lang n='page.board'}</h1>
{boardlist boards=$boards}
</div>
