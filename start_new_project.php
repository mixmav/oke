<?php
	require_once("scripts/utility_functions.php");
	del_cookie('dir');
	del_cookie('name');
	del_cookie('proj_name');
	header("Location: index.php");
	die();
?>