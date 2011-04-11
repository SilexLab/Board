<?php
function search_query() {
	$Search = '';
	if(isset($_GET['search']))
		$Search = $_GET['search'];
	
	echo $Search;
	
}
?><style type="text/css">
#searchform {
	background: #CCC;
	height: 40px;
	width: 500px;
}

#searchsubmit {
	height: 24px;
	width: 26px;
	background: none;
	margin: 7px 6px 7px -27px;
	border-width: 1px;
	border-style: none;
}

#search {
	border: 1px solid #000;
	width: 200px;
	height: 26px;
	line-height: 26px;
	background: #EEE;
	margin-top: 6px;
	margin-bottom: 6px;
	margin-left: 6px;
	padding-left: 5px;
	padding-right: 31px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}
</style>

<form method="GET" id="searchform" accept-charset="utf-8" action="">
      <input title="Suche" type="search" value="<?php search_query(); ?>" placeholder="Suche..." name="search" id="search" pattern=".+" required><input type="submit" id="searchsubmit" value="S">
</form>