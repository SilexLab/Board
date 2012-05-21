	<section class="content">
		{% for Notification in Notifications %}
			<div class="notification {{ Notification.Type }}">
				<div class="notification_inner">
					<div class="size">
						<div class="notification_content">{{ Notification.Message }}</div>
					</div>
				</div>
			</div>
		{% endfor %}
		<div class="size">
			<div class="container">
				<nav class="bread_crumbs">
					{% for Crumb in Crumbs %}
						<span class="crust">
							<a href="{{ Crumb.Link }}" class="crumb">
								<div class="crumb_wrap">{{ Crumb.Title }}</div>
							</a>
							<span class="arrow"></span>
						</span>
					{% endfor %}
				</nav>
			</div>
			{% include "pages/" ~ Page.template|default("Home") ~ ".tpl" %}
			<div class="container">
				<nav class="bread_crumbs">
					{% for Crumb in Crumbs %}
						<span class="crust">
							<a href="{{ Crumb.Link }}" class="crumb">
								<div class="crumb_wrap">{{ Crumb.Title }}</div>
							</a>
							<span class="arrow"></span>
						</span>
					{% endfor %}
				</nav>
			</div>
		</div>
	</section>
