$(document).ready(function(){
	checkSize();
	var loadProj = $('#load-proj');
	var loadProjToggle = $('#load-proj-toggle');

	$('body').hide().fadeIn();
	$(loadProj).css('right', -$(loadProj).width());

	var loadProjCounter = 1;
	$(loadProjToggle).click(function(e){
		$(loadProjToggle).prop('disabled', true);
		if (loadProjCounter % 2 != 0) {
				$(loadProjToggle).animate({bottom: $(loadProj).height()}, 'fast', function(){
				setTimeout(function(){
					$(loadProj).animate({right: '10px'}, 'fast', function(){
					$('#load-proj-toggle span').addClass('load-proj-span-close');
					$('#load-proj input[type="text"]').focus();
					$(loadProjToggle).prop('disabled', false);
				});
				}, 300);
			});
			loadProjCounter++;
		} else{
			$(loadProj).animate({right: -$(loadProj).width()}, 'fast', function(){
			$('.load-proj-span-close').removeClass('load-proj-span-close');
			$(loadProjToggle).animate({bottom: 0}, 'fast', function(){
				$('#main input:first').focus();
				$(loadProjToggle).prop('disabled', false);
			});
		});
			loadProjCounter--;
		}
	});
	$('#load-proj-btn').click(function(){
		dir = $('#load-proj input').val();
		if (dir == "") {
			alert("You can't leave this blank");
			return false;			
		}
		$.post("../scripts/load_proj.php", {dir: dir}, function(status){
			if (!status) {
				alert("Can't find your project. Please try again");
			} else{
				window.location.href = "main.php";
			}
		});
	});
	$('#load-proj input').keydown(function(event){
		if (event.keyCode == 13) {
			$('#load-proj-btn').click();
		}
	});
	$('form button').click(function(event){
		event.preventDefault();
		$('form input[type="hidden"]').prop('value', $('select').val())
		$('form').submit();
	});
});

$(window).resize(function(){
	checkSize();
});

function checkSize(){
	if ($(window).height() < 348 || $(window).width() < 827) {
		$('body').html("<h1>Your device is too small!</h1><h3>Oke isn't supported on smaller screens yet.</h3><h3>Tip: Make sure your browser is maximized.</h3><h2><a href='#' onclick='reload()'>Click here</a> to retry.</h2>");
	}
}

function reload(){
	location.reload();
};