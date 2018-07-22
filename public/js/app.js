/**
 * @file
 * 
 * This file will handle ajax requests, dom events, etc.
 */

document.addEventListener('DOMContentLoaded', function() {
    //Initialize all the components of materialize css
    M.AutoInit();
    var dropdowns = document.querySelectorAll('.user-dropdown');
    M.Dropdown.init(dropdowns, {
        constrainWidth:false
    });
});

// Get CSRF-TOKEN
const _token = $('meta[name=csrf-token]').attr('content');

$(document).ready(function(){

    $('body').delegate('.add-cart','click',function(e){
        // get the attribute value of element with #add-cart id.
        let id = $(this).attr('data-id');

        // get the text (value) of selected quantity
        let qty = $('#qty :selected').text();
        if(!qty){
            qty = 1 ;
        }
        const data = {
            _token: _token,
            _id: id,
            _qty: qty
        };

        //prevent form submission
        e.preventDefault();

        //Make ajax request to a specific url
        makeAJAXRequest(
            '/cart/add',
            'POST',
            data,
            function(res){
                addCart(res)
            }
        )
    })

    $('body').delegate('.update-cart', 'click',function(e){
        e.preventDefault();
        // "this" means the current object, in our case
        // it's #update-cart.
        const id = $(this).attr('data-id');
        const qty = $('#qty-'+id+' :selected').text();
        const rowId = $('#rowId-'+id).val();
        const data = {
                _token: _token,
                _rowId: rowId,
                _qty: qty
            };
        
            makeAJAXRequest(
            '/cart/update',
            'POST',
            data,
            function(res){
                updateCart(res,id)
            }
        );
    });

    // Handle add product to wishlist request
    $('body').delegate('.add-wishlist','click',function(e){
        e.preventDefault();
        const id = $(this).attr('data-id');
        const data = {
                _token: _token,
                _id: id
            };
        
            makeAJAXRequest(
            '/wishlist/add',
            'POST',
            data,
            function(res){
                makeToast(res.msg);
            }
        );
    })
});

/**
 * Make ajax request
 * 
 * @param {*} url 
 * @param {*} method 
 * @param {*} data 
 * @param {*} success 
 */
function makeAJAXRequest(url,method,data,success){
    $.ajax({
        method: method,
        dataType: 'json',
        url: url,
        data: data,
        success: success
    });
}

/**
 * callback function for successful
 * ajax request for updating cart item. 
 * 
 * @param {*} data 
 * @param {*} id 
 */
function updateCart(data,id){
    //update the cart-subtotal
    $('.cart-subtotal').text('$'+data.subtotal+' /-');

    //update the cart-tax
    $('.cart-tax').text('$'+data.tax+' /-');

    //update the cart-total
    $('.cart-total').text('$'+data.total+' /-');

    // if an item was deleted from cart
    if(data.type === 'delete'){
        /** 
         * add a css classes before remove the item.
         * so it has a nice animation to it.
         */
        $('tr[data-id='+id+']').addClass('animated zoomOut');
        setTimeout(function(){
            $('tr[data-id='+id+']').on('transitionend',function(e){
                $(this).remove();
            });
            if(data.cart_count === 0){
                $('.checkout-btn').addClass('disabled');
                $('.cart-items')
                .remove();
                
                $('.cart-panel')
                .html(`<h5 class="animated fadeIn grey-text text-darken-2 center">Your cart is empty! <a href="/products"> Start Shopping</a></h5>`);
            }else{
                
            }
        },300);
    }
    makeToast(data.msg);
    $('.cart-count').text('('+data.cart_count+')');
}


/**
 * callback function for successful
 * ajax request for adding cart item.
 * 
 * @param {*} data 
 */
function addCart(data){
    if(data.success == true){
        makeToast(data.msg+' <a href="/cart" class="btn-flat blue-text"> Cart</a>');
        $('.cart-count').text('('+data.cart_count+')');
    }
}

/**
 * Make a toast message
 * 
 * @param {*} msg 
 */
function makeToast(msg){
    M.toast({
        html: `<span>`+msg+`</span><button class='btn-flat toast-action' onclick='dismissToast()'><i class='material-icons yellow-text'>close</i></button>`,
        inDuration:500,
        outDuration:1000
    });
}

/**
 *  Dismiss the Toast on click
 */
function dismissToast(){
    let toastElement = document.querySelector('.toast');
    let toastInstance = M.Toast.getInstance(toastElement);
    toastInstance.dismiss();
}