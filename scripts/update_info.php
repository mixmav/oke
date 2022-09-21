<?php
	require_once("utility_functions.php");
	

	$input = $_POST['input'];
	$change = $_POST['change'];
	if ($change == "name") {
		global $input;
		$input = ucwords(strtolower($input));
		$input = preg_replace('/[^\w ]/i', '', $input);
		$fopen_r = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . '/index.html', "r");
		$data = fread($fopen_r, filesize("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . '/index.html'));
		$data = preg_replace('!(?<=<meta name=["\']author["\'] content=["\']).*(?=["\']>)!i', $input, $data);
		fclose($fopen_r);
		
		$fopen_w = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . '/index.html', "w");
		fwrite($fopen_w, $data);
		fclose($fopen_w);
		make_cookie($change, $input);

	} else if($change == "proj_name"){
		$input = str_replace(' ', '_', $input);
		$input = preg_replace('/[^\w\_\-\.]/i', '', $input);
		@$fopen_r = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . '/index.html', "r");
		@$data = fread($fopen_r, filesize("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . '/index.html'));
		$data = preg_replace('!(?<=<title>).*(?=</title>)!i', $input, $data);
		@fclose($fopen_r);
		
		@$fopen_w = fopen("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . '/index.html', "w");
		@fwrite($fopen_w, $data);
		@fclose($fopen_w);

		@rename("../" . $_COOKIE['dir'] . $_COOKIE['proj_name'], "../" . $_COOKIE['dir'] . $input);
		make_cookie($change, $input);
	}

	echo $input;
?>