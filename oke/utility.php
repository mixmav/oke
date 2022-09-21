<?php
	require_once("data/data.php");
	function normalize($input){
		global $input, $replace_keywords, $keywords;
		$input = trim($input);
		$input = greg_replace('(\s)(\s)*', ' ', $input);
		$input = greg_replace('\.(\.)*', '.', $input);
		$input = greg_replace('\!', '.', $input);
		$input = greg_replace('\?', '.', $input);

		foreach ($keywords as $keyword) {
			foreach ($keyword as $actual_keyword) {
				$actual_keyword = preg_replace('!/(.*)/i!', '$1', $actual_keyword);
				$input = preg_replace('/(' . $actual_keyword . ')\s*"/i', '$1"', $input);
				$input = preg_replace('/"\s*(' . $actual_keyword . ')/i', '"$1', $input);
			}
		}

		foreach ($replace_keywords as $key => $replace_keyword_array) {
			foreach ($replace_keyword_array as $replace_keyword) {
				$input = greg_replace($replace_keyword, $key, $input);
			}
		}

		if(preg_match('/(?P<rgbColor>rgb\s?\(\s?(?:\d{1,3}\s?,\s?){2}\d{1,3}\s?\))/i', ignore_quotes($input), $temp_regex_space_remover)) {
			$input = str_replace($temp_regex_space_remover[0], str_replace(' ', '', $temp_regex_space_remover[0]), ignore_quotes($input));
			unset($temp_regex_space_remover);
		}

		if(preg_match('/(?P<rgbaColor>rgba\s?\(\s?(?:\d{1,3}\s?,\s?){3}[0-9]\.[0-9]*?\s?\))/i', ignore_quotes($input), $temp_regex_space_remover)) {
			$input = str_replace($temp_regex_space_remover[0], str_replace(' ', '', $temp_regex_space_remover[0]), ignore_quotes($input));
			unset($temp_regex_space_remover);
		}

		// $input = preg_replace('/(?<!#)(\d+)(?!px)/i', '$1px', $input);
		$input = preg_replace('/\b(?<!#)(?<!rgb\()(?<!rgba\()(?<![,.])(\d+)(?!px)\b/i', '$1px', $input);
	}
	function greg_replace($pattern, $replacement, $subject){
		return preg_replace_callback('/("[^"]*")|' . $pattern . '/i', function($m) use($replacement){
        		return !empty($m[1]) ? $m[1] : $replacement;
        	}, htmlspecialchars_decode($subject));
	}

	function ignore_quotes($subject){
			return preg_replace_callback('/("[^"]*")|.*/is', function($m) use($subject){
				return !empty($m[1]) ? false : $m[0];
			}, htmlspecialchars_decode($subject));
	}
?>