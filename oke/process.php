<?php
	require_once("utility.php");
	require_once("../scripts/utility_functions.php");
	$input = $_POST['input'];
	$input = preg_replace('/"([^"]*)"/i', '<span class="notranslate">$1</span>', htmlspecialchars_decode($input));
	$lang = $_POST['lang'];
	if ($lang != "en") {
		$apiKey = 'REMOVED MY KEY FOR SECURITY';
    	@$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($input) . "&source=$lang&target=en";
    	if(!@$responseDecoded = json_decode(file_get_contents($url), true)){
    		$input = $_POST['input'];
    	} else{
    		$input = $responseDecoded['data']['translations'][0]['translatedText'];
    	}
	}
    $input = preg_replace('!<span class="notranslate">(.*?)</span>!i', '"$1"', $input);

	normalize(htmlspecialchars_decode($input));

	$success_message_done = false;
	class Structure{
		protected $raw_input;
		protected $action;
		protected $subject;
		protected $features;

		function __get($get){
			return $this->$get;
		}

		function __set($name, $value){
			$this->$name = $value;
		}

		public function oke(){
			$this->set_assets();
		}

		private function set_assets(){
			// if(!$this->set_theme() && !$this->set_html() && !$this->set_css()){
			// 	$this->idk();
			// }
			global $success_message_done;
			$this->set_theme();
			$this->set_html();
			$this->set_css();
			if (!$success_message_done) {
				$this->idk();
			}
		}

		private function set_theme(){
			$raw_theme = $this->get_theme();
			if(!$raw_theme){
				return false;
			} else{
				if (sizeof($raw_theme) > 1) {
					$theme = end($raw_theme);
				} else if (sizeof($raw_theme) == 1) {
					$theme = $raw_theme[0];
				}
			}
			switch ($theme) {
				case 'sad':
					$code = <<<EOD
body{
	background: #424242;
	padding: 20px;
}

h1, h2, h3, h4, h5, h6, p, a, button{
	color: #F5F5F5;
	font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
	font-weight: bold;
}
EOD;
					break;
				case 'happy':
					$code = <<<EOD
body{
	background: #F2EEB3;
	padding: 20px;
}

h1, h2, h3, h4, h5, h6, p, a, button{
	color: #59323C;
	font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
	font-weight: bold;
}
EOD;
					break;
				case 'love':
					$code = <<<EOD
body{
	background: #da4336;
	padding: 20px;
}

h1, h2, h3, h4, h5, h6, p, a, button{
	color: white;
	font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
	font-weight: bold;
}
EOD;
					break;
				default:
					$code = <<<EOD
EOD;
					break;
			}
			$file = new file();

			$content = $file->read("design.css", "../");
			make_cookie("css_backup", $content);
			$content = preg_replace('!(/\*Theme-start\*/).*(/\*Theme-end\*/)!is', '$1' . "\n" . $code . "\n" . '$2', $content);

			$file->name = "design.css";
			$file->content = $content;
			$file->write("../");
			$this->done();
			return true;
		}

		private function set_html(){
			$action_array = $this->get_action();
			$subject_array = $this->get_subject();
			$value_array = $this->get_string_value();

			if (sizeof($action_array) == 1) {
				$action = $action_array[0];
			} else {
				$action = end($action_array);
			}

			if ($action == "delete") {
				$file = new file();
				
				$file->name = "index.html";
				$file->content = $_COOKIE['html_backup'];
				$file->write("../");

				$file->name = "design.css";
				$file->content = $_COOKIE['css_backup'];
				$file->write("../");
				
				$this->done();
				return true;
			}

			if (!$subject_array) {
				if (isset($_COOKIE['current_subject_html']) && $_COOKIE['current_subject_html'] != "") {
					$subject = $_COOKIE['current_subject_html'];
				} else{
					return false;
				}
			}

			if (!$value_array) {
				if (@!in_array("delete", $action_array)) {
					return false;
				}
			}

			if (sizeof($subject_array) == 1) {
				$subject = $subject_array[0];
			} else {
				$subject = current($subject_array);
			}

			if (sizeof($value_array) == 1) {
				$value = $value_array[0];
			} else {
				$value = end($value_array);
			}
			switch ($subject) {
				case 'paragraph':
					$class = $this->new_class_name();
					$code = <<<EOD
<p class="$class">$value</p>
EOD;
					break;
				case 'heading':
					$class = $this->new_class_name();
					$code = <<<EOD
<h1 class="$class">$value</h1>
EOD;
				break;
				default:
					$class = $this->new_class_name();
					$code = <<<EOD
	<h1 class="$class">$value</h1>
EOD;
					break;
			}
			$file = new file();

			$content = $file->read("index.html", "../");
			make_cookie("html_backup", $content);
			$content = preg_replace('!(?=</body>)!is', "    " . $code . "\n", $content);

			$file->name = "index.html";
			$file->content = $content;
			$file->write("../");
			$this->done();
			make_cookie("current_subject_html", $subject);
		}

		private function set_css(){
			$action_array = $this->get_action();
			$subject_array = $this->get_subject();
			$feature_array = $this->get_features();
			$color_and_length_array = $this->get_color_and_lengths();
			$semi_code = array();
			$code = array();

			if (sizeof($action_array) == 1) {
				$action = $action_array[0];
			} else {
				$action = end($action_array);
			}

			if (!$subject_array) {
				if (isset($_COOKIE['current_subject_css']) && $_COOKIE['current_subject_css'] != "") {
					$subject = $_COOKIE['current_subject_css'];
				} else{
					return false;
				}
			}

			if (!$color_and_length_array) {
				$color_and_length_array = array("black");
			}

			if (!$feature_array) {
				$feature_array = array();
				array_push($feature_array, "color");
			}

			if (sizeof($subject_array) == 1) {
				$subject = $subject_array[0];
			} else{
				$subject = current($subject_array);
			}

			if ($subject != "all" && $subject != "body") {
				$subject = $_COOKIE['unique_class'];
			} else if($subject == "all"){
				$subject = "*";
			} else if($subject == "body"){
				$subject = "body";
			}

			if (sizeof($feature_array) != sizeof($color_and_length_array)) {
				if (sizeof($feature_array) > sizeof($color_and_length_array)) {
					while (sizeof($feature_array) > sizeof($color_and_length_array)) {
						array_pop($feature_array);
					}
				} else {
					if (sizeof($color_and_length_array) - sizeof($feature_array) == 1) {
						array_unshift($feature_array, "color");
					} else{
						while (sizeof($feature_array) < sizeof($color_and_length_array)) {
							array_pop($color_and_length_array);
						}
					}
				}
			}
			foreach ($feature_array as $key => $feature) {
				if ($subject == "*") {
					$push = <<<EOD
    $feature: $color_and_length_array[$key] !important;
EOD;
				}else{
			 		$push = <<<EOD
    $feature: $color_and_length_array[$key];
EOD;
				}
			 	array_push($semi_code, $push);
			 }

			if ($subject == "*" || $subject == "body"){
			 	array_push($code, "\n$subject{");
			 	foreach ($semi_code as $semi_final_code) {
			 		array_push($code, $semi_final_code);
			 	}
			} else{
			 	array_push($code, "\n._$subject{");
			 	foreach ($semi_code as $semi_final_code) {
			 		array_push($code, $semi_final_code);
			 	}
			}

			 array_push($code, "}");
			 $code = implode("\n", $code);

			$file = new file();
			$content = $file->read("design.css", "../");
			make_cookie("css_backup", $content);
			$content = preg_replace('!(?=/\*Main-end\*/)!is', $code . "\n", $content);

			if (!preg_match('/\.\_\d+{\s*color:\s*black;\s*}/i', $code)) {
				$file->name = "design.css";
				$file->content = $content;
				$file->write("../");
				$this->done();
				make_cookie("current_subject_css", $subject);
			}
			return false;
		}

		private function get_action(){
			global $keywords;

			$raw_input_words = explode(' ', $this->ignore_quotes($this->raw_input));
			$return = array();

			foreach ($raw_input_words as $raw_input_word) {
				foreach ($keywords['action'] as $keyword_regex) {
					if (preg_match($keyword_regex, $raw_input_word, $temp_matched_keyword)) {
						if ($temp_matched_keyword != "") {
							array_push($return, $temp_matched_keyword[0]);
							unset($temp_matched_keyword);
						}
					}
				}
			}
			if (sizeof($return) > 0) {
				return $return;
			} else{
				return false;
			}
		}

		private function get_theme(){
			global $keywords;
			$return = array();

			$raw_input_words = explode(' ', $this->ignore_quotes($this->raw_input));

			foreach ($raw_input_words as $raw_input_word) {
				foreach ($keywords['themes'] as $theme_regex) {
					if (preg_match($theme_regex, $this->ignore_quotes($raw_input_word), $matched_theme)) {
						if ($matched_theme != "") {
							array_push($return, $matched_theme[0]);
							unset($matched_theme);
						}
					}
				}
			}
			if (sizeof($return) > 0) {
				return $return;
			} else{
				return false;
			}
		}

		private function get_subject(){
			global $keywords;
			$raw_input_words = explode(' ', $this->ignore_quotes($this->raw_input));
			$return = array();

			foreach ($raw_input_words as $raw_input_word) {
				foreach ($keywords['subject'] as $subject_regex) {
					if (preg_match($subject_regex, $raw_input_word, $temp_matched_subject)) {
						if ($temp_matched_subject != "") {
							array_push($return, $temp_matched_subject[0]);
							unset($temp_matched_subject);
						}
					}
				}
			}
			if (sizeof($return) > 0) {
				return $return;
			} else{
				return false;
			}
		}

		public function get_features(){
			global $keywords;
			$return = array();
			$raw_input_words = explode(' ', $this->ignore_quotes($this->raw_input));

			foreach ($raw_input_words as $raw_input_word) {
				foreach ($keywords['features'] as $feature_regex) {
					if (preg_match($feature_regex, $raw_input_word, $temp_matched_subject)) {
						if ($temp_matched_subject != "") {
							array_push($return, $temp_matched_subject[0]);
							unset($temp_matched_subject);
						}
					}
				}
			}
			if (sizeof($return) > 0) {
				return $return;
			} else{
				return false;
			}
		}

		private function get_color_and_lengths(){
			global $colors;
			$return = array();

			$raw_input_words = explode(' ', $this->ignore_quotes($this->raw_input));

			foreach ($raw_input_words as $raw_input_word) {
				foreach ($colors as $color_regex) {
					if (preg_match($color_regex, $this->ignore_quotes($raw_input_word), $matched_color)) {
						if ($matched_color != "") {
							array_push($return, $matched_color[0]);
							unset($matched_color);
						}
					}
				}
				if (preg_match('/(?P<hexColor>#([a-f0-9]{6}|[a-f0-9]{3}))(.*)/is', $this->ignore_quotes($raw_input_word), $matched_color)) {
					array_push($return, $matched_color['hexColor']);
					unset($matched_color);
				}
				if(preg_match('/(?P<rgbColor>rgb\s?\(\s?(?:\d{1,3}\s?,\s?){2}\d{1,3}\s?\))/i', $raw_input_word, $matched_color)) {
					array_push($return, $matched_color['rgbColor']);
					unset($matched_color);
				}
				if(preg_match('/(?P<rgbaColor>rgba\s?\(\s?(?:\d{1,3}\s?,\s?){3}[0-9]\.[0-9]*?\s?\))/i', $raw_input_word, $matched_color)) {
					array_push($return, $matched_color['rgbaColor']);
					unset($matched_color);
				}
				if (preg_match('/(?P<len>\d+)(?P<unit>(?:px|em|pc|%))/i', $raw_input_word, $regex_matched_length)) {
					array_push($return, $regex_matched_length['len'] . $regex_matched_length['unit']);
					unset($regex_matched_length);
				}
			}
			if (sizeof($return) > 0) {
				return $return;
			} else{
				return false;
			}
		}

		private function get_string_value(){
			$return = array();
			if (preg_match('/"([^"]+)"/is', $this->raw_input, $regex_matched_string_value)) {
				array_push($return, $regex_matched_string_value[1]);
			}
			if (sizeof($return) > 0) {
				return $return;
			} else{
				return false;
			}
		}

		protected function ignore_quotes($subject){
			return preg_replace_callback('/("[^"]*")|.*/is', function($m) use($subject){
				return !empty($m[1]) ? false : $m[0];
			}, htmlspecialchars_decode($subject));
		}

		private function new_class_name(){
			if(!isset($_COOKIE['unique_class']) || $_COOKIE['unique_class'] == ""){
				make_cookie("unique_class", 1);
				return "_1";
			} else{
				$unique_class = $_COOKIE['unique_class'];
				$new_num = $unique_class + 1;
				make_cookie("unique_class", $new_num);
				$unique_class = (string) "_" . $new_num;
				return $unique_class;
			}
		}

		private function get_curr_class_name(){
			echo (string) '_' . $_COOKIE['unique_class'];
		}

		public function idk(){
			$i = rand(0, 4);
			$reply = array(
				'I don\'t understand what you mean. Keep it simple and precise. Let\'s try again.',
				'Are you sure you typed that completely? I don\'t understand incomplete instructions. Let\'s try again.',
				'I\'m not sure I get your point. Try keeping it simple and complete! Let\'s try again.',
				'I don\'t think I comprehend that. Try keeping it simple and make sure to be complete; let\'s try again.',
				'Um... I don\'t know what that means! Keep it simple and thorough and I\'ll give it another shot!'
			);
			echo $reply[$i];
			die();
		}

		public function done(){
			global $success_message_done;
			if (!$success_message_done) {
				$i = rand(0, 4);
				$reply = array(
					'Great choice! I had so much fun doing that! What\'s next?',
					'Okay, I\'m doing that. This page looks awesome! What else should we do?',
					'I just did what you told me to do. You\'re so good at this!',
					'I did what you asked for. Do you like it? What\'s next?',
					'Done. This looks amazing! What else should we do?'
				);
			echo $reply[$i];
			$success_message_done = true;
			}
		}
	}

	class Sentence extends Structure{

	}

	$sentence = new Sentence();
	$sentence->raw_input = $input;
	$sentence->oke();
?>