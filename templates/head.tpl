<head>
	<meta charset="utf-8">
	<title>{$Page.title} - {$PageTitle}</title>
	<link rel="shortcut icon" href="favicon.ico">
	{foreach $Style.Files.CSS as $File}
		<link href="{$File|escape}" rel="stylesheet" type="text/css">
	{/foreach}

	<script type="text/javascript" src="javascripts/jquery.min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="javascripts/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.animate-shadow-min.js"></script>
	{foreach $Style.Files.JS as $File}
		<script src="{$File|escape}" type="text/javascript"></script>
	{/foreach}
</head>