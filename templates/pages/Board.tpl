<h1>{{ CurrentBoardName }}</h1>
<ul class="Board">
{% for Board in Boards %}
	{% if Board.ParentID == 0 %}
        <li class="BoardCategory">
            <p class="BoardHead">
            	<a class="BoardTitle" href="./index.php?page=Board&BoardID={{ Board.ID }}">{{ Board.Title }}</a><br>
                Beschreibung ...
			</p>
            <ul class="BoardForum">
                {% for Board2 in Boards %}
                {% if Board2.ParentID == Board.ID %}
                    <li class="BoardList">
                            <div class="ListLeft"><a class="bla" href="./index.php?page=Topiclist&BoardID={{ Board2.ID }}">{{ Board2.Title }}</a></div>
                            <div class="ListMiddle">Thema: Bla</div>
                            <div class="ListRight">23 Themen</div>
                    </li>
                {% endif %}
                {% endfor %}
            </ul>
            {% else %}
        </li>
    {% endif %}
{% else %}
	No Boards
{% endfor %}
</ul>