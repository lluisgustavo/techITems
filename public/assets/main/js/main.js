/*scroll to top*/

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

		
			// Navbar shrink function
			var navbarShrink = function () {
				const navbarCollapsible = document.body.querySelector('#mainNav');
				if (!navbarCollapsible) {
					return;
				}
				if (window.scrollY === 0) {
					navbarCollapsible.classList.remove('navbar-shrink')
				} else {
					navbarCollapsible.classList.add('navbar-shrink')
				}

			};

			// Shrink the navbar 
			navbarShrink();

			// Shrink the navbar when page is scrolled
			document.addEventListener('scroll', navbarShrink);

			// Activate Bootstrap scrollspy on the main nav element
			const mainNav = document.body.querySelector('#mainNav');
			if (mainNav) {
				new bootstrap.ScrollSpy(document.body, {
					target: '#mainNav',
					offset: 74,
				});
			};

			// Collapse responsive navbar when toggler is visible
			const navbarToggler = document.body.querySelector('.navbar-toggler');
			const responsiveNavItems = [].slice.call(
				document.querySelectorAll('#navbarResponsive .nav-link')
			);
			responsiveNavItems.map(function (responsiveNavItem) {
				responsiveNavItem.addEventListener('click', () => {
					if (window.getComputedStyle(navbarToggler).display !== 'none') {
						navbarToggler.click();
					}
				});
			});
	});
});
