{* Board list *}
{function boardlist level=0}
<ul class="boardlist">
	{foreach $boards as $cur_board}
		{if $cur_board.board.type == 0} {* Category *}
			<li class="category">
				<div class="title">
					<a href="{$cur_board.board.link}">{$cur_board.board.title}</a>
				</div>
				<div class="description">
					{$cur_board.board.desc}
				</div>
				{elseif $cur_board.board.type == 1} {* Forum *}
			<li class="forum">
				<div class="title">
					<a href="{$cur_board.board.link}">{$cur_board.board.title}</a>
				</div>
				<div class="description">
					{$cur_board.board.desc}
				</div>
				<div class="lastpost">
					{if $cur_board.board.lastPost}
						<div class="title">
							{$cur_board.board.lastPost.title}
						</div>
						<div class="user">
							{$cur_board.board.lastPost.user.name}
						</div>
						<div class="time">
							{$cur_board.board.lastPost.time} {* TODO: Format the date *}
						</div>
					{else}
						<em>None</em> {* TODO: language var *}
					{/if}
				</div>
				{elseif $cur_board.board.type == 2} {* Link *}
			<li class="link">
			<div class="title">
				<a href="{$cur_board.board.link}">{$cur_board.board.title}</a>
			</div>
			<div class="description">
				{$cur_board.board.desc}
			</div>
		{/if}
		{if $cur_board.sub_boards}
			{boardlist boards=$cur_board.sub_boards level=$level+1}
		{/if}
		</li>
	{/foreach}
</ul>
{/function}

<div class="w_content_l board_list">
{boardlist boards=$boards}
</div>
