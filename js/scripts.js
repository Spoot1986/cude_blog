jQuery(document).ready(function($) {

	$('.menu-toggle').sidr({side: 'right'});

	$(window).scroll(function() {
		if($(this).scrollTop() != 0) { 
			$('.cude_blog_to_top').fadeIn();
		} else {
			$('.cude_blog_to_top').fadeOut();
		}
	});

	$('.cude_blog_to_top').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});

});	