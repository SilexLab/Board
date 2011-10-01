<table border="1" width="100%">
<thead>
    <th>Thema</th>
    <th>Antworten</th>
    <th>Views</th>
    <th>Letzter Post</th>
</thead>
<tbody>
    {% for Topic in Topics %}
    <tr>
        <td style="padding: 4px;" width="70%">
            <div><a href="?page=Topic&TopicID={{ Topic.ID }}">{{ Topic.Topic }}</a></div>
            {% for User in Users %}
            {% if User.ID == Topic.UserID %}
            Von <a href="?page=User&userID={{ Topic.UserID }}">{{ User.Username }}</a>
            {% endif %}
            {% endfor %}
        </td>
        <td style="text-align:center">{{ Topic.Replies }}</td>
        <td style="text-align:center">{{ Topic.Views }}</td>
        <td style="text-align:center">{{ Topic.LastPostID }}</td>
    </tr>
    {% endfor %}
</tbody>
</table>