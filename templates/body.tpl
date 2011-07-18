	{{ MessageBox }}
	<section class="Content">
		<div class="Size">
			<div class="Container">
				<nav class="BreadCrumbs">
					{{ BreadCrumbs }}
				</nav>
				<div class="ContentContainer">
					{% include "pages/" ~ Page ~ ".tpl" %}
				</div>
			</div>
		</div>
	</section>
