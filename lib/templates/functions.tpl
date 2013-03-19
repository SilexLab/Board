{strip}
{* Global functions *}
{function input f="" type="" placeholder="" repeat=false}
	{$type = strtolower($type)}
	{if in_array($type, ['password', 'user', 'email'])}
		{* is textfield? *}
		{if in_array($type, ['user'])}
			{$ftype = 'text'}
		{else}
			{$ftype = $type}
		{/if}
		<div class="input {$type}">
			<input type="{$ftype}" name="{$f}"{if $placeholder} placeholder="{$placeholder}"{/if}>{if $type == 'password'}<span class="switch" title="{lang node='form.show_password'}"></span>{/if}
		</div>
	{else}
		{sprintf({lang node="form.input_not_found"}, $type)}
	{/if}
{/function}
{/strip}
