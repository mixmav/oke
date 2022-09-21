$(document).ready(function(){
	checkSize();
	$('select').val(getCookie('lang'));
	var toggleAdvanced = $('#toggle-advanced');
	$('body, #edit-info, #screen, #nav-bar, #hide-advanced, .code-display, #change-lang').hide();
	$('#code-explain').hide().css('top', '-150%');
	$('#nav-bar').css('right', -$('#nav-bar').width());
	$('#change-lang-toggle').html('<span class="glyphicon glyphicon-globe"></span>&nbsp;Change Language (Current: ' + $('select').val() + ')');

	$('#nav-bar button').click(function(){
		var target = $(this).attr('data-target');
		$('.active').removeClass('active');
		$(this).addClass('active');
		reloadCode();
		if (target == "html") {
			$('.active-display').removeClass('active-display').hide();
			$('#html-display').addClass('active-display').fadeIn();
		} else if (target == "css") {
			$('.active-display').removeClass('active-display').hide();
			$('#css-display').addClass('active-display').fadeIn();
		} else if (target == "js") {
			$('.active-display').removeClass('active-display').hide();
			$('#js-display').addClass('active-display').fadeIn();
		} else if (target == "output") {
			$('.active-display').removeClass('active-display').hide();
			$('#output-display iframe').addClass('active-display').show();
		}
	});

	$('#status-bar h3 span').click(function(event){
		event.stopPropagation();
		edit_info($(this).html(), $(this).attr('id'));
		$('#edit-info input').val('');
	});

	var counter = 1;
	$(toggleAdvanced).click(function(){
		var navBar = $('#nav-bar');
		$(toggleAdvanced).prop('disabled', true);
		if (counter == 1) {
			$(navBar).show(function(){
				$(navBar).animate({right: 20}, "fast", function(){
					$(navBar).animate({right: 0}, "fast", function(){
						$('#show-advanced').fadeOut("fast", function(){
							$('#hide-advanced').fadeIn("fast");
						});
						$(toggleAdvanced).prop('disabled', false);
					});
				});
			});
			counter++;

		} else{
			if($('.active-display').attr('id') != "iframe"){
				$('.active-display').removeClass('active-display').hide();
				$('#output-display iframe').addClass('active-display').fadeIn();
				$('#nav-bar button:nth-child(4)').click();
			}
			$(navBar).animate({right: 20}, "fast", function(){
				$(navBar).animate({right: -$(navBar).width()}, "fast", function(){
					$(navBar).hide();
					$('#hide-advanced').fadeOut("fast", function(){
						$('#show-advanced').fadeIn("fast");
					});
					$(toggleAdvanced).prop('disabled', false);
				});
			});
			counter--;

		}
	});

	$('#share-project input').mousedown(function(){
		$(this).focus().select();
	});

	$('#share-project button').click(function(){
		copyToClipboard($('#share-project input').val());
	});

	$('#convo #user-input').keydown(function(event){
		if (event.keyCode == "13") {
			if (!event.shiftKey) {
				event.preventDefault();
				event.stopPropagation();
				if ($(this).val() != "") {
					process();
				}
			} else{
				return true;
			}
		}
	});

	$('#download-proj').click(function(event){
		event.preventDefault();
		$.post("../scripts/clear_zip.php", function(){
			$.post("../scripts/create_zip.php", function(){
				window.location.href = "temp/website.zip";
			});
		});
	});

	$('#start-new-proj').click(function(event){
		event.preventDefault();
		if (confirm("Please download or copy your project's code before starting a new one.\n Click OK to continue")) {
			window.location.href = "../start_new_project.php";
		}
	});

	$('#change-lang-toggle').click(function(){
		$('#screen').fadeIn("fast", function(){
			$('#change-lang').fadeIn("fast");
		});
	});

	$(document).keydown(function(e){
		e.stopPropagation();
		if (e.keyCode == 27) {
			$('#change-lang').fadeOut("fast", function(){
				$('#screen').fadeOut("fast");
			});
        }
		$('#change-lang-toggle').html('<span class="glyphicon glyphicon-globe"></span>&nbsp;Change Language (Current: ' + $('select').val() + ')');
	});

	$('#change-lang p').click(function(event){
		event.stopPropagation();
		$('#change-lang').fadeOut("fast", function(){
			$('#screen').fadeOut("fast");
		});
		$.post('../scripts/lang_cookie_update.php', {lang: $('select').val()}, function(){
			$('#change-lang-toggle').html('<span class="glyphicon glyphicon-globe"></span>&nbsp;Change Language (Current: ' + $('select').val() + ')');
		})
	});

	$('.explain-code').click(function(){
		if ($('.active-display').attr('id') == 'html-display') {
			$('#code-explain-actual-code').html($('#html-display .current-code').html());
		} else if($('.active-display').attr('id') == 'css-display') {
			$('#code-explain-actual-code').html($('#css-display .current-code').html());
		}
		$.post('../scripts/explain_code.php', {code_source: $('.active-display').attr('id')}, function(code){
			$('#code-explain-actual-explanation').html(code);
			$('#code-explain').show().animate({top: 30}, "slow", function(){
				$('#code-explain').animate({top: 0}, "fast");
				$('.explain-tag, .explain-tag-val').addClass('notranslate');
			});
		});
	});

	$('#close-code-explain').click(function(){
		$('#code-explain').animate({top: '-150%'}, function(){
			$('#code-explain').hide();
		})
	});
});

$(window).load(function(){
	layout();
	$('body').hide().fadeIn("fast", function(){
		layout();
		$('#user-input').focus();
	});
});

$(window).resize(function(){
	layout();
	checkSize();
});

function checkSize(){
	if ($(window).height() < 500 || $(window).width() < 500) {
		$('body').html("<h1>Your device is too small!</h1><h3>Oke isn't supported on smaller screens yet.</h3><h3>Tip: Make sure your browser is maximized.</h3><h2><a href='#' onclick='reload()'>Click here</a> to retry.</h2>");
	}
}

function reload(){
	location.reload();
};

function edit_info($old_info, $title){
	editInfo = $('#edit-info');
	screen = $('#screen');
	$(editInfo).slideDown("fast");
	$(screen).fadeIn();
	$(document).keydown(function(e){
		if (e.keyCode == 27) {
			$(editInfo).hide("fast");
			$(screen).fadeOut();
		} else if(e.keyCode == 13){
			sendEditInfo();
		}
	});

	if ($title == "name") {
		$feature = "Name";
	} else if($title == "proj_name"){
		$feature = "Project's name";
	}
	$('#edit-info input').attr('name', $title).attr('placeholder', "Enter your " + $feature);
	setTimeout(function(){
		$('#edit-info input').focus().select();
	}, 150);
};

function reloadCode(){
	$.post("../scripts/reload_code.php", function(code){
		$('#html-display pre code').html($.parseJSON(code).html);
		$('#css-display pre code').html($.parseJSON(code).css);
		$('#js-display pre code').html($.parseJSON(code).js);
		loadIframe("iframe", $.parseJSON(code).iframe_location);

	});
	setTimeout(function(){
		Prism.highlightAll();
	}, 50)
}

function loadIframe(iframeName, url) {
	var $iframe = $('#' + iframeName);
	if ($iframe.length) {
		iframe.contentWindow.location.reload(true);
	    return false;
	}
	return true;
}

function sendEditInfo(){
	var updateInput = $('#edit-info input');
	var input = $(updateInput).val();
	if (input == "") {
		alert("You can't leave this blank.");
		return false;
	}
	var change = $(updateInput).attr('name');
	$.post("../scripts/update_info.php", {input: input, change: change}, function(newOutput){
		if (change == "proj_name") {
			$('#status-bar #proj_name').html(newOutput);
		} else if(change == "name"){
			$('#status-bar #name').html(newOutput);
		}
	});
	$(editInfo).hide("fast");
	$(screen).fadeOut("fast", function(){
		reloadCode();
	});
}

function copyToClipboard(text) {
	window.prompt("Press Ctrl + c or Cmd + c and Enter to copy text.", text);
}

function layout(){
	var leftWrapper = $('#left-wrapper');
	$(leftWrapper).height($(window).height() - 70);
	$('#convo').height(($(leftWrapper).height() - $('#size-marker-wrapper').height()) - 120);
	$('#output-display').height($(window).height() - 70);
}

function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function process(){
	var convoChat = $('#convo #chat');
	var textarea = $('#convo #user-input');
	var input = nl2br(escapeHtml($(textarea).val()));
	var lang = $('select').val();

	convoChat.append('<p class="chat-message user-chat-message">' + input + '</p>').animate({scrollTop: $(convoChat).prop("scrollHeight")});
	$('.user-chat-message:last').hide().show("fast");

	$(textarea).attr('disabled', true).val("").addClass('disabled');
	$.post("../oke/process.php", {input: input, lang: lang},function(output){
		setTimeout(function(){
			convoChat.append('<p class="chat-message oke-chat-message">' + output + '</p>').animate({scrollTop: $(convoChat).prop("scrollHeight")});
			$('.oke-chat-message:last').hide().show("fast", function(){
				$(textarea).attr('disabled', false).removeClass("disabled").focus();
				reloadCode();
			});
		}, 300);
	});
}

function getCookie(name) {
	var name = name + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') {
		    c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
		    return c.substring(name.length,c.length);
		}
	}
	return "";
}