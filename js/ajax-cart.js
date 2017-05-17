var GLOBAL = {
  common : {
    init: function(){  
      $('.add-to-cart').bind( 'click', addToCart );
    }
  }
}
var UTIL = {
  fire : function(func,funcname, args){
    var namespace = GLOBAL;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] == 'function'){
      namespace[func][funcname](args);
    }
  },
  loadEvents : function(){
    var bodyId = document.body.id;

    // hit up common first.
    UTIL.fire('common');

    // do all the classes too.
    $.each(document.body.className.split(/\s+/),function(i,classnm){
      UTIL.fire(classnm);
      UTIL.fire(classnm,bodyId);
    });
  }
};
$(document).ready(UTIL.loadEvents);

function showModal(n){
 $(n).fadeIn(500);
	disableScroll();
	timeout = setTimeout(function() {
		$(n).fadeOut(300);
		enableScroll();
	}, 5000)	
};
/**
 * Ajaxy add-to-cart
 */
function addToCart(e){

  if (typeof e !== 'undefined') e.preventDefault();

  var $this = $(this);
  
  var form = $this.parents('form');

  $.ajax({
    type: 'POST',
    url: '/cart/add.js',
    async: false,
    data: form.serialize(),
    dataType: 'json',
    error: addToCartFail,
    success: addToCartSuccess,
    cache: false
  }); 
  
}
function addToCartSuccess (jqXHR, textStatus, errorThrown){

  $.ajax({
    type: 'GET',
    url: '/cart.js',
    async: false,
    cache: false,
    dataType: 'json',
    success: updateCartDesc
  });
$(".ajax-success-modal").find(".ajax-product-title").text(jqXHR['name']);
$(".ajax-success-modal").find(".ajax-product-image").attr("src", Bizweb.resizeImage(jqXHR['image'], 'large') );	
showModal(".ajax-success-modal");
	
  Bizweb.getCart(function(cart) {
    Bizweb.updateCartFromForm(cart, '#cart-info-parent .cart-content');		
  });
}

function addToCartFail(jqXHR, textStatus, errorThrown){
  var response = $.parseJSON(jqXHR.responseText);
  $(".ajax-error-message").text(response);
	showModal(".ajax-error-modal");
 
}