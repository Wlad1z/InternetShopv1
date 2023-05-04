function showPopup(element) {
    let main_element	= $('.popup');
    let product_element = $(element);

    main_element.find('[name=product-id]').val(product_element.parents('.card').data('id'));
    main_element.find('[name=product-name]').val(product_element.parents('.card').data('name'));
    main_element.find('[name=product-price]').val(product_element.parents('.card').data('price'));


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
                    }, 1500);
                }
            }
        }
   });
   
}

$(document)
    .on('click','.js_send', function (){
        sendOrder();
    })
    .on('click', '.order', function () {
        showPopup(this);
        $('.popup-wrapper').removeClass('hidden');
    })
    .on('click','.close', function (){
        $('.popup-wrapper').addClass('hidden');
    })



