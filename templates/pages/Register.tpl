<form method="post">
	<div class="container">
		<div class="container_head">
			<div class="title">{lang node="sbb.register.register"}</div>
            <div class="step_bar register">
				<style type="text/css">
                    .register.step_bar .step_bullet_wrap { margin-right: {100 / ($register.steps - 1)}%; } /* 100 / num of steps - 1 */
                    .register.step_bar .step_bullet_wrap:last-child { margin: 0; }
                </style>
                {for $i=1 to $register.steps}
                    <div class="step_bullet_wrap {if $i < $register.current_step}done{elseif $i == $register.current_step}current{/if}">
                        <div class="step_bullet">{$i}</div>
                    </div>
                {/for}
            </div>
		</div>
        <style type="text/css">
		#register.container_progress .progress { width: {(100 / ($register.steps - 1) * ($register.current_step - 1))}%; } /* Current Progress */
        </style>
		<div class="container_progress step" id="register">
			<div class="progress_bar">
				<div class="progress"></div>
			</div>
		</div>
		<div class="container_content">
			<div class="register_container">
				<div class="register_info">
					<div class="register_info_content">
						<div class="avatar">
							<div class="avatar_image"><img src="styles/Lumen%20Lunae/icons/g_64_user.png" alt="avatar"></div> {* {$register.avatar} *}
						</div>
						<div class="username">[Username]</div>
						<div class="email">[E-Mail]</div>
						<div class="password">[Password]</div>
					</div>
				</div>
				<div class="register_content">
					<h1>[Username]</h1>
					<input type="text" name="t_r_username" value="{$register.username}">
					<span class="available">Ajax: Benutzername verfügbar / nicht verfügbar</span>
					<div class="step_infos">
						infos über benutzernamen
					</div>
				</div>
			</div>
		</div>
		<div class="container_footer">
			<input type="submit" name="s_r_prev" value="[Prev]" disabled>
			<input type="submit" name="s_r_skip" value="[Skip]" disabled>
			<input type="submit" name="s_r_next" value="[Next]">
		</div>
	</div>
</form>

{*
<div class="container">
	<div class="register_content">
		{if $Register.Step == "register.username" or not $Register.Step}
			<h1>{lang node="sbb.register.username"}</h1>
			<form method="post">
				<input type="text" name="Username" value="{$Register.Username|$default:''}" placeholder="{lang node="sbb.register.username"}" autocomplete="on" required>
				<input type="submit" name="sub_username" value="Weiter">
				<div>
					Notes:<br>
					"Dieser Benutzername ist bereits vergeben, wollen sie sich stattdessen einloggen? [...]"
				</div>
			</form>
		{elseif $Register.Step == "register.password"}
			<h1>{lang node="sbb.register.password"}</h1>
			<form method="post">
				<input type="password" name="Password" value="{$Register.RealPw|default:''}" placeholder="{lang node="sbb.register.password"}" autocomplete="off" required>
				<input type="password" name="Password_Re" placeholder="{lang node="sbb.register.password_repeat"}" autocomplete="off" required>
				<input type="submit" name="sub_password" value="Weiter">
			</form>
		{elseif $Register.Step == "register.email"}
			<h1>{lang node="sbb.register.email"}</h1>
			<form method="post">
				<input type="email" name="Email" value="{$Register.Email|default:''}" placeholder="{lang node="sbb.register.email"}" autocomplete="on" required>
				<input type="email" name="Email_Re" placeholder="{lang node="sbb.register.email_repeat"}" autocomplete="off" required>
				<input type="submit" name="sub_email" value="Weiter">
			</form>
		{elseif $Register.Step == "register.captcha"}
			<h1>{lang node="sbb.register.captcha"}</h1>
			<form method="post">
				hier gibts noch nüscht!
				<input type="submit" name="sub_password" value="Weiter">
			</form>
		{/if}
		{if $Register.Step != "register.username"}
			<form method="post">
				<input type="submit" name="sub_back" value="Zurück">
				<input type="submit" name="sub_restart" value="Neu beginnen">
			</form>
		{/if}
	</div>
	<div class="register_info">
		<img src="{$Register.Avatar}"><br><br>
		Benutzername: {$Register.Username|default:''}<br>
		Passwort: {$Register.Password|default:''}<br>
		E-Mail: {$Register.Email|default:''}<br>
	</div>
	<div style="clear:both;"></div>
</div>
*}