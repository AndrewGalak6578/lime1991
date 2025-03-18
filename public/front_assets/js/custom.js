$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});

function goToCart(){
    document.location.href = '/cart';
}

$('body').on('click', '.addToCart', function (){

    let product_id = $(this).attr('data-productID');
    let qty = $('.quantity-'+product_id).text();

    if(qty == ''){
        qty = 1;
    }


    $.ajax({
        type: "POST",
        url: '/addToCart',
        data: {
            'product_id': product_id,
            'quantity': qty,
        },
        success: function(data) {
            $("#cart-total-header").load(location.href + " #cart-total-header>*", "");


            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Товар добавлен в корзину!',
                showConfirmButton: false,
                timer: 1500
            });

            $('#main-qty').addClass('d-none');

            $('.main-text').addClass('d-none');
            $('.main-link').removeClass('d-none');

        },
        error: function(data) {
            // console.log(data);
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Товар не добавлен в корзину!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });




});

/* Добавить в избранное начало */
function addToFavorite(product_id)
{
    $.ajax({
        type: "POST",
        url: '/addToFavorite',
        data: {
            'product_id': product_id,
        },
        success: function(data) {
            $("#favorite-total-header").load(location.href + " #favorite-total-header>*", "");
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Товар добавлен в избранное!',
                showConfirmButton: false,
                timer: 1500
            });

        },
        error: function(data) {
            // console.log(data);
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Товар не добавлен в избранное!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}

/* Добавить в избранное конец  */

/* Удалить из избранного начало  */
function removeFromFavorite(id)
{

    Swal.fire({
        title: 'Удалить из избранного?',
        showCancelButton: true,
        confirmButtonText: 'Удалить',
        denyButtonText: `Отмена`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: '/removeFromFavorite/'+id,
                success: function(data) {
                    window.location.reload();
                },
                error: function(data) {
                }
            });
        }
    });
}
/* Удалить из избранного конец  */


$('body').on('click', '.qty-up', function(){

    let product_id = $(this).attr('data-productId');
    let val = parseInt($('.quantity-'+product_id).text());

        $('.quantity-'+product_id).html(val+1);

    if(window.location.pathname == '/cart'){
        updateCart(product_id, 1);
    }

});


$('body').on('click', '.qty-down', function(){
    let product_id = $(this).attr('data-productId');
    let val = parseInt($('.quantity-'+product_id).text());
    if(val != 1){
        $('.quantity-'+product_id).html(val-1);
    }

    if(window.location.pathname == '/cart'){
        updateCart(product_id, 2);
    }
});


function updateCart(id, type)
{
    let value = $('.quantity-'+id).text();



    $.ajax({
        type: "POST",
        url: '/updateCart/'+id,
        data: {
            quantity: value,
            type: type
        },
        success: function(data) {

            $('#cart-line-'+id).load(location.href + " #cart-line-"+id+">*", "");
            $("#cart-total-block").load(location.href + " #cart-total-block>*", "");
        },
        error: function(data) {
            console.log('error');
        }
    });
}

function removeFromCart(cart_id)
{
    Swal.fire({
        title: 'Удалить товар?',
        showCancelButton: true,
        confirmButtonText: 'Удалить',
        denyButtonText: `Отмена`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: '/removeFromCart/'+cart_id,
                success: function(data) {
                    $('#cart-line-'+cart_id).remove();
                    $("#cart-total-span").load(location.href + " #cart-total-span>*", "");
                    $("#cart-total-header").load(location.href + " #cart-total-header>*", "");
                    $("#cart-total-block").load(location.href + " #cart-total-block>*", "");
                    // $(".right-block-cart-mobile").load(location.href + " .right-block-cart-mobile>*", "");
                    // $("#cart-mini").load(location.href + " #cart-mini>*", "");
                },
                error: function(data) {
                }
            });
        }
    })
}


/* Удалить все из корзины начало  */
function removeAllFromCart()
{

    Swal.fire({
        title: 'Удалить всё из корзины?',
        showCancelButton: true,
        confirmButtonText: 'Удалить',
        denyButtonText: `Отмена`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: '/removeAllFromCart',
                success: function(data) {
                    window.location.reload();
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
    });
}
/* Удалить все из корзины конец  */


/* Проврека Email начало */
$(document).ready(function() {
    var typingTimer;
    var doneTypingInterval = 750; // Задержка выполнения кода после окончания ввода (в миллисекундах)
    var emailInput = $('#email');

    // Событие keyup
    emailInput.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(checkEmail, doneTypingInterval);
    });

    // Функция для проверки почты
    function checkEmail() {
        var email = emailInput.val();

        // Проверка, является ли введенное значение электронной почтой
        if (!isValidEmail(email)) {
            emailInput.addClass('is-invalid');
            $('#submit-button').attr('type', 'button');
            Swal.fire({
                icon: 'error',
                title: 'Извините...',
                text: 'Похоже что это не электронная почта!',
            });
        }else{
            emailInput.removeClass('is-invalid');
            $('#submit-button').attr('type', 'submit');
        }

        // // Проверка, содержит ли поле ввода только пробельные символы или пустое значение
        // if ($.trim(email) === '') {
        //     return;
        // }

        // Отправка AJAX-запроса для проверки зарегистрированной почты
        $.ajax({
            type: "POST",
            url: '/checkEmail',
            data: {
                email: email
            },
            success: function(data) {
                if (data == 'registered') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Извините...',
                        text: 'Но такая электронная почта уже есть в системе!',
                        footer: '<a href="/login">Войти?</a>'
                    });
                    emailInput.addClass('is-invalid');
                    $('#submit-button').attr('type', 'button');
                }else{
                    emailInput.removeClass('is-invalid');
                    $('#submit-button').attr('type', 'submit');
                }
            },
            error: function(data) {
            }
        });
    }

    // Функция для проверки, является ли значение электронной почтой
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
/* Проврека Email конец */


/* Отправка формы обратного звонка начало */
$('#footer-call-me').on('click', function(){
    let phone  = $('#footer-your-phone').val();
    let page_name  = $('#footer-from-where').val();
    let page_url  = $('#footer-from-where-url').val();
    if(phone != null){
        $.ajax({
            type: "POST",
            url: '/call-me',
            data: {
                phone: phone,
                page_name: page_name,
                page_url: page_url
            },
            success: function(data) {
                if (data == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ваша заявка принята',
                        text: 'Скоро с вами свяжется наш менеджер!',
                    });
                    $('#footer-your-phone').val("");
                }
            },
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Что-то пошло не так'
                });
            }
        });
    }
});
/* Отправка формы обратного звонка конец */
