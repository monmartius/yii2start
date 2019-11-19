/*price range*/

 $('#sl2').slider();
// console.log(id);


$('.catalog').dcAccordion({
	speed: 300
});


$('.cart-view').on('click', '[data-cart-delete-item]', function(){

	var id = $(this).data('cart-delete-item');

	alert();

	$.ajax({
		url: '/cart/delete',
		type: 'GET',
		data: {
			id: id
		},
		success: function (res) {
			// showCart('res');
			location.reload();
			// alert("asdfsadf");
			// // attachCartDeleteEvent();
			// alert("teyeyeryey");
		},
		error: function (res) {
			console.log(res.responseText);
		}
	});
});


function showCart(cart){

	$('#cart .modal-body').html(cart);

	alert();

	console.log('showCart');

	$('#cart .btn-success').on('click', function(){
		alert();
		location.replace('cart/view');
	});

	$('#cart').modal();

}


// $('#cart .modal-body').on('click', '[data-cart-delete-item]', function(){
$('#cart .modal-body').on('click', '[data-cart-delete-item]', function(){

	var id = $(this).data('cart-delete-item');

	alert();

	$.ajax({
		url: '/cart/delete',
		type: 'GET',
		data: {
			id: id
		},
		success: function (res) {
			// showCart('res');
			showCart(res);
			// alert("asdfsadf");
			// // attachCartDeleteEvent();
			// alert("teyeyeryey");
		},
		error: function (res) {
			console.log(res.responseText);
		}
	});
});




$('#cartLink').on('click', function(e){

	e.preventDefault();

	$('this').css('display', 'none');

	alert();

	$.ajax({
		url: '/cart/show',
		type: 'GET',
		success: function(res){
			showCart(res);
		},
		error: function(res){
			console.log(res.responseText);
		}
	})
});


$('.clear-cart').on('click', function(){

	$.ajax({
		url: '/cart/clear',
		type: 'GET',
		success: function (res) {
			showCart(res);
		},
		error: function (res) {
			console.log(res.responseText);
		}
	});
});


$('.btn-add-to-cart').on('click', function (e){

	e.preventDefault(e);
	form = $(this).parent('form');
	var id = form.find('.product_id').val();
	var qty = form.find('.qty').val();

	// alert(qty);

	$.ajax({
		url: '/cart/add',
		data: {
			id: id,
			qty: qty
		},
		type: 'GET',
		success: function(res){
			// t.style.backgroundColor = 'red';
			if(!res) alert("Ошибка!");

			console.log(id);
			console.log(res);
			showCart(res);
		},
		error: function(res){
			console.log(res.responseText);
		}
	});

});


$('.add-to-cart').on('click', function(e){

	e.preventDefault();
	var id = $(this).data('id');

	t = this;

	$.ajax({
		url: '/cart/add',
		data: {id: id},
		type: 'GET',
		success: function(res){
			t.style.backgroundColor = 'red';
			// if(!res) alert("Ошибка!");

			// console.log(id);
			// console.log(res);
			showCart(res);
		},
		error: function(res){
			console.log(res.responseText);
		}
	})
});



	var RGBChange = function() {

		$('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')

	};
/*scroll to top*/


$(document).ready(function(){

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

	});
});
