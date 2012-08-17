	<section class="content">
		{foreach $Notifications as $Notification}
			<div class="notification {$Notification.Type}">
				<div class="notification_inner">
					<div class="size">
						<div class="notification_content">{$Notification.Message}</div>
					</div>
				</div>
			</div>
		{/foreach}
		<div class="size">
			<div class="container">
                <nav class="bread_crumbs">
                    {foreach $Crumbs as $Crumb}
                        <div class="crust">
                            <a href="{$Crumb.Link}" class="crumb">
                                <span class="crumb_wrap">{$Crumb.Title}</span>
                            </a>
                            <span class="arrow"></span>
                        </div>
                    {/foreach}
                </nav>
            </div>
            {$IncludePage=$Page.template|default:'Home'}
			{include file="pages/$IncludePage.tpl"}
			<div class="container">
                <nav class="bread_crumbs">
                    {foreach $Crumbs as $Crumb}
                        <div class="crust">
                            <a href="{$Crumb.Link}" class="crumb">
                                <span class="crumb_wrap">{$Crumb.Title}</span>
                            </a>
                            <span class="arrow"></span>
                        </div>
                    {/foreach}
                </nav>
            </div>
		</div>
	</section>
