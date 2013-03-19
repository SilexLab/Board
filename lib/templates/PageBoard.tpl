{* Board list *}
{function boardlist level=0}
<ul class="boardlist">
	{foreach $boards as $curBoard}

		{if $curBoard.board.type == 0} {* Category *}
			<li class="category">
				<div class="title">
					<a href="{$curBoard.board.link}">{$curBoard.board.title}</a>
				</div>
				<div class="description">
					{$curBoard.board.desc}
				</div>
				{elseif $curBoard.board.type == 1} {* Forum *}
			<li class="forum">
				<div class="title">
					<a href="{$curBoard.board.link}">{$curBoard.board.title}</a>
				</div>
				<div class="description">
					{$curBoard.board.desc}
				</div>
				<div class="lastpost">
					{if $curBoard.board.lastPost}
						<div class="title">
							{$curBoard.board.lastPost.title}
						</div>
						<div class="user">
							{$curBoard.board.lastPost.user.name}
						</div>
						<div class="time">
							{$curBoard.board.lastPost.time} {* TODO: Format the date *}
						</div>
					{else}
						<em>None</em> {* TODO: language var *}
					{/if}

				</div>
				{elseif $curBoard.board.type == 2} {* Link *}
			<li class="link">
			<div class="title">
				<a href="{$curBoard.board.link}">{$curBoard.board.title}</a>
			</div>
			<div class="description">
				{$curBoard.board.desc}
			</div>
		{/if}

		{if $curBoard.subBoards}
			{boardlist boards=$curBoard.subBoards level=$level+1}
		{/if}
		</li>
	{/foreach}
</ul>
{/function}

{boardlist boards=$boards}
