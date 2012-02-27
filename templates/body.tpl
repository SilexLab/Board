	<section class="Content">
		{% for MSGBox in MessageBoxes %}
			<div class="MessageBox {{ MSGBox.Type }}">
				<div class="Size">
					<div>{{ MSGBox.Message }}</div>
				</div>
			</div>
		{% endfor %}
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					{% for Crumb in Crumbs %}
						<span class="Crust">
							<a href="{{ Crumb.Link }}" class="Crumb">{{ Crumb.Title }}</a>
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
							<a href="{{ Crumb.Link }}" class="Crumb">{{ Crumb.Title }}</a>
							<span class="Arrow"></span>
						</span>
					{% endfor %}
				</nav>
			</div>
		</div>
	</section>
