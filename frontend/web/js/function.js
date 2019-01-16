// $('a.cart-icon').click(function(event) {
// 	/* Act on the event */
// 	event.preventDefault();
// 	var href=$(this).attr('href');
// 	var name=$(this).attr('data-name');
// 	var quantity=1;

// 	$.ajax({
// 		url: href,
// 		type: 'GET',
// 		data: {},
// 		success:function(res){
// 			if(res=='ok'){
// 				$('#alert-pro-name').html('Sản phẩm <strong>'+name+'</strong> đã thêm vào giỏ hàng');
// 				$('#modal-add-cart').modal('show');
// 				$('#quantity_in_cart_small').html(parseInt($('#quantity_in_cart_small').html())+1);
// 				$('#quantity_in_cart_small').focus();
// 			}
// 			else{
// 				$('#alert-pro-name').html('Xin lỗi !!! Sản phẩm <strong>'+name+'</strong> đã hết hàng');
// 				$('#modal-add-cart').modal('show');
// 			}
// 		}
// 	});

// });


//check số lượng khi mua hàng
jQuery('#quantity').keyup(function () { 

	if(this.value >100){
        this.value = 100;
    }

    if(this.value % 1 !=0){
        this.value=Math.round(this.value);
    } 
    
    this.value = this.value.replace(/[^0-9\.]/g,'');


});


$("#btnSubmit").click(function(event){
	event.preventDefault();
	var form=$('#cart-form').serialize();
	var name=$('#cart-form').attr('data-name');
	var quantity=$('#cart-form').attr('data-quantity');
	var quantity_in_cart=($('#quantity').val()==0||$('#quantity').val()=='')?1:parseInt($('#quantity').val());
	$.ajax({
		type :"POST",
		url:$('#cart-form').attr('action'),
		data: form,
		success:function(res){
            //alert(res);
            if(res=='ok'){
                $('#alert-pro-name').html('Sản phẩm <strong>'+name+'</strong> đã thêm vào giỏ hàng');
                $('#modal-add-cart').modal('show');
                $('#quantity_in_cart_small').html(parseInt($('#quantity_in_cart_small').html())+quantity_in_cart);
            }
            else{
                $('#alert-pro-name').html('Sản phẩm <strong>'+name+'</strong> chỉ còn '+quantity+' sản phẩm');
                $('#modal-add-cart').modal('show');
            }
        }
    });
});

jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
});















