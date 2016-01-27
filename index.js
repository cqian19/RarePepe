$(":file").filestyle({input: false});

$(document).ready(function(){
	$('.pepeimage').bind("contextmenu", displayRareAnim);
})

var displayRareAnim = function(e){
	img = $(e.toElement);
	var thumbnail = img.parent();
	var clickposX = e.pageX;
	var clickposY = e.pageY;
	var imgoffset = img.offset()
	var ripple_effect_wrap = $('<span class="ripple-effect-wrap"></span>');
	ripple_effect_wrap.css({
		'width' 		: img.outerWidth(),
		'height'		: img.outerHeight(),
		'z-index' 		: 100,
		'overflow' 		: 'hidden',
		'background-clip'	: 'padding-box'
	});
	ripple_effect_wrap.appendTo(thumbnail);
	//Click position relative to image
	var width = 50;
	var height = 50;
	var click_x = clickposX - imgoffset.left + width/2;
	var click_y = clickposY - imgoffset.top - height/2;
	var ripple = $('<span class="ripple"><img oncontextmenu="return false;" src="images/rare.png"></span>')
	ripple.css({
		'width': 50,
		'height': 50,
		'position': 'absolute',
		'top' : click_y - 25,
		'left': click_x + 25,
		'pointer-events': 'none'
	});
	ripple.animate({
		opacity:0,
	}, 1500, function() {
		ripple_effect_wrap.remove()
	});
	ripple_effect_wrap.append(ripple);
};

var previewImage = function(e){
	var preview = document.getElementById('preview');
	preview.width = 200;
	preview.height = 200;
	preview.src = URL.createObjectURL(e.target.files[0]);
};
