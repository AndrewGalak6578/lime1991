<div class="row">
    <div class="personal-area__group-links">
        <div class="personal-area__link">
            <a class="personal-area__button {{ active('front.profile', 'personal-area__button-active') }}" href="{{ route('front.profile') }}">Личный кабинет</a>
        </div>
        <div class="personal-area__link">
            <a class="personal-area__button {{ active('front.userAddresses.*', 'personal-area__button-active') }}" href="{{ route('front.userAddresses.index') }}">Адреса доставки</a>
        </div>
        <div class="personal-area__link">
            <a class="personal-area__button {{ active(['front.profile.orders', 'front.profile.orders.*'], 'personal-area__button-active') }}" href="{{ route('front.profile.orders') }}">Мои заказы</a>
        </div>
        <div class="personal-area__link">
            <a class="personal-area__button {{ active('front.profile.favorites', 'personal-area__button-active') }}" href="{{ route('front.profile.favorites') }}">Избранное</a>
        </div>
        <div class="personal-area__link">
            <a class="personal-area__button {{ active('front.profile.settings', 'personal-area__button-active') }}" href="{{ route('front.profile.settings') }}">Настройки</a>
        </div>
        <div class="personal-area__link">
            <a class="personal-area__button" href="javascript:document.getElementById('logout-form').sumbit();">Выйти</a>
        </div>
    </div>
</div>
