<?php
	if (isset($_REQUEST['first_name']) && isset($_REQUEST['last_name'])) {
		$name = trim(strtolower($_REQUEST['first_name'] . " " . $_REQUEST['last_name']));
	} else{
		$name = $_COOKIE['name'];
	}
	$name = ucwords($name);
	$name = preg_replace('/[^\w ]/i', '', $name);

	$proj_name = $_REQUEST['proj_name'];
	$proj_name = str_replace(' ', '_', $proj_name);
	$proj_name = preg_replace('/[^\w\_\-\.]/i', '', $proj_name);

	$lang = $_POST['lang'];

	$dir = ")(" . md5(str_shuffle(uniqid() . $proj_name . $name)) . rand(1000000, 999999999999999) . crypt($proj_name, $name) . sha1($name);
	$dir = str_replace(' ', '_', $dir);
	$dir = preg_replace('/[^\w]/i', '', $dir);
	$dir = "user_data/" . $dir . "/";

	while (!is_dir($dir)) {
		str_shuffle(sha1($dir));
		mkdir($dir);
	}

	//--Has the file class and cookie func (and more)--
	require_once("utility_functions.php");
	/*
		function make_cookie($name, $value);
		Lasts for 10 years
	*/

	make_cookie("dir", $dir);
	make_cookie("name", $name);
	make_cookie("proj_name", $proj_name);
	make_cookie("lang", $lang);
	del_cookie("unique_class");
	del_cookie("current_subject_css");
	del_cookie("current_subject_html");
	mkdir($dir . $proj_name . "/"); //subdir

	$html = new file();
	$html->name = "index.html";
	$html->content = <<<EOD
<!DOCTYPE html>
<html>
<head>
	<title>$proj_name</title>
	<meta charset="UTF-8">
	<meta name="author" content="$name">
	<link rel="stylesheet" type="text/css" href="design.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>

</body>
</html>
EOD;
	$html->write();

	$css = new file();
	$css->name = "design.css";
	$css->content = <<<EOD
@charset "UTF-8";

*{
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

html, body{
	margin: 0;
	padding: 0;
	min-height: 100%;
}

/*Theme-start*/
/*Theme-end*/

/*Main-start*/
body{
	overflow-wrap: break-word;
  	word-wrap: break-word;
  	-ms-word-break: break-all;
    word-break: break-all;
  	word-break: break-word;
  	-ms-hyphens: auto;
  	-moz-hyphens: auto;
  	-webkit-hyphens: auto;
  	hyphens: auto;
}
/*Main-end*/
EOD;
	$css->write();

	$js = new file();
	$js->name = "script.js";
	$js->content = 	<<<EOD
$(document).ready(function(){

});
EOD;
	$js->write();

	copy("js/jquery-2.2.2.min.js", $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/jquery.js");
?>