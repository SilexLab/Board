<div class="TopicTable">
    <table class="Main" width="100%" >
    <thead>
        <tr>
            <th class="TopicHead" colspan="4">Test</th>
        </tr>
        <tr class="Description">
            <td class="Description">Thema</td>
            <td class="Description">Antworten</td>
            <td class="Description">Aufrufe</td>
            <td class="Description">Letzte Antwort</td>
        </tr>
    </thead>
    <tbody>
        {% for Topic in Topics %}
        <tr>
            <td class="Content" style="" width="70%">
                <p class="Topic"><a href="?page=Topic&TopicID={{ Topic.ID }}">{{ Topic.Topic }}</a></p>
                {% for User in Users %}
                {% if User.ID == Topic.UserID %}
                Von <a href="?page=User&userID={{ Topic.UserID }}">{{ User.Username }}</a>
                {% endif %}
                {% endfor %}
            </td>
            <td class="TextTopic">{{ Topic.Replies }}</td>
            <td class="TextTopic">{{ Topic.Views }}</td>
            <td class="TextTopic">{{ Topic.LastPostID }}</td>
        </tr>
        {% endfor %}
    </tbody>
    </table>
</div>