<ul class="board">
{foreach $board as $entry}
	{if $entry.type >= 0 or $entry.type <= 2}
		{if $entry.type == 0}
			<li class="category">
		{elseif $entry.type == 1}
			<li class="forum">
		{elseif $entry.type == 2}
			<li class="link">
		{/if}
			<div class="container">
				<div class="container_head">
				{if $entry.type == 1}
					<div class="board_top">
						<div class="board_info">
							<a href="{$entry.link}">
								<div class="title">{$entry.title}</div>
							{if $entry.description}
								<div class="description">{$entry.description}</div>
							{/if}
							</a>
						</div>
						<div class="board_post">
							<p>{$entry.last_post}</p>
							<p>{$entry.last_post_user}</p>
						</div>
					</div>
					<div class="board_bottom">
						<div class="stats">{$entry.stats}</div>
					</div>
				{else}
					<a href="{$entry.link}">
						<div class="title">{$entry.title}</div>
					{if $entry.description}
						<div class="description">{$entry.description}</div>
					{/if}
					</a>
				{/if}
				</div>
			{if $entry.sub_board}
				<div class="container_content">
					<ul class="sub_board">
					{foreach $entry.sub_board as $sub_entry}
						{if $sub_entry.type >= 0 or $sub_entry.type <= 2}
							{if $sub_entry.type == 0}
								<li class="category">
							{elseif $sub_entry.type == 1}
								<li class="forum">
							{elseif $sub_entry.type == 2}
								<li class="link">
							{/if}
								<div class="container_head">
								{if $sub_entry.type == 1}
									<div class="board_top">
										<div class="board_info">
											<a href="{$sub_entry.link}">
												<div class="title">{$sub_entry.title}</div>
											{if $sub_entry.description}
												<div class="description">{$sub_entry.description}</div>
											{/if}
											</a>
										</div>
										<div class="board_post">
											<p>{$sub_entry.last_post}</p>
											<p>{$sub_entry.last_post_user}</p>
										</div>
									</div>
									<div class="board_bottom">
										<div class="stats">{$sub_entry.stats}</div>
									{if $sub_entry.sub_board}
										<ul class="sub_sub_board">
										{foreach $sub_entry.sub_board as $sub_sub_entry}
											<li><a href="{$sub_sub_entry.link}">{$sub_sub_entry.title}</a></li>
										{/foreach}
										</ul>
									{/if}
									</div>
								{else}
									<a href="{$sub_entry.link}">
										<div class="title">{$sub_entry.title}</div>
									{if $sub_entry.description}
										<div class="description">{$sub_entry.description}</div>
									{/if}
									</a>
								{/if}
								</div>
							</li>
						{/if}
					{/foreach}
					</ul>
				</div>
			{/if}
			</div>
		</li>
	{/if}
{/foreach}
</ul>
{if $current_board.ID > 0 and $current_board.type != 0}
<div class="container">
	<div class="container_head">
		<div class="title">Themen</div>
	</div>
	<div class="container_content">
		<ul>
		{foreach $threads as $thread}
			<li>
				<a href="{$thread.link}">{$thread.topic}</a>
			</li>
		{foreachelse}
			<li>
				{lang node="sbb.board.no_threads"} [sbb.board.no_threads]
			</li>
		{/foreach}
		</ul>
	</div>
</div>
{/if}