<div class="Container">
{% for User in Users %}
	<a href="?page=User&userID={{ User.ID }}"><div style="margin: 5px; border: 1px solid; border-radius: 5px; padding: 5px;">
	<span style="color: #333;">{{ User.Username }}</span><br>
	Registered since {{ User.RegisterTime|date("d.m.y H:i") }}
	</div></a>
{% else %}
  No user was found.
{% endfor %}
</div>