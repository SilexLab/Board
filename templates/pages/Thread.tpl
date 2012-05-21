<div class="container">
{% if Posts %}
	<ul>
	{% for Post in Posts %}
		<li>
			Time: <strong>{{ Post.Time }}</strong><br>
			<br>
			Subject: <strong>{{ Post.Subject }}</strong><br>
			Message: <strong>{{ Post.Message }}</strong><br>
			<br>
			User: <strong><a href="{{ Post.User.Link }}">{{ Post.User.Name }}</a></strong><br><br>
		</li>
	{% endfor %}
	</ul>
{% else %}
	Dafuq? The Thread is empty!
{% endif %}
</div>