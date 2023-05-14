function showPopup(element) {
    let main_element	= $('.popup');
    let product_element = $(element);

    main_element.find('[name=product-id]').val(product_element.parents('.card').data('id'));
    main_element.find('[name=product-name]').val(product_element.parents('.card').data('name'));
    main_element.find('[name=product-price]').val(product_element.parents('.card').data('price'));
    main_element.find('[name=product-quantity]').val(product_element.parents('.card').data('quantity'));

}

function sendOrder() {
   
    let url = '/ajax.php',
        data = {
            'id': $('[name=product-id]').val(),
            'name': $('[name=product-name]').val(),
            'price': $('[name=product-price]').val(),
            'fio': $('[name=fio]').val(),
            'phone': $('[name=phone]').val(),
            'email': $('[name=email]').val(),
            'comment': $('[name=comment]').val(),
            'quantity': $('[name=product-quantity]').val(),
        };

   
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{

            let errorsBlock = $('.errors');

            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res == true){
                    errorsBlock.html('Заказ оформлен!');
                    setTimeout(() => {
                        $('.popup-wrapper').addClass('hidden');
                        location.href = "index.php?clear_cart=true";
                    }, 1500);
                }
            }
        }
   });
   
}
function addProduct() {
    
    let url = '/ajax-product.php',
        data = {
            'category_id': $('[name=category_id]').val(),
            'name_product': $('[name=name_product]').val(),
            'price_product': $('[name=price_product]').val(),
            'small_description': $('[name=small_description]').val(),
            'big_description': $('[name=big_description]').val(),
            
        };

        
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            
            let errorsBlock = $('.errors');
            
            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res == true){
                    errorsBlock.html('Товар добавлен!');
                    
                }
            }
        }
   });
   
}
function addCategory() {
    
    let url = '/ajax-category.php',
        data = {
            'name_category': $('[name=name_category]').val(),
            'parent_id': 0
        };

        
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            
            let errorsBlock = $('.errors');
            
            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res == true){
                    errorsBlock.html('Категория добавлена!');
                    
                }
            }
        }
   });
   
}
function addChildrenCategory() {
    
    let url = '/ajax-category.php',
        data = {
            'name_category': $('[name=name_children_category]').val(),
            'parent_id': $('[name=parent_id]').val(),
        };

        
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            
            let errorsBlock = $('.errors');
            
            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res == true){
                    errorsBlock.html('Категория добавлена!');
                    
                }
            }
        }
   });
   
}

function addToCart(id) {
    
    let url = 'cart.php',
    data = {
        'addtocart': id,
    };

        
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        dataType: 'json',
        
   });
   $( ".orders" ).load(window.location.href + " .orders" );
   $( "#cartCntItems" ).load(window.location.href + " #cartCntItems" );

}
function delToCart(id) {
    
    let url = 'cart.php',
    data = {
        'deltocart': id,
    };

        
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        dataType: 'json',
   });
   
   $( ".orders" ).load(window.location.href + " .orders" );
   $( "#cartCntItems" ).load(window.location.href + " #cartCntItems" );

}

$(document)
    .on('click','.js_send', function (){
        sendOrder();
    })
    .on('click','#add_product', function (){
        addProduct();
    })
    .on('click','#add_category', function (){
        addCategory();
    })
    .on('click','#add_children_category', function (){
        addChildrenCategory();
    })
    .on('click','.addCart', function (){
        addToCart($(this).attr("data-id"));
    })
    .on('click','.delCart', function (){
        delToCart($(this).attr("data-id"));
    })
    .on('click', '.order', function () {
        showPopup(this);
        $('.popup-wrapper').removeClass('hidden');
    })
    .on('click','.close', function (){
        $('.popup-wrapper').addClass('hidden');
    })




