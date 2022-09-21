<?php
	define("debug_mode", true);
	if (debug_mode) {
		error_reporting(E_ALL);
	} else{
		error_reporting(0);
	}
	define("version_number", "V2.1.1");
?>