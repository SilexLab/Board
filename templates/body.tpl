	{{ MessageBox }}
	<section class="Content">
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					{{ BreadCrumbs }}
				</nav>
				<div class="ContentContainer">
					{% if Page == 'Home' %}
						{% include "Index.tpl" %}
					{% elseif Page == 'Board' %}
					{% elseif Page == 'User' %}
					{% elseif Page == 'Error' %}
					{% elseif Page == 'Forwarding' %}
                    	{% include "forwarding.tpl" %}
					{% elseif Page == 'Register' %}
						{% include "register.tpl" %}
					{% endif %}
						{{ Content }}
				</div>
			</div>
		</div>
	</section>
