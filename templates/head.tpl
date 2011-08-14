<head>
	<meta charset="utf-8">
	<title>{{ PageTitle }}</title>
	<link rel="shortcut icon" href="favicon.ico">
	{% autoescape true %}
	{% for Style in CSSStyles %}
		<link href="{{ DIR_STYLE }}{{ CurrentStyle }}/{{ Style }}" rel="stylesheet" type="text/css">
	{% endfor %}

		<script src="javascripts/jquery.min.js" type="text/javascript"></script>
		<script src="javascripts/jquery.animate-colors-min.js" type="text/javascript"></script>
		<script src="javascripts/jquery.animate-shadow-min.js" type="text/javascript"></script>
	{% for JS in Javascripts %}
		<script src="{{ DIR_STYLE }}{{ CurrentStyle }}/{{ DIR_JS }}{{ JS }}" type="text/javascript"></script>
	{% endfor %}
	{% endautoescape %}
</head>