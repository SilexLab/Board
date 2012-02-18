<head>
	<meta charset="utf-8">
	<title>{{ Page.Title }}</title>
	<link rel="shortcut icon" href="favicon.ico">
{% autoescape true %}
	{% for File in Style.Files.CSS %}
		<link href="{{ Dir.Style }}{{ Style.Name }}/{{ File }}" rel="stylesheet" type="text/css">
	{% endfor %}

	<script src="javascripts/jquery.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.animate-colors-min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.animate-shadow-min.js" type="text/javascript"></script>
	{% for File in Style.Files.JS %}
		<script src="{{ Dir.Style }}{{ Style.Name }}/{{ Dir.JS }}{{ File }}" type="text/javascript"></script>
	{% endfor %}
{% endautoescape %}
</head>