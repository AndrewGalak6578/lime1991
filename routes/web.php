<?php

use Illuminate\Support\Facades\Route;

// Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::group(['as' => 'front.'], function(){

    //Главная страница
    Route::get('/', [\App\Http\Controllers\Front\FrontController::class, 'index'])->name('index');

	// Динамичные страницы
	Route::as('content.')->group(function(){
		Route::get('contacts', [\App\Http\Controllers\Front\ContentContactsController::class, 'index'])->name('contacts');
		Route::get('payment', [\App\Http\Controllers\Front\ContentPaymentController::class, 'index'])->name('payment');
		Route::get('refund', [\App\Http\Controllers\Front\ContentRefundController::class, 'index'])->name('refund');
		Route::get('delivery', [\App\Http\Controllers\Front\ContentDeliveryController::class, 'index'])->name('delivery');
	});

	Route::get('/blog', [\App\Http\Controllers\Front\BlogController::class, 'blog'])->name('blog');
	Route::get('/blog/{article}', [\App\Http\Controllers\Front\BlogController::class, 'article'])->name('blog.article');

    //Поиск
    Route::get('/search', [\App\Http\Controllers\Front\SearchController::class, 'searchPage'])->name('search');

    //Корзина
    Route::get('/cart', [\App\Http\Controllers\Front\CartController::class, 'index'])->name('cart.index');
    Route::post('/addToCart', [\App\Http\Controllers\Front\CartController::class, 'store'])->name('cart.store');
    Route::post('/updateCart/{cart}', [\App\Http\Controllers\Front\CartController::class, 'update'])->name('cart.update');
    Route::post('/removeFromCart/{cart}', [\App\Http\Controllers\Front\CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/removeAllFromCart', [\App\Http\Controllers\Front\CartController::class, 'removeAllFromCart'])->name('cart.remove-all-from-cart');

    //Оформление заказа
    Route::get('/checkout', [\App\Http\Controllers\Front\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/orders/store', [\App\Http\Controllers\Front\OrderController::class, 'store'])->name('orders.store');
    Route::post('/checkEmail', [\App\Http\Controllers\Front\ProfileController::class, 'checkEmail'])->name('checkEmail');

    //Обратный звонок
    Route::post('/call-me', [\App\Http\Controllers\Front\CallmeController::class, 'store'])->name('callme.store');
    //Профиль
    Route::group(['middleware' => 'auth'], function(){

        #профиль
        Route::get('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'update'])->name('profile.update');

        #мои заказы
        Route::get('/profile/orders', [\App\Http\Controllers\Front\ProfileController::class, 'orders'])->name('profile.orders');
        Route::get('/profile/orders/{order}', [\App\Http\Controllers\Front\OrderController::class, 'show'])->name('profile.orders.show');

        #избранное
        Route::get('/profile/favorites', [\App\Http\Controllers\Front\ProfileController::class, 'favorites'])->name('profile.favorites');
        Route::post('/addToFavorite', [\App\Http\Controllers\Front\FavoriteController::class, 'interaction'])->name('user.products.favorites.store');
        Route::post('/removeFromFavorite/{product_id}', [\App\Http\Controllers\Front\FavoriteController::class, 'destroy'])->name('user.products.favorites.destroy');

        #настройки
        Route::get('/profile/settings', [\App\Http\Controllers\Front\ProfileController::class, 'settings'])->name('profile.settings');
        Route::post('/profile/settings', [\App\Http\Controllers\Front\ProfileController::class, 'updateSettings'])->name('profile.settings.update');
        Route::resource('userAddresses', \App\Http\Controllers\Front\UserAddressController::class);

        #Оставить и удалить отзыв
        Route::post('/reviews/store', [\App\Http\Controllers\Front\ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/reviews/destroy', [\App\Http\Controllers\Front\ReviewController::class, 'destroy'])->name('reviews.destroy');

    });

		Route::get('/brands', [\App\Http\Controllers\Front\BrandController::class, 'brands'])->name('brands.show');
		Route::get('/brand/{brand}', [\App\Http\Controllers\Front\BrandController::class, 'show'])->name('brand.show');
    Route::get('/product/{product}', [\App\Http\Controllers\Front\ProductController::class, 'show'])->name('products.show');
    Route::get('/catalog', [\App\Http\Controllers\Front\CatalogController::class, 'show'])->name('categories.show');
    #Активация купона
    Route::post('/coupon', [\App\Http\Controllers\Front\CouponController::class, 'store'])->name('coupon.store');
    #Акции
    Route::get('promotion/{promotion}',[\App\Http\Controllers\Front\PromotionController::class, 'show'])->name('promotion.show');
});

// Auth::routes();
Route::get('/signin', [App\Http\Controllers\Auth\SignInController::class, 'index'])->name('signin');
Route::post('/signin', [App\Http\Controllers\Auth\SignInController::class, 'index'])->name('signin');
Route::post('/logout', [App\Http\Controllers\Auth\SignInController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/search-form', [\App\Http\Controllers\Front\SearchController::class, 'search']);


Route::get('/{slug}', [\App\Http\Controllers\Front\PageController::class, 'show'])->name('front.page.show');
