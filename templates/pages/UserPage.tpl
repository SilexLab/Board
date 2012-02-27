{% for User in UserInfos %}
	<h1>{{ User.Username }}</h1>
	{{ Avatar }}<br>
	Registriert seit {{ User.RegisterTime|date("d.m.Y H:i") }}<br>
    Email ist: <a href="mailto:{{ User.Email }}">{{ User.Email }}</a><br>
	{% if User.Homepage is not empty %}
		<a target="_blank" href="{{ User.Homepage }}">{{ User.Homepage }}</a>
	{% endif %}
{% else %}
  No user has been found.
{% endfor %}