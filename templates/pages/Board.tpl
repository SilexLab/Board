<h1>{{ CurrentBoardName }}</h1>
<ul>
{% for Board in Boards %}
{% if Board.Type == 0 %}
	{% if Board.ParentID !=0 %}
        <li>+ <a href="./index.php?page=Board&BoardID={{ Board.ID }}">{{ Board.Title }}</a></li>
	{% else %}
        <li><a href="./index.php?page=Board&BoardID={{ Board.ID }}">{{ Board.Title }}</a></li>
	{% endif %}
{% elseif Board.Type == 1 %}
	{% if Board.ParentID !=0 %}
        <li>+ <a href="./index.php?page=TopicList&BoardID={{ Board.ID }}">{{ Board.Title }}</a></li>
	{% else %}
        <li><a href="./index.php?page=TopicList&BoardID={{ Board.ID }}">{{ Board.Title }}</a></li>
	{% endif %}
{% endif %}
{% else %}
	No Boards
{% endfor %}
</ul>