	<section class="Content">
		{% for Notification in Notifications %}
			<div class="notification {{ Notification.Type }}">
				<div class="notification_inner">
					<div class="Size">
						<div class="notification_content">{{ Notification.Message }}</div>
					</div>
				</div>
			</div>
		{% endfor %}
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					{% for Crumb in Crumbs %}
						<span class="Crust">
							<a href="{{ Crumb.Link }}" class="Crumb">
								<div class="CrumbWrap">{{ Crumb.Title }}</div>
							</a>
							<span class="Arrow"></span>
						</span>
					{% endfor %}
				</nav>
			</div>
			{% include "pages/" ~ Page.template|default("Home") ~ ".tpl" %}
			<div class="Container">
				<nav class="BreadCrumbs">
					{% for Crumb in Crumbs %}
						<span class="Crust">
							<a href="{{ Crumb.Link }}" class="Crumb">
								<div class="CrumbWrap">{{ Crumb.Title }}</div>
							</a>
							<span class="Arrow"></span>
						</span>
					{% endfor %}
				</nav>
			</div>
		</div>
	</section>
