<?php require_once("utility_require/config.php"); ?>
<?php require_once("scripts/utility_functions.php"); ?>
<?php
	if(!isset($_COOKIE['dir']) || !isset($_COOKIE['name']) || !isset($_COOKIE['proj_name']) || !is_dir($_COOKIE['dir'])){
		if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['proj_name'])) {
			require_once("scripts/initialize_proj.php");
		} else{
			header("Location: index.php");
			die();
		}
	}
	$name = $_COOKIE['name'];
	$proj_name = $_COOKIE['proj_name'];

	$reader = new file();
	$file_html = '<pre class="line-numbers"><code class="language-markup">' . htmlspecialchars($reader->read("index.html")) . "</code></pre>";
	$file_css = '<pre class="line-numbers"><code class="language-css">' . $reader->read("design.css") . "</code></pre>";
	$file_js = '<pre class="line-numbers"><code class="language-js">' . $reader->read("script.js") . "</code></pre>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Oke | Create</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="author" content="Manav Singh Gadhoke">
	<meta name="description" content="Create websites in your native language. No prior coding knowlege needed. For free, for everyone">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/prism.css">
	<link rel="stylesheet" type="text/css" href="css/main-design.css">
	<link rel="shortcut icon" type="img/png" href="images/favicon.png">
	<script type="text/javascript" src="js/jquery-2.2.2.min.js"></script>
	<script type="text/javascript" src="js/prism.js"></script>
	<script type="text/javascript" src="js/main-script.js"></script>
</head>

<body>
	<div id="screen"></div>
	<div id="code-explain">
		<p id="close-code-explain">Go Back</p>
		<div id="code-explain-actual-code" class="notranslate"></div>
		<div id="code-explain-actual-explanation"></div>
	</div>
	<div id="edit-info">
		<input type="text" name="$title" placeholder="Enter your $feature" maxlength="25">
		<br><br>
		<p align="center"><button onclick="sendEditInfo()"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;Update</button></p>
	</div>
	<div id="change-lang">
		<label><span class="glyphicon glyphicon-globe"></span>&nbsp;Change Input Language:&nbsp;</label>
		<select>
			<option value="en">English</option>
			<option value="af">Afrikaans</option>
			<option value="sq">Albanian</option>
			<option value="ar">Arabic</option>
			<option value="hy">Armenian</option>
			<option value="az">Azerbaijani</option>
			<option value="eu">Basque</option>
			<option value="be">Belarusian</option>
			<option value="bn">Bengali</option>
			<option value="bs">Bosnian</option>
			<option value="bg">Bulgarian</option>
			<option value="ca">Catalan</option>
			<option value="ceb">Cebuano</option>
			<option value="ny">Chichewa</option>
			<option value="zh-CN">Chinese Simplified</option>
			<option value="zh-TW">Chinese Traditional</option>
			<option value="hr">Croatian</option>
			<option value="cs">Czech</option>
			<option value="da">Danish</option>
			<option value="nl">Dutch</option>
			<option value="eo">Esperanto</option>
			<option value="et">Estonian</option>
			<option value="tl">Filipino</option>
			<option value="fi">Finnish</option>
			<option value="fr">French</option>
			<option value="gl">Galician</option>
			<option value="ka">Georgian</option>
			<option value="de">German</option>
			<option value="el">Greek</option>
			<option value="gu">Gujarati</option>
			<option value="ht">Haitian Creole</option>
			<option value="ha">Hausa</option>
			<option value="iw">Hebrew</option>
			<option value="hi">Hindi</option>
			<option value="hmn">Hmong</option>
			<option value="hu">Hungarian</option>
			<option value="is">Icelandic</option>
			<option value="ig">Igbo</option>
			<option value="id">Indonesian</option>
			<option value="ga">Irish</option>
			<option value="it">Italian</option>
			<option value="ja">Japanese</option>
			<option value="jw">Javanese</option>
			<option value="kn">Kannada</option>
			<option value="kk">Kazakh</option>
			<option value="km">Khmer</option>
			<option value="ko">Korean</option>
			<option value="lo">Lao</option>
			<option value="la">Latin</option>
			<option value="lv">Latvian</option>
			<option value="lt">Lithuanian</option>
			<option value="mk">Macedonian</option>
			<option value="mg">Malagasy</option>
			<option value="ms">Malay</option>
			<option value="ml">Malayalam</option>
			<option value="mt">Maltese</option>
			<option value="mi">Maori</option>
			<option value="mr">Marathi</option>
			<option value="mn">Mongolian</option>
			<option value="my">Myanmar (Burmese)</option>
			<option value="ne">Nepali</option>
			<option value="no">Norwegian</option>
			<option value="fa">Persian</option>
			<option value="pl">Polish</option>
			<option value="pt">Portuguese</option>
			<option value="ma">Punjabi</option>
			<option value="ro">Romanian</option>
			<option value="ru">Russian</option>
			<option value="sr">Serbian</option>
			<option value="st">Sesotho</option>
			<option value="si">Sinhala</option>
			<option value="sk">Slovak</option>
			<option value="sl">Slovenian</option>
			<option value="so">Somali</option>
			<option value="es">Spanish</option>
			<option value="su">Sudanese</option>
			<option value="sw">Swahili</option>
			<option value="sv">Swedish</option>
			<option value="tg">Tajik</option>
			<option value="ta">Tamil</option>
			<option value="te">Telugu</option>
			<option value="th">Thai</option>
			<option value="tr">Turkish</option>
			<option value="uk">Ukrainian</option>
			<option value="ur">Urdu</option>
			<option value="uz">Uzbek</option>
			<option value="vi">Vietnamese</option>
			<option value="cy">Welsh</option>
			<option value="yi">Yiddish</option>
			<option value="yo">Yoruba</option>
			<option value="zu">Zulu</option>
		</select>
		<br><br>
		<label><span class="glyphicon glyphicon-globe"></span>&nbsp;Change Page Language:</label>
		<div id="google_translate_element"></div>
		<script type="text/javascript">
			function googleTranslateElementInit() {
  			new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
			}
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<p>Done</p>
	</div>
	<div id="top-bar">
		<a href="main.php" id="heading">Oke<?php echo version_number; ?></a>
		<div id="menu">
			<a href="#"><span class="glyphicon glyphicon-book"></span>&nbsp;How to use</a>
			<a href="#"><span class="glyphicon glyphicon-piggy-bank"></span>&nbsp;Donate</a>
			<a href="#" id="change-lang-toggle"><span class="glyphicon glyphicon-globe"></span>&nbsp;Change Language</a>
		</div>
		<div id="nav-bar">
			<button data-target="html"><span class="glyphicon glyphicon-file"></span>&nbsp;HTML</button>
			<button data-target="css"><span class="glyphicon glyphicon-file"></span>&nbsp;CSS</button>
			<button data-target="js"><span class="glyphicon glyphicon-file"></span>&nbsp;JavaScript</button>
			<button data-target="output" class="active"><span class="glyphicon glyphicon-play-circle"></span>&nbsp;Output</button>
		</div>
	</div>
	<div id="left-wrapper">
	<div id="size-marker-wrapper">
		<div id="status-bar">
			<h3><span class="glyphicon glyphicon-scissors"></span>&nbsp;Currently editing: <span id="proj_name" class="notranslate"><?php echo $proj_name;?></span><br><span class="glyphicon glyphicon-user"></span>&nbsp;By: <span id="name" class="notranslate"><?php echo $name;?></span></h3>
		</div>
		<button id="toggle-advanced">
			<span id="show-advanced">
				<span class="glyphicon glyphicon-magnet"></span>&nbsp;Show
			</span>
			<span id="hide-advanced">
				<span class="glyphicon glyphicon-remove"></span>&nbsp;Hide
			</span>
			advanced options
		</button>
		<br>
		<a href="#" download id="download-proj"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Download Project</a>
		<br>
		<a href="#" id="start-new-proj"><span class="glyphicon glyphicon-plus"></span>&nbsp;Start a new project</a>
		<div id="share-project">
			<label><span class="glyphicon glyphicon-export"></span>&nbsp;Your project's code:</label><br>
			<input type="text" readonly="readonly" value="<?php echo preg_replace('!^user_data/(.*)/!i', '$1', $_COOKIE['dir']) ?>">
			<br>
			<button><span class="glyphicon glyphicon-copy"></span>&nbsp;Copy</button>
		</div>
	</div>
	<div id="convo">
		<div id="chat-top-bar">
			<h3>Talk to Oke</h3>
			<!-- <span class="glyphicon glyphicon-upload" id="image-upload">	 -->
		</div>
		<div id="chat">
				<p class="chat-message oke-chat-message">Hello!</p>
		</div>
		<textarea id="user-input" placeholder="Type a message..." autofocus=""></textarea>
	</div>
	</div>
	<div id="output-display" class="notranslate">
		<iframe src="<?php echo $_COOKIE['dir'] . $_COOKIE['proj_name'] . "/index.html"?>" class="display active-display" id="iframe"></iframe>
		<div id="js-display" class="display code-display">
			<?php echo $file_js; ?>
		</div>
		<div id="css-display" class="display code-display">
			<span class="current-code"><?php echo $file_css; ?></span>
		</div>
		<div id="html-display" class="display code-display">
			<button class="explain-code">Explain this code</button>
			<span class="current-code"><?php echo $file_html; ?></span>
		</div>
	</div>
</body>
</html>