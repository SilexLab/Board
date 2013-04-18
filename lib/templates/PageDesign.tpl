<div class="w_content">
	<h1>Headline 1</h1>
	<h2>Headline 2</h2>
	<h3>Headline 3</h3>
	<h4>Headline 4</h4>
	<h5>Headline 5</h5>
	<h6>Headline 6</h6>

	<form method="POST">
		<p>Inputs</p>
		{input n="password" type="password" placeholder={lang n='form.password'}}
		{input n="password_repeat" type="password" placeholder={lang n='form.password_repeat'}}<br>
		{input n="user" type="user" placeholder={lang n='form.user'}}
		{input n="email" type="email" placeholder={lang n='form.email'}}<br>
		{input n="text" type="text" placeholder="Text"}
		<p>Big</p>
		{input n="text" type="text" placeholder="Text" big=true}<br>
		{input n="email" type="email" placeholder="{lang n='form.email'}" big=true}<br>
		{input n="password" type="password" placeholder="{lang n='form.password'}" big=true}
	</form>
	<p>Buttons</p>
	<div class="button_bar">
		<button>Button</button>
		<button class="highlight">Highlight</button>
		<input type="button" value="Input Button">
		<input class="highlight" type="submit" value="Input Submit">
	</div>
	<p>Buttongroup</p>
	<div class="button_bar">
		<div class="button_group">
			<button>Button</button>
			<button class="highlight">Highlight</button>
			<input type="button" value="Input Button">
			<input class="highlight" type="submit" value="Input Submit">
		</div>
	</div>
</div>
