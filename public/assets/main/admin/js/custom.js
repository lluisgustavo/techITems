function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}  

var Script = function () { 
//    sidebar dropdown menu auto scrolling

	jQuery('#sidebar .sub-menu > a').click(function () {
		var o = ($(this).offset());
		diff = 250 - o.top;
		if(diff>0)
			$("#sidebar").scrollTo("-="+Math.abs(diff),500);
		else
			$("#sidebar").scrollTo("+="+Math.abs(diff),500);
	}); 
	
//    sidebar toggle

	$(function() {
		function responsiveView() {
			var wSize = $(window).width();
			if (wSize <= 768) {
				$('#container').addClass('sidebar-close');
				$('#sidebar > ul').hide();
			}

			if (wSize > 768) {
				$('#container').removeClass('sidebar-close');
				$('#sidebar > ul').show();
			}
		}
		$(window).on('load', responsiveView);
		$(window).on('resize', responsiveView);
	});

	$('.fa-bars').click(function () {
		if ($('#sidebar > ul').is(":visible") === true) {
			$('#main-content').css({
				'margin-left': '0px'
			});
			$('#sidebar').css({
				'margin-left': '-210px'
			});
			$('#sidebar > ul').hide();
			$("#container").addClass("sidebar-closed");
		} else {
			$('#main-content').css({
				'margin-left': '210px'
			});
			$('#sidebar > ul').show();
			$('#sidebar').css({
				'margin-left': '0'
			});
			$("#container").removeClass("sidebar-closed");
		}
	});  
}();

$(document).ready(function(){
	$(function () {
		//===== Preloader
	
		window.onload = function () {
			window.setTimeout(fadeout, 500);
		}
	
		function fadeout() {
			document.querySelector('.preloader').style.opacity = '0';
			document.querySelector('.preloader').style.display = 'none';
		}
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
