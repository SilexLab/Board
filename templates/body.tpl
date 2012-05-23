{% import "macros.tpl" as macros %}
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
			{{ macros.breadcrumb(Crumbs) }}
			{% include "pages/" ~ Page.template|default("Home") ~ ".tpl" %}
			{{ macros.breadcrumb(Crumbs) }}
		</div>
	</section>
