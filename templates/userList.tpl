{% for User in Users %}
	<a href="?page=User&userID={{ User.ID }}">{{ User.UserName }}</a>
{% else %}
  No user has been found.
{% endfor %}