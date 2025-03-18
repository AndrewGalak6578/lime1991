</main>
<footer class="main">
    <section class="section-padding footer-mid pt-0">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp"
                         data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="{{route('front.index')}}" class="mb-15"><img src="/front_assets/logo/logo.png" alt="logo" /></a>
                            <p class="font-lg text-heading">Сантехника в Краснодаре</p>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="/front_assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Адрес:
                                </strong> <span>{!! getValue('full_address') !!}</span></li>
                            <li><img src="/front_assets/imgs/theme/icons/icon-contact.svg"
                                     alt="" /><strong>Тел:</strong><a href="tel:{!! getSecondValue('phone') !!}" class="number-footer">{!! getValue('phone') !!}</a></li>
                            <li><img src="/front_assets/imgs/theme/icons/icon-email-2.svg"
                                     alt="" /><strong>Email:</strong><a href="mailto:{!! getValue('email') !!}" class="number-footer">{!! getValue('email') !!}</a></li>
                            <li><img src="/front_assets/imgs/theme/icons/icon-clock.svg"
                                     alt="" />Время работы: {!! getValue('work_time') !!}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class="widget-title">Информация</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @foreach($footer_1 as $menu)
                            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Аккаунт</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @foreach($footer_2 as $menu)
                            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="widget-title">Каталог</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @foreach($footer_3 as $menu)
                            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-link-widget widget-install-app col wow animate__animated animate__fadeInUp"
                     data-wow-delay=".5s">
                    <h4 class="widget-title">Оплата</h4>
                    <p class="">Принимаем к оплате карты любых российских банков</p>
                    <img class="" src="/front_assets/imgs/theme/payment-services.jpg" alt="" />
                </div>
            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="footer-bottom">
                    <p class="font-sm mb-15 mt-15">© 2023, <strong class="text-brand">{!! getValue('copyright_text') !!}
                        </strong></p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- Preloader Start -->
<!-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="/front_assets/imgs/theme/loading.gif" alt="" />
            </div>
        </div>
    </div>
</div> -->
<!-- Vendor JS-->
<script src="/front_assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="/front_assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="/front_assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="/front_assets/js/plugins/slider-range.js"></script>
<script src="/front_assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="/front_assets/js/plugins/slick.js"></script>

<script src="/front_assets/libs/fontawesome-free-6.3.0-web/js/all.min.js"></script>
<script src="/front_assets/js/plugins/jquery.syotimer.min.js"></script>
<script src="/front_assets/js/plugins/waypoints.js"></script>
<script src="/front_assets/js/plugins/wow.js"></script>
<script src="/front_assets/js/plugins/perfect-scrollbar.js"></script>
<script src="/front_assets/js/plugins/magnific-popup.js"></script>
<script src="/front_assets/js/plugins/select2.min.js"></script>
<script src="/front_assets/js/plugins/counterup.js"></script>
<script src="/front_assets/js/plugins/jquery.countdown.min.js"></script>
<script src="/front_assets/js/plugins/images-loaded.js"></script>
<script src="/front_assets/js/plugins/isotope.js"></script>
<script src="/front_assets/js/plugins/scrollup.js"></script>
<script src="/front_assets/js/plugins/jquery.vticker-min.js"></script>
<script src="/front_assets/js/plugins/jquery.theia.sticky.js"></script>
<script src="/front_assets/js/plugins/simple-lightbox.min.js"></script>
<script src="/front_assets/js/plugins/inputmask.min.js"></script>

<!-- Template  JS -->
<script src="/front_assets/js/main.js?v=5.6"></script>
<script src="/front_assets/js/shop.js?v=5.6"></script>
<script src="/front_assets/js/plugins/sweetalert11.4.8.min.js"></script>
<script src="/front_assets/js/custom.js"></script>
<script src="/front_assets/js/map.js"></script>

<script>

    $(document).on('click',':not(.search_input)',function(){
        $('.search-results').removeClass('with-results');
        $('.search-results').empty();
        $('.search-results').val('');
    });

    $('.search_input').on('keyup', function(){
        // let category_id = $('.search_select').val();
        let input = $(this).val();
        if($(this).val() == ''){
            $('.search-results').removeClass('with-results');
            $('.search-results').empty();
            $('.search-results').val('');
        }else if(input.length > 2){
            $.ajax({
                type: "POST",
                url: '/search-form',
                data: {
                    c: $('#header-search *[name=c]').val(),
                    q: $('#header-search *[name=q]').val()
                },
                success: function(data) {
                    if(data != null){
                        $('.search-results').addClass('with-results');
                        $('.search-results').empty();
                        $('.search-results').html(data);
                    }else{
                        $('.search-results').html('<div>Ничего не найдено!</div>');
                    }

                },
                error: function(data) {
                    $('.search-results').removeClass('with-results');
                    $('.search-results').empty();
                    $('.search-results').val('');
                }
            });
        }

    });

//      var myCollapsible = document.getElementById('accordionExample')
//     myCollapsible.addEventListener('hide.bs.collapse', function () {
//         $('#btn-more-brands').html('Показать больше');
//     });
//
//     myCollapsible.addEventListener('show.bs.collapse', function () {
//         $('#btn-more-brands').html('Показать меньше');
//     });

</script>
@vite(['resources/js/app.js'])
@yield('footer')
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(94556885, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
    });
</script>




<noscript><div><img src="https://mc.yandex.ru/watch/94556885" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>

</html>
