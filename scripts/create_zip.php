<?php
function create_zip($files = array(), $destination = '', $overwrite = false) {
	if(file_exists($destination) && !$overwrite) { return false; }
	$valid_files = array();
	if(is_array($files)) {
		foreach($files as $file) {
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	if(count($valid_files)) {
		$zip = new ZipArchive();
		if($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		foreach($valid_files as $file) {
			$new_filename = substr($file,strrpos($file,'/') + 1);
			$zip->addFile($file, $new_filename);
		}
		
		$zip->close();
		
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}

$path = "../" . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/";

$html = $path . "index.html";
$css = $path . "design.css";
$js = $path . "script.js";
$jquery = $path . "jquery.js";
$files = array($html, $css, $js, $jquery);
create_zip($files, "../temp/Website.zip");
?>