<?php
	$code = array();
	$fopen = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/index.html", "r");
	$code['html'] = htmlspecialchars(fread($fopen, filesize("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/index.html")));

	$fopen = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/design.css", "r");
	$code['css'] = fread($fopen, filesize("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/design.css"));

	$fopen = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/script.js", "r");
	$code['js'] = fread($fopen, filesize("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/script.js"));
	
	$code['iframe_location'] = "../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/index.html";

	$code = json_encode($code);
	echo $code;
?>