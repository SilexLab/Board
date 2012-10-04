	<section class="content">
		{foreach $notifications as $notification}
			<div class="notification {$notification.type}">
				<div class="notification_inner">
					<div class="size">
						<div class="notification_content">{$notification.message}</div>
					</div>
				</div>
			</div>
		{/foreach}
		<div class="size">
			<div class="container">
				<nav class="bread_crumbs">
					{foreach $crumbs as $crumb}
						<div class="crust">
							<a href="{$crumb.link}" class="crumb">
								<span class="crumb_wrap">{$crumb.title}</span>
							</a>
						</div>
					{/foreach}
				</nav>
			</div>
			{$include_page=$page.template|default:'Home'}
			{include file="$include_page"}
			<div class="container">
				<nav class="bread_crumbs">
					{foreach $crumbs as $crumb}
						<div class="crust">
							<a href="{$crumb.link}" class="crumb">
								<span class="crumb_wrap">{$crumb.title}</span>
							</a>
						</div>
					{/foreach}
				</nav>
			</div>
		</div>
	</section>
