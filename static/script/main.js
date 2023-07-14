function showPopup(element) {
    let main_element	= $('.popup');
    let product_element = $(element);

    main_element.find('[name=product-id]').val(product_element.parents('.card').data('id'));
    main_element.find('[name=product-name]').val(product_element.parents('.card').data('name'));
    main_element.find('[name=product-price]').val(product_element.parents('.card').data('price'));
    main_element.find('[name=product-quantity]').val(product_element.parents('.card').data('quantity'));
    main_element.find('[name=summa]').val(product_element.parents('.card').data('summa'));

}


function sendOrder() {
   
    let url = '/ajax-order.php',
        data = {      
            'fio': $('[name=fio]').val(),
            'phone': $('[name=phone]').val(),
            'email': $('[name=email]').val(),
            'comment': $('[name=comment]').val(),
            'summa': $('[name=summa]').val(),
            'id': $('[name=product-id]').val(),
            'name': $('[name=product-name]').val(),
            'price': $('[name=product-price]').val(),
            'quantity': $('[name=product-quantity]').val(),
        };

    
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            console.log(response.res);
            let errorsBlock = $('.errors');

            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res[0]){
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
function sendComment() {
   
    let url = '/ajax-comments.php',
        data = {      
            'product_id': $('[name=product-id]').val(),
            'login': $('[name=login]').val(),
            'body_comment': $('[name=comment_product]').val(),
        };

    
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            console.log(response.res);
            let errorsBlock = $('.errors');

            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res){
                    $( ".product-comment").load(window.location.href +" .product-comment");
                    $(".form-control").val("");
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
function login() {
   
    let url = '/ajax-login.php',
        data = {      
            'login': $('[name=login]').val(),
            'password': $('[name=password]').val(),
        }

    
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            console.log(response.res);
            let errorsBlock = $('.errors');

            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res){
                    errorsBlock.html('Вы авторизованы!');
                    setTimeout(() => {
                        location.href = "index.php";
                    }, 1000);
                }
            }
        }
   });
   
}
function registration() {
   
    let url = '/ajax-registration.php',
        data = {
            'fio': $('[name=fio]').val(),
            'phone': $('[name=phone]').val(),
            'email': $('[name=email]').val(),     
            'login': $('[name=login]').val(),
            'password': $('[name=password]').val(),
        }

    
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: 'json',
        success: (response) =>{
            console.log(response.res);
            let errorsBlock = $('.errors');

            if (response.errors){
                

                errorsBlock.html('');

                for (let key in response.errors){
                    errorsBlock.append(response.errors[key] + '<br>');
                }
            }else{
                if(response.res){
                    errorsBlock.html('Вы зарегестрированы!');
                    setTimeout(() => {
                        location.href = "login.php";
                    }, 1000);
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
    
    // $("#addCart"+id).prop('disabled', true);    
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        dataType: 'json',
        // success: () =>{
        //     $("#addCart"+id).prop('disabled', false);      
        // }
   });
    $( ".orders" ).load(window.location.href + " .orders" );
    $( "#cartCntItems" ).load(window.location.href + " #cartCntItems" );
    $( "#count"+id ).load(window.location.href + " #count"+id );
   
   
}
function delToCart(id) {
    
    let url = 'cart.php',
    data = {
        'deltocart': id,
    };

    // $("#delCart"+id).prop('disabled', true);      
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        dataType: 'json',
        // success: () =>{
        //     $("#delCart"+id).prop('disabled', false);    
        // }
    });
    $( ".orders" ).load(window.location.href + " .orders" );
    $( "#cartCntItems" ).load(window.location.href + " #cartCntItems" );
    $( "#count"+id ).load(window.location.href + " #count"+id );
}

$(document)
    .on('click','.js_send', function (){
        sendOrder();
    })
    .on('click','.add-comment', function (){
        sendComment();
    })
    .on('click','.login', function (){
        login();
    })
    .on('click','.registration', function (){
        registration();
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
        $( ".orders" ).load(window.location.href + " .orders" );
        showPopup(this);
        $('.popup-wrapper').removeClass('hidden');
    })
    .on('click','.close', function (){
        $('.popup-wrapper').addClass('hidden');
    })


$(document).ready(function(){
    $('.slider').slick({
        adaptiveHeight:true
    });
    $('.slick-arrow').addClass('btn btn-success')
})



