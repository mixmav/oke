<?php
	if (isset($_COOKIE['dir']) && isset($_COOKIE['name']) && isset($_COOKIE['proj_name'])) {
		if(is_dir($_COOKIE['dir'])){
			header("Location: main.php");
			die();
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Oke | Get Started</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="author" content="Manav Singh Gadhoke">
	<meta name="description" content="Create websites in your native language. No prior coding knowlege needed. For free, for everyone">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index-design.css">
	<link rel="shortcut icon" type="img/png" href="images/favicon.png">
	<script type="text/javascript" src="js/jquery-2.2.2.min.js"></script>
	<script type="text/javascript" src="js/index-script.js"></script>
</head>

<body>
	<div id="translate">
		<label><span class="glyphicon glyphicon-globe"></span>&nbsp;Change Language:&nbsp;</label>
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
	</div>
		<div id="google_translate_element"></div>
		<script type="text/javascript">
			function googleTranslateElementInit() {
  			new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
			}
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<div id="main">
		<h1><span class="glyphicon glyphicon-lock"></span>Welcome to Oke!</h1>
		<br>
		<form action="main.php" method="POST">
				<h2><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Let's start!</h2>
				<ul>
					<li>
						<h5><span class="glyphicon glyphicon-user"></span>What's your name?</h5>
						<label>First Name</label>
						<br>
						<input type="text" name="first_name" placeholder="First Name" autofocus="" required="" autocomplete="off" spellcheck="false" maxlength="20">
						<br>
						<label>Last Name</label>
						<br>
						<input type="text" name="last_name" placeholder="Last Name" required="" autocomplete="off" spellcheck="false" maxlength="20">
					</li>
					<br>
					<li>
						<h5><span class="glyphicon glyphicon-pencil"></span>Give a name to your project</h5>
						<label>Your Project's Name</label>
						<br>
						<input type="text" name="proj_name" placeholder="Your Project Name" required="" autocomplete="off" maxlength="20">
					</li>
				</ul>
				<input type="hidden" name="lang" value="10">
				<button type="submit"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;Submit</button>
		</form>
	</div>

	<button id="load-proj-toggle">Want to open an existing project?&nbsp;<span class="glyphicon glyphicon-plus"></span></button>

	<div id="load-proj">
			<br>
			<label>Enter the code of the <br>project you wish to open&nbsp;<span class="glyphicon glyphicon-barcode"></span></label>
			<br>
			<input type="text" name="dir" placeholder="Project's Code">
			<br><br>
			<button id="load-proj-btn">Load Project&nbsp;<span class="glyphicon glyphicon-import"></span></button>
	</div>
</body>
</html>