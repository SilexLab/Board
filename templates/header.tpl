{% include "userbar.tpl" %}
	<header class="MinSize">
		<div class="LogoBlock">
			<div class="Logo Size">
				<a href="./" title="{{ lang=com.sbb.header.logo_title }}">
					<img src="{{ Dir.Style }}{{ Style.Name }}/images/logo.png" alt="Logo">
				</a>
				<div class="Slogan">
				{% if Slogan %}
					{{ Slogan }}
				{% else %}
					{{ lang=com.sbb.header.slogan }}
				{% endif %}
				</div>
			</div>
		</div>
		<nav class="Menu">
			<div class="Size">
				<ul class="MenuList">
				{% for MenuPoint in Menu %}
					{% if MenuPoint.Active %}
                    <li class="active"><a href="{{ MenuPoint.Link }}"><div>{{ MenuPoint.Name }}</div></a></li>
                    {% else %}
                    <li><a href="{{ MenuPoint.Link }}"><div>{{ MenuPoint.Name }}</div></a></li>
                    {% endif %}
				{% endfor %}
				</ul>
				<ul class="SubMenu">
					{{ SubMenu }}
				</ul>
				<div id="SearchForm">
					<form method="get" accept-charset="utf-8">
						<input title="{{ lang=com.sbb.header.search.title }}" type="search" value="" placeholder="{{ lang=com.sbb.header.search.placeholder }}" name="Search" id="Search" pattern=".+" required><input type="submit" id="SearchSubmit" value="">
					</form>
				</div>
			</div>
		</nav>
	</header>