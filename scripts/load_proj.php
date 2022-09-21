<?php
	require_once("utility_functions.php");
	$dir = "../user_data/" . $_POST['dir'] . "/";
	if (is_dir($dir)) {
		$file = scandir($dir)[2];
		$fopen = fopen("$dir$file/index.html", "r");
		$fread = fread($fopen, filesize("$dir$file/index.html"));
		fclose($fopen);
		preg_match('!<meta\s*name\s*=\s*[\'"]author[\'"]\s*content\s*=\s*[\'"](?P<name>.*)[\'"]>!i', $fread, $name);
		make_cookie("dir", "user_data/" . $_POST['dir'] . "/");
		make_cookie("name", $name['name']);
		make_cookie("proj_name", $file);
		echo true;
	} else{
		echo false;
	}
?>