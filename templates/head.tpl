<head>
	<meta charset="utf-8">
	<title>{$page.title} - {$page_title}</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="{$style.dir}style.php?p={$page.page}">

	<script type="text/javascript" src="javascripts/jquery.min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="javascripts/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.animate-shadow-min.js"></script>
	{foreach $style.files.js as $file}
		<script src="{$file|escape}" type="text/javascript"></script>
	{/foreach}
</head>