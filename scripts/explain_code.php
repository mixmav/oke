<?php
	require_once("utility_functions.php");

	$code_source = $_POST['code_source'];
	if ($code_source == "html-display") {
		$file_name = "index.html";
	} else if($code_source == "css-display"){
		$file_name = "design.css";
	}

	$reader = new file();
	$file_content = $reader->read($file_name, "../");
	$final_return = array();

	if ($file_name == "index.html") {
		array_push($final_return, preg_replace('/^<!DOCTYPE html>.*/is', 'The <span class="explain-tag">&lt;!DOCTYPE&gt;</span> declaration is not an HTML tag; it is an instruction to the web browser about what version of HTML the page is written in. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_doctype.asp">here</a> and <a target="_blank" href="https://ne.wikipedia.org/wiki/Document_type_declaration">here</a>.', $file_content));
		array_push($final_return, preg_replace('/<html>.*/is', 'The <span class="explain-tag">&lt;html&gt;</span> tag tells the browser that this is an HTML document. The <html> tag represents the root of an HTML document. The <html> tag is the container for all other HTML elements. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_html.asp">here</a>.', $file_content));
		array_push($final_return, preg_replace('/<head>.*/is', 'The <span class="explain-tag">&lt;head&gt;</span> element is a container for all the head elements. It can include a title for the document, scripts, styles, meta information, and more. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_head.asp">here</a>.', $file_content));
		array_push($final_return, preg_replace('!<title>(.*?)</title>.*!is', 'The <span class="explain-tag">&lt;title&gt;</span> tag is required in all HTML documents and it defines the title of the document. It defines a title in the browser toolbar, provides a title for the page when it is added to favorites and displays a title for the page in search-engine results. In this case, the title is <span class="explain-tag-val">$1</span>. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_title.asp">here</a>.', $file_content));
		array_push($final_return, preg_replace('/<meta charset=[\'"](.*?)[\'"]>.*/is', 'The <span class="explain-tag">&lt;meta&gt;</span> tag provides metadata about the HTML document. Metadata will not be displayed on the page, but will be machine parsable. Meta elements are typically used to specify page description, keywords, author of the document, last modified, and other metadata. The metadata can be used by browsers (how to display content or reload page), search engines (keywords), or other web services. In this case, the charset has been set to <span class="explain-tag-val">$1</span>. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_meta.asp">here</a>.', $file_content));
		array_push($final_return, preg_replace('/<meta name=[\'"]author[\'"] content=[\'"](.*?)[\'"]>.*/is', 'Just as above, this <span class="explain-tag">&lt;meta&gt;</span> tag specifies the author of the document. In this case that is <span class="explain-tag-val">$1</span>. More information <a target="_blank" href="http://www.w3schools.com/tags/att_meta_name.asp">here</a>.', $file_content));

		preg_replace_callback('!<link rel="stylesheet" type="text/css" href="(design.css)">!i', function($match){
			global $final_return;
			array_push($final_return, 'The <span class="explain-tag">&lt;link&gt;</span> tag defines a link between a document and an external resource. This tag is used here to link an externam style sheet called <span class="explain-tag-val">' . $match[1] . '</span>. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_link.asp">here</a>');
		}, $file_content);

		preg_replace_callback('!<script type="text/javascript" src="(.*)">.*</script>!i', function($match){
			global $final_return;
			array_push($final_return, 'The <span class="explain-tag">&lt;script&gt;</span> tag is used to define a client-side script (JavaScript). This element either contains scripting statements, or it points to an external script file through the src attribute. In this case, it links to an external JavaScript file called <span class="explain-tag-val">' . $match[1] . '</span>. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_script.asp">here</a>.');
		}, $file_content);

		array_push($final_return, preg_replace('!</head>.*!is', '<span class="explain-tag">&lt;/head&gt;</span> marks the end of the head section of the page.', $file_content));
		array_push($final_return, preg_replace('/<body>.*/is', 'The <span class="explain-tag">&lt;body&gt;</span> tag defines the document\'s body. It contains all the contents of an HTML document, such as text, hyperlinks, images, tables, lists, etc. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_body.asp">here</a>.', $file_content));

		preg_replace_callback('!<h([1-6]) class="(?P<className>.*?)">(.*?)</h\1>!', function($match){
			global $final_return;
			array_push($final_return, 'The <span class="explain-tag">&lt;h1&gt;</span> to <span class="explain-tag">&lt;h6&gt;</span> tags are used to define HTML headings. <span class="explain-tag">&lt;h1&gt;</span> defines the most important heading. <span class="explain-tag">&lt;h6&gt;</span> defines the least important heading. In this case, an <span class="explain-tag">&lt;h' . $match[1] . '&gt;</span> tag contains the text <span class="explain-tag-val">' . $match[3] . '</span>. More information <a target="_blank" href="http://www.w3schools.com/tags/tag_hn.asp">here</a>. This tag has a class called <span class="explain-tag-val">' . $match[2] . '</span> which is just a way of referring to it in the stylesheet. You can read more about classes <a target="_blank" href="http://www.w3schools.com/html/html_classes.asp">here</a>.');
		}, $file_content);

		preg_replace_callback('!<p class="(?P<className>.*?)">(.*?)</p>!', function($match){
			global $final_return;
			array_push($final_return, 'The HTML <span class="explain-tag">&lt;p&gt;</span> element defines a paragraph. In this case, a <span class="explain-tag">&lt;p&gt;</span> tag contains the text <span class="explain-tag-val">' . $match[2] . '</span>. More information <a target="_blank" href="http://www.w3schools.com/html/html_paragraphs.asp">here</a>. This tag has a class called <span class="explain-tag-val">' . $match[1] . '</span> which is just a way of referring to it in the stylesheet. You can read more about classes <a target="_blank" href="http://www.w3schools.com/html/html_classes.asp">here</a>.');
		}, $file_content);

		array_push($final_return, preg_replace('!.*</body>.*!is', '<span class="explain-tag">&lt;/body&gt;</span> marks the end of the document\'s body.', $file_content));
		array_push($final_return, preg_replace('!.*</html>.*!is', '<span class="explain-tag">&lt;/html&gt;</span> marks the end of the document.', $file_content));
	}

	echo "<ol>";
	foreach ($final_return as $value) {
		echo "<li>$value</li><br>";
	}
	echo "</ol>";
?>