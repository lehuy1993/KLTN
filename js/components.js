/**
 Core layout handlers and component wrappers
 **/

// BEGIN: Layout Brand
var LayoutHeaderCart = function () {

	return {
		//main function to initiate the module
		init: function () {
			var cart = $('#cart-info-parent');

			if (cart.size() === 0) {
				return;
			}

			
		}
	};
}();
// END


var LayoutCartMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$(document).on('mouseenter', '#cart-info-parent', function (e) {
				e.preventDefault();


			});

			$('#cart-info-parent').on('mouseleave', function (e) {
				e.preventDefault();

			});

		
		}
	};
}();
// END



var AjaxModal = function () {
	return {
		init: function () {
			$(".close-modal, .overlay").click(function() {
				clearTimeout(timeout);
				$(".ajax-success-modal").fadeOut(300);
				enableScroll();
				
			});	
		}
	};
}();



// Main theme initialization
$(document).ready(function () {
	// init layout handlers
	LayoutHeaderCart.init();
	LayoutCartMenu.init();
	
	AjaxModal.init();

	
});