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
	//Supplier
	//Máscara CNPJ
	$("#fornecedor-CNPJ").mask("99.999.999/9999-99");
	$("#editar-fornecedor-CNPJ").mask("99.999.999/9999-99");
	//Email
	$("#fornecedor-email").mask("A", {
		translation: {
			"A": { pattern: /[\w@\-.+]/, recursive: true }
		}
	});;
	//Email
	$("#editar-fornecedor-email").mask("A", {
		translation: {
			"A": { pattern: /[\w@\-.+]/, recursive: true }
		}
	});;
	//Telefone
	$('#fornecedor-telefone').mask("(99) 99999-9999")
	.focusout(function (event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-9999");
		} else {
			element.mask("(99) 9999-99999");
		}
	});

	$('#editar-fornecedor-telefone').mask("(99) 99999-9999")
	.focusout(function (event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-9999");
		} else {
			element.mask("(99) 9999-99999");
		}
	});
	//CEP
	$('#fornecedor-endereco-CEP').mask("99.999-999");
	$('#editar-fornecedor-endereco-CEP').mask("99.999-999");

	//Validation Config/Register
	//CPF
	$('#cpf-config').mask('000.000.000-00', {reverse: true});
	$('#register-cpf').mask('000.000.000-00', {reverse: true});

	//Tel
	$('#tel-config').mask("(99) 99999-9999")
	.focusout(function (event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-9999");
		} else {
			element.mask("(99) 9999-99999");
		}
	});

	$('#register-tel').mask("(99) 99999-9999")
	.focusout(function (event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-9999");
		} else {
			element.mask("(99) 9999-99999");
		}
	});

	//CEP
	$('#register-CEP').mask("99.999-999");

	//Email
	$("#register-email").mask("A", {
		translation: {
			"A": { pattern: /[\w@\-.+]/, recursive: true }
		}
	});;

	$(function () { 
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
		
 
		$('.list').click(function(){
			const value = $(this).attr('data-filter'); 
			if(value == 'todas'){
				$('.card').show('1000');
			} else {
				$('.card').not('.' + value).hide('1000');  
				$('.card').filter('.' + value).show('1000');  
			}
		})

		$('.list').click(function(){
			$(this).addClass('active').siblings().removeClass('active');
		}) 
	}); 
});
