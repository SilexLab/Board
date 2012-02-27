{% for User in Users %}
	<a href="?page=User&userID={{ User.ID }}">{{ User.Username }}</a>
{% else %}
  No user has been found.
{% endfor %}