	{{ MessageBox }}
	<section class="Content">
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					{{ BreadCrumbs }}
				</nav>
				<div class="ContentContainer">
					{% if Page == Home %}
					{% elseif Page == Board %}
					{% elseif Page == User %}
					{% endif %}
				</div>
			</div>
		</div>
	</section>
