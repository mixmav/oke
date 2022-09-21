<?php
	class file{
		public $name;
		public $content;
		private $type;

		private function find_type(){
			preg_match("/.*\.(.*)/", $this->name, $return);
			$this->type = "." . $return[1];
		}

		public function write($path = ""){
			$this->find_type();
			if ($this->type == ".html" || $this->type = ".css" || $this->type = ".js") {
				$fopen = fopen($path . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/" . $this->name, "w");
				fwrite($fopen, $this->content);
				fclose($fopen);
			}
			clearstatcache();
		}
		public function read($name, $path = ""){
			return fread(fopen($path . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/$name", "r"), filesize($path . $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/$name"));
		}
	}

	function make_cookie($name, $value){
		setcookie($name, $value, time() + (86400 * 3650), '/');
		$_COOKIE[$name] = $value;
	}

	function del_cookie($name){
		setcookie($name, "", time() - (86400 * 9999), '/');
		unset($_COOKIE[$name]);
	}
?>