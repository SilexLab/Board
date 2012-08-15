<head>
	<meta charset="utf-8">
	<title>{{ Page.title }} - {{ PageTitle }}</title>
	<link rel="shortcut icon" href="favicon.ico">
{% autoescape true %}
	{% for File in Style.Files.CSS %}
		<link href="{{ File }}" rel="stylesheet" type="text/css">
	{% endfor %}

	<script type="text/javascript" src="javascripts/jquery.min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="javascripts/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" src="javascripts/jquery.animate-shadow-min.js"></script>
	{% for File in Style.Files.JS %}
		<script src="{{ File }}" type="text/javascript"></script>
	{% endfor %}
{% endautoescape %}
</head>