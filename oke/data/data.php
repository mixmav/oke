<?php
	$replace_keywords = array(
			"create" => array(
				'\bcreat(?:ed|e|ing)\b',
				'\bmak(?:e|ing)\b',
				'\bdraw(?:ing)?\b',
				'\bwrit(?:e|ing)\b',
				'\badd(?:ing)?\b',
				'\bappend(?:ing)?\b',
				'\bset(?:ting)?\b',
				'\bcontruct(?:ing)?\b',

			),
			"change" => array(
				'\bchang(?:e|ing)\b',
				'\bedit(?:ing)?\b'
			),
			"delete" => array(
				'\bremov(?:e|ing)\b',
				'\bdelet(?:e|ing)\b',
				'\bundo\b'
			),
			//-------------------////-------------------////-------------------//
			"paragraph" => array(
				'\bpara(?:graphs?)?\b',
				'\bsmall\s*text\b',
				'(?<!big\s)\btext\b'
			),
			"body" => array(
				'\bweb(\s|-)?(page|site)\b',
				'\bdocument\b'
			),
			"heading" => array(
				'\bbig text\b'
			),
			"all" => array(
				'\b(every|each)(\s|-)?things?\b',
				'\ball( the)? things?\b'
			),
			//-------------------////-------------------////-------------------//
			"sad" => array(
				'\bdepress(ing|ed)?\b',
				'\bdull(ed)?\b',
				'\bdark\b',
				'\bsad(dest)?\b',
				'\bunhapp(y|iest)\b',
				'\bdevastating\b',
				'\bdisastrous\b',
				'\bshocking\b',
				'\bserious\b'
			),
			"happy" => array(
				'\bhapp(y|iest)\b',
				'\blight\b',
				'\bexciting\b',
				'\bpositive\b'
			),
			"love" => array(
				'\bkind(ness)?\b',
				'\bemotional\b',
				'\blov(e|ing)\b',
				'\bcaring\b'
			),
			"dtheme" => array(
				'\b(no|delete|default|delete the|delete this)(-|\s)?themes?\b',
				'\bdelete all themes?\b'
			),
			"theme" => array(
				'\blook(s|ing)?\b',
				'\bfeel(s|ing)?\b',
				'\bappearance\b',
				'\bthemed?\b'
			),
			//-------------------////-------------------////-------------------//
			"px" => array(
				'\bpixels?\b',
				'\bcm\b',
				'\bcenti\s?meters?\b',
				'\b(?<=\d)\spx\b'
			),
			"%" => array(
				'\bpercent\b'
			),
			//-------------------////-------------------////-------------------//
			"big" => array(
				'\blarge\b',
				'\bhuge\b',
				'\benormous\b',
				'\bhumongous\b',
				'\bgigantic\b'
			),
			//-------------------////-------------------////-------------------//
			"font-size" => array(
				'\bfont\s?size\b',
				'\bsize of( the)? (paragraph|font|create)\b',
				'\bparagraph(-|\s)size\b'
			),
			"background" => array(
				'\bbackground((\s|-)color)?\b',
				'\bbgd\b'
			),
			"color" => array(
				'\bcolou?r\b',
				'\bparagraph(\s|-)color\b',
				'\bfont(\s|-)?color\b'
			),
			"transparent" => array(
				'\bno color\b',
				'\bnone\b'
			)
	);

	$keywords = array(
		"action" => array(
			'/\bcreate\b/i',
			'/\bchange\b/i',
			'/\bdelete\b/i'
		),
		"subject" => array(
			'/\ball\b/i',
			'/\bheading\b/i',
			'/\bparagraph\b/i',
			'/\bbody\b/i'
		),
		"features" => array(
			'/\bfont-size\b/i',
			'/\bbackground\b/i',
			'/\bcolor\b/i'
		),
		"themes" => array(
			'/\bhappy\b/i',
			'/\bsad\b/i',
			'/\blove\b/i',
			'/\bdtheme\b/i'
		)
	);

	$colors = array(
		"/\btransparent\b/i",
		"/\baliceblue\b/i",
		"/\bantiquewhite\b/i",
		"/\baqua\b/i",
		"/\baquamarine\b/i",
		"/\bazure\b/i",
		"/\bbeige\b/i",
		"/\bbisque\b/i",
		"/\bblack\b/i",
		"/\bblanchedalmond\b/i",
		"/\bblue\b/i",
		"/\bblueviolet\b/i",
		"/\bbrown\b/i",
		"/\bburlywood\b/i",
		"/\bcadetblue\b/i",
		"/\bchartreuse\b/i",
		"/\bchocolate\b/i",
		"/\bcoral\b/i",
		"/\bcornflowerblue\b/i",
		"/\bcornsilk\b/i",
		"/\bcrimson\b/i",
		"/\bcyan\b/i",
		"/\bdarkblue\b/i",
		"/\bdarkcyan\b/i",
		"/\bdarkgoldenrod\b/i",
		"/\bdarkgray\b/i",
		"/\bdarkgrey\b/i",
		"/\bdarkgreen\b/i",
		"/\bdarkkhaki\b/i",
		"/\bdarkmagenta\b/i",
		"/\bdarkolivegreen\b/i",
		"/\bdarkorange\b/i",
		"/\bdarkorchid\b/i",
		"/\bdarkred\b/i",
		"/\bdarksalmon\b/i",
		"/\bdarkseagreen\b/i",
		"/\bdarkslateblue\b/i",
		"/\bdarkslategray\b/i",
		"/\bdarkslategrey\b/i",
		"/\bdarkturquoise\b/i",
		"/\bdarkviolet\b/i",
		"/\bdeeppink\b/i",
		"/\bdeepskyblue\b/i",
		"/\bdimgray\b/i",
		"/\bdimgrey\b/i",
		"/\bdodgerblue\b/i",
		"/\bfirebrick\b/i",
		"/\bfloralwhite\b/i",
		"/\bforestgreen\b/i",
		"/\bfuchsia\b/i",
		"/\bgainsboro\b/i",
		"/\bghostwhite\b/i",
		"/\bgold\b/i",
		"/\bgoldenrod\b/i",
		"/\bgray\b/i",
		"/\bgrey\b/i",
		"/\bgreen\b/i",
		"/\bgreenyellow\b/i",
		"/\bhoneydew\b/i",
		"/\bhotpink\b/i",
		"/\bindianred\b/i",
		"/\bindigo\b/i",
		"/\bivory\b/i",
		"/\bkhaki\b/i",
		"/\blavender\b/i",
		"/\blavenderblush\b/i",
		"/\blawngreen\b/i",
		"/\blemonchiffon\b/i",
		"/\blightblue\b/i",
		"/\blightcoral\b/i",
		"/\blightcyan\b/i",
		"/\blightgoldenrodyellow\b/i",
		"/\blightgray\b/i",
		"/\blightgrey\b/i",
		"/\blightgreen\b/i",
		"/\blightpink\b/i",
		"/\blightsalmon\b/i",
		"/\blightseagreen\b/i",
		"/\blightskyblue\b/i",
		"/\blightslategray\b/i",
		"/\blightslategrey\b/i",
		"/\blightsteelblue\b/i",
		"/\blightyellow\b/i",
		"/\blime\b/i",
		"/\blimegreen\b/i",
		"/\blinen\b/i",
		"/\bmagenta\b/i",
		"/\bmaroon\b/i",
		"/\bmediumaquamarine\b/i",
		"/\bmediumblue\b/i",
		"/\bmediumorchid\b/i",
		"/\bmediumpurple\b/i",
		"/\bmediumseagreen\b/i",
		"/\bmediumslateblue\b/i",
		"/\bmediumspringgreen\b/i",
		"/\bmediumturquoise\b/i",
		"/\bmediumvioletred\b/i",
		"/\bmidnightblue\b/i",
		"/\bmintcream\b/i",
		"/\bmistyrose\b/i",
		"/\bmoccasin\b/i",
		"/\bnavajowhite\b/i",
		"/\bnavy\b/i",
		"/\boldlace\b/i",
		"/\bolive\b/i",
		"/\bolivedrab\b/i",
		"/\borange\b/i",
		"/\borangered\b/i",
		"/\borchid\b/i",
		"/\bpalegoldenrod\b/i",
		"/\bpalegreen\b/i",
		"/\bpaleturquoise\b/i",
		"/\bpalevioletred\b/i",
		"/\bpapayawhip\b/i",
		"/\bpeachpuff\b/i",
		"/\bperu\b/i",
		"/\bpink\b/i",
		"/\bplum\b/i",
		"/\bpowderblue\b/i",
		"/\bpurple\b/i",
		"/\bred\b/i",
		"/\brosybrown\b/i",
		"/\broyalblue\b/i",
		"/\bsaddlebrown\b/i",
		"/\bsalmon\b/i",
		"/\bsandybrown\b/i",
		"/\bseagreen\b/i",
		"/\bseashell\b/i",
		"/\bsienna\b/i",
		"/\bsilver\b/i",
		"/\bskyblue\b/i",
		"/\bslateblue\b/i",
		"/\bslategray\b/i",
		"/\bslategrey\b/i",
		"/\bsnow\b/i",
		"/\bspringgreen\b/i",
		"/\bsteelblue\b/i",
		"/\btan\b/i",
		"/\bteal\b/i",
		"/\bthistle\b/i",
		"/\btomato\b/i",
		"/\bturquoise\b/i",
		"/\bviolet\b/i",
		"/\bwheat\b/i",
		"/\bwhite\b/i",
		"/\bwhitesmoke\b/i",
		"/\byellow\b/i",
		"/\byellowgreen\b/i"
	);
?>