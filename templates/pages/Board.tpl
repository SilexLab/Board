<h1>{{ CurrentBoardName }}</h1>
<ul>
<!-- <li>
          Kategorie
          <ul>
               <li>unterforen</li>
               <li>unterforen</li>
               <li>unterforen</li>
          </ul>
     </li>
     <li>
          Kategorie
          <ul>
               <li>unterforen</li>
          </ul>
     </li>
     <li>Forum</li>-->
{% for Board in Boards %}
<li>
	{% if Board.ParentID == 0 %}
		<a href="./index.php?page=Board&BoardID={{ Board.ID }}">{{ Board.Title }}</a>
		<ul>
			{% for Board2 in Boards %}
			{% if Board2.ParentID == Board.ID %}
				<li><a href="./index.php?page=Topiclist&BoardID={{ Board2.ID }}">{{ Board2.Title }}</a></li>
			{% endif %}
			{% endfor %}
		</ul>
        {% else %}
	{% endif %}
</li>
{% else %}
	No Boards
{% endfor %}
</ul>