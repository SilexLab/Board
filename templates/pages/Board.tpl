<h1>{{ CurrentBoardName }}</h1>
<table border="0" width="100%" class="Board">
	{% for Board in Boards %}
		{% if Board.Type == 0 %}
			<tr class="BoardCategory"><th><a href="./index.php?page=Board&BoardID={{ Board.ID }}">{{ Board.Title }}</a></th></tr><div>
		{% else %}
			<tr class="BoardForum"><td>+ <a href="./index.php?page=TopicList&BoardID={{ Board.ID }}">{{ Board.Title }}</a></td></tr>
		{% if Board.ID == 5 %}
        	</div>	
         {% endif %}	
		{% endif %}
		{% else %}
			No Boards
	{% endfor %}
</table>
