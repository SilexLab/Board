            <tr title="{$TopicRead}">
                <td style="padding: 4px;" width="70%">
                    <div><a href="?page=Topic&TopicID={$TopicID}">{$TopicTitle}</a></div>
                    Von <a href="?page=User&userID={$TopicCreatorID}">{$TopicCreator}</a>
                </td>
                <td style="text-align:center">{$TopicAnswers}</td>
                <td style="text-align:center">{$TopicViews}</td>
                <td style="text-align:center">{$TopicLastAnswer} <span style="font-size: 6pt; color:#FF0000;">[BUGGY]</span></td>
            </tr>
