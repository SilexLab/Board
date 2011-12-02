	<section class="Content">
		{% if MessageBoxes|length > 0 %}
			{% for MSGBox in MessageBoxes %}
				<div class="MessageBox {{ MSGBox.Type }}">
					<div class="Size">
						<div>{{ MSGBox.Message }}</div>
					</div>
				</div>
			{% endfor %}
		{% endif %}
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					{{ BreadCrumbs }}
				</nav>
				<div class="ContentContainer">
					{% include "pages/" ~ Page|default("Home") ~ ".tpl" %}
				</div>
			</div>
		</div>
	</section>
