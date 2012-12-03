{* TODO: Make a nicer error page *}
{if $compose.error}

<div class="container">

	{if $compose.type == 1}
    {lang node="sbb.error.no_board"}
	{elseif $compose.type == 2}
	{lang node="sbb.error.no_thread"}
	{/if}

</div>

{else}

<form method="post">

	<input type="hidden" name="type" value="{$compose.type}">
	<input type="hidden" name="target" value="{$compose.target}">

	<div class="container">

		<div class="container_head">
			{if $compose.type == 1}
			<div class="title">{lang node="sbb.compose.compose_thread"}</div>
            <div class="description">{lang node="sbb.compose.thread_in"} {$compose.board->GetTitle()}</div>
			{elseif $compose.type == 2}
			<div class="title">{lang node="sbb.compose.compose_answer"}</div>
			<div class="description">{lang node="sbb.compose.answer_to"} {$compose.thread->GetTopic()}</div>
			{/if}
		</div>

		<div class="container_content">

			{if $compose.type == 1} {* New threads only *}
			<fieldset class="compose_info">
                <legend>{lang node="sbb.compose.info"}</legend>
				<label for="Topic">{lang node="sbb.compose.topic"}</label><br>
                <input type="text" name="topic" id="topic" required="required">
				{* Prefixes - someday *}
			</fieldset>
			{/if}

			<fieldset class="compose_message">
                <legend>{lang node="sbb.compose.message"}</legend>
				<div class="compose_message_text">
					<textarea name="message" id="message" required="required"></textarea>
				</div>
			</fieldset>

			<fieldset class="compose_settings">
				<legend>{lang node="sbb.compose.settings"}</legend>

				<table>
					<tr>
						<td>{lang node="sbb.compose.settings.silexcode"}</td>
						<td>
							<select name="setting_silexcode">
								<option value="1" selected="selected">{lang node="sbb.compose.settings.yes"}</option>
								<option value="0">{lang node="sbb.compose.settings.no"}</option>
							</select>
						</td>
					</tr>
                    <tr>
                        <td>{lang node="sbb.compose.settings.html"}</td>
                        <td>
                            <select name="setting_html">
                                <option value="1">{lang node="sbb.compose.settings.yes"}</option>
                                <option value="0" selected="selected">{lang node="sbb.compose.settings.no"}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{lang node="sbb.compose.settings.smileys"}</td>
                        <td>
                            <select name="setting_smileys">
                                <option value="1" selected="selected">{lang node="sbb.compose.settings.yes"}</option>
                                <option value="0">{lang node="sbb.compose.settings.no"}</option>
                            </select>
                        </td>
                    </tr>
				</table>

			</fieldset>

		</div>

		<div class="container_footer">
			<div class="compose_number_characters left">
				{lang node="sbb.compose.number_characters"}: <span id="number_characters">0</span>
			</div>

			<div class="button_bar right">
				<div class="button_group">
					<input type="submit" name="save" id="save" class="s_button" value="{lang node="sbb.compose.save"}">
					{*<input type="submit" name="preview" id="preview" class="s_button" value="{lang node="sbb.compose.preview"}">*}
					<div class="s_button">{lang node="sbb.compose.preview"}</div>
				</div>
			</div>

		</div>

	</div>

</form>
{/if}