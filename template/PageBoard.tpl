<ul class="board">
{foreach $boards as $entry}
	{if $entry.board->GetType() >= 0 or $entry.board->GetType() <= 2}
		{if $entry.board->GetType() == 0}
			<li class="category">
		{elseif $entry.board->GetType() == 1}
			<li class="forum">
		{elseif $entry.board->GetType() == 2}
			<li class="link">
		{/if}
			<div class="container">
				<div class="container_head">
				{if $entry.board->GetType() == 1}
					<div class="board_top">
						<div class="board_info">
							<a href="{$entry.board->GetLink()}">
								<div class="title">{$entry.board->GetTitle()}</div>
							{if $entry.board->GetDesc()}
								<div class="description">{$entry.board->GetDesc()}</div>
							{/if}
							</a>
						</div>
						<div class="board_post">
							<p>{*{$entry.board->GetLastPost()->GetTitle()|default:'None'}*}None</p>
							<p>{*{$entry.board->GetLastPost()->GetUser()->GetName()|default:'None'}*}None</p>
						</div>
					</div>
					<div class="board_bottom">
						<div class="stats">{if $entry.board->GetType() == 2} (Views: {$entry.board->GetViews()}) {else} (Threads: {$entry.board->GetNumThreads()}, Posts: {$entry.board->GetNumPosts()}, Views: {$entry.board->GetViews()}){/if}</div>
					</div>
				{else}
					<a href="{$entry.board->GetLink()}">
						<div class="title">{$entry.board->GetTitle()}</div>
					{if $entry.board->GetDesc()}
						<div class="description">{$entry.board->GetDesc()}</div>
					{/if}
					</a>
				{/if}
				</div>
			{if $entry.sub_board}
				<div class="container_content">
					<ul class="sub_board">
					{foreach $entry.sub_board as $sub_entry}
						{if $sub_entry.board->GetType() >= 0 or $sub_entry.board->GetType() <= 2}
							{if $sub_entry.board->GetType() == 0}
								<li class="category">
							{elseif $sub_entry.board->GetType() == 1}
								<li class="forum">
							{elseif $sub_entry.board->GetType() == 2}
								<li class="link">
							{/if}
								<div class="container_head">
								{if $sub_entry.board->GetType() == 1}
									<div class="board_top">
										<div class="board_info">
											<a href="{$sub_entry.board->GetLink()}">
												<div class="title">{$sub_entry.board->GetTitle()}</div>
											{if $sub_entry.board->GetDesc()}
												<div class="description">{$sub_entry.board->GetDesc()}</div>
											{/if}
											</a>
										</div>
										<div class="board_post">
                                            <p>{*{$sub_entry.board->GetLastPost()->GetTitle()|default:'None'}*}None</p>
                                            <p>{*{$sub_entry.board->GetLastPost()->GetUser()->GetName()|default:'None'}*}None</p>
										</div>
									</div>
									<div class="board_bottom">
										<div class="stats">{if $sub_entry.board->GetType() == 2} (Views: {$sub_entry.board->GetViews()}) {else} (Threads: {$sub_entry.board->GetNumThreads()}, Posts: {$sub_entry.board->GetNumPosts()}, Views: {$sub_entry.board->GetViews()}){/if}</div>
									{if $sub_entry.sub_board}
										<ul class="sub_sub_board">
										{foreach $sub_entry.sub_board as $sub_sub_entry}
											<li><a href="{$sub_sub_entry.board->GetLink()}">{$sub_sub_entry.board->GetTitle()}</a></li>
										{/foreach}
										</ul>
									{/if}
									</div>
								{else}
									<a href="{$sub_entry.board->GetLink()}">
										<div class="title">{$sub_entry.board->GetTitle()}</div>
									{if $sub_entry.board->GetDesc()}
										<div class="description">{$sub_entry.board->GetDesc()}</div>
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
{if $current_board and $current_board->GetId() > 0 and $current_board->GetType() != 0}
<div class="container">
	<div class="container_head">
		<div class="title">Themen</div>
	</div>
	<div class="container_content">
		<ul>
		{foreach $threads as $thread}
			<li>
				<a href="{$thread->GetLink()}">{$thread->GetTopic()}</a>
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