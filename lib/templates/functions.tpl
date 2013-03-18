{strip}
{* functions *}
{function input f="" type="" placeholder="" repeat=false}
	{assign "type" strtolower($type)}
	{if in_array($type, ['password', 'user', 'email'])}
		{* is textfield? *}
		{if in_array($type, ['user'])}
			{assign "ftype" 'text'}
		{else}
			{assign "ftype" $type}
		{/if}
		<div class="input {$type}">
			<input type="{$ftype}" name="{$f}"{if $placeholder} placeholder="{$placeholder}"{/if}>{if $type == 'password'}<span class="switch" title="{lang node='form.show_password'}"></span>{/if}
		</div>
	{else}
		{sprintf({lang node="form.input_not_found"}, $type)}
	{/if}
{/function}
{/strip}
