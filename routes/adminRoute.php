<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductTagController;
use App\Http\Controllers\Admin\KeyGroupController;
use App\Http\Controllers\Admin\KeyController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BrandCollectionController;
use App\Http\Controllers\Admin\CharController;
use App\Http\Controllers\Admin\CharValueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CharGroupController;
use App\Http\Controllers\Admin\CallmeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\HomeSlideController;
use App\Http\Controllers\Admin\HomeCatalogController;
use App\Http\Controllers\Admin\PageKeyValueController;
// use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\BlogController;

use App\Http\Controllers\Admin\ContentContactsController;
use App\Http\Controllers\Admin\ContentPaymentController;
use App\Http\Controllers\Admin\ContentDeliveryController;
use App\Http\Controllers\Admin\ContentRefundController;

use App\Http\Controllers\Admin\UploadImageController;

// use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Admin web routes
|--------------------------------------------------------------------------
*/

/*-- Авторизованный администратор, но без приставки as. вначале имени путей  --*/
Route::prefix('admin')->middleware('auth:admin')->group(function() {

    /*-- Файл-менеджер --*/
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });


});

Route::prefix('admin')->as('admin.')->group(function(){

    /*-- Авторизация --*/
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');


    Route::middleware('auth:admin')->group(function(){

        /* Технические */
			Route::post('/media/destroy/{id}', [\App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('media.destroy');
			Route::post('/upload/image', [UploadImageController::class, 'upload']);

        /*-- Админ-панель --*/
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        /*-- Заявки на обратный звонок --*/
        Route::resource('callmes', CallmeController::class);

        /*-- Отзывы --*/
        Route::resource('reviews', ReviewController::class);


        /*-- Заказы --*/
        Route::resource('orders', OrderController::class);
        Route::post('/orders/products/add/{order}', [OrderController::class, 'add_product_to_order'])->name('orders.products.add');
        Route::post('/orders/products/remove/{order}', [OrderController::class, 'remove_product_from_order'])->name('orders.products.remove');



        /*-- Товары --*/
        Route::prefix('products')->as('products.')->group(function(){

            #Доп. блоки
            Route::resource('productBlocks', \App\Http\Controllers\Admin\ProductBlockController::class);

            #Категории
            Route::resource('productCategories', ProductCategoryController::class);

            #Теги
            Route::resource('productTags', ProductTagController::class);

            #Бренды
            Route::resource('brands', BrandController::class);
            Route::resource('brandCollections', BrandCollectionController::class);
            Route::post('brands/move', [BrandController::class, 'move'])->name('brands.move');
            #Характеристики
            Route::resource('charGroups', CharGroupController::class);
            Route::resource('chars', CharController::class);
            Route::resource('charValues', CharValueController::class);

            #Товары
            Route::resource('products', ProductController::class);
            Route::post('/products/related/attach/{product}', [ProductController::class, 'addRelatedProduct'])->name('products.related.attach-product');
            Route::post('/products/related/detach/{product}', [ProductController::class, 'removeRelatedProduct'])->name('products.related.detach-product');
            Route::post('/products/chars/{product}', [ProductController::class, 'attachChar'])->name('products.chars.attach');

            #export
            // Route::get('/export', [ExportController::class, 'index'])->name('export');
            // Route::get('/export/categories', [ExportController::class, 'categories'])->name('export.categories');
            // Route::get('/export/tags', [ExportController::class, 'tags'])->name('export.tags');
            // Route::get('/export/brands', [ExportController::class, 'brands'])->name('export.brands');
            // Route::get('/export/collections', [ExportController::class, 'collections'])->name('export.collections');
            // Route::get('/export/products', [ExportController::class, 'products'])->name('export.products');

            #import
            Route::get('/import', [ImportController::class, 'index'])->name('import');
            Route::post('/import/upload', [ImportController::class, 'upload'])->name('import.upload');
            Route::post('/import/category', [ImportController::class, 'category'])->name('import.category');
            Route::post('/import/importing', [ImportController::class, 'importing'])->name('import.importing');
            Route::get('/import/importing/chains', [ImportController::class, 'chains'])->name('import.importing.chains');
        });

        /*-- Купоны акции --*/
        Route::resource('coupons', CouponController::class);
        Route::resource('promotion', \App\Http\Controllers\Admin\PromotionController::class);

        /*-- Настройки --*/
        Route::prefix('settings')->as('settings.')->group(function(){

            #ключи и значения
            Route::get('keys-and-values', [KeyController::class, 'keyAndValues'])->name('keys.values');
            Route::resource('keyGroups', KeyGroupController::class);
            Route::resource('keys', KeyController::class);

            #меню
            Route::view('menu', 'admin.settings.menu.index')->name('menu');
        });

        /*-- Пользователи --*/
        Route::resource('users', UserController::class);
        Route::post('/users/update/address/{user}', [UserController::class, 'updateAddress'])->name('users.address.update');

        /*-- Администраторы --*/
        Route::resource('admins', AdminController::class);


        /*-- Страницы --*/
        Route::prefix('pages')->as('pages.')->group(function(){
            Route::resource('homeSlides', HomeSlideController::class);
            Route::resource('homeCatalogs', HomeCatalogController::class);
            Route::resource('pageKeyValues', PageKeyValueController::class);
        });

        Route::prefix('content')->as('content.')->group(function(){
            Route::resource('contacts', ContentContactsController::class);
            Route::resource('payment', ContentPaymentController::class);
            Route::resource('refund', ContentRefundController::class);
            Route::resource('delivery', ContentDeliveryController::class);
        });

        Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
				Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create'); // Форма для создания статьи
				Route::post('/blog', [BlogController::class, 'store'])->name('blog.store'); // Сохранение новой статьи
				Route::get('/blog/{article}/edit', [BlogController::class, 'edit'])->name('blog.edit'); // Форма для редактирования статьи
				Route::put('/blog/{article}', [BlogController::class, 'update'])->name('blog.update'); // Обновление статьи
				Route::delete('/blog/{article}', [BlogController::class, 'destroy'])->name('blog.destroy'); // Удаление статьи

        Route::resource('pages', PageController::class);
        Route::get('/home/products', [PageController::class, 'homeProducts'])->name('home.products');
        Route::post('/home/products/store', [\App\Http\Controllers\Admin\HomeProductBlockController::class, 'store'])->name('home.products.store');
        Route::post('/home/products/detach/{product}', [\App\Http\Controllers\Admin\HomeProductBlockController::class, 'detachProduct'])->name('home.products.detach');

        /*-- Парсер --*/
        Route::prefix('parser')->as('parser.')->group(function(){
					Route::get('/', [ParserController::class, 'index'])->name('parser');
					Route::get('/parsing', [ParserController::class, 'parsing'])->name('parsing');
					Route::get('/parsingProgress', [ParserController::class, 'progress'])->name('parsing.progress');
					Route::get('/selectCategories', [ParserController::class, 'selectCategories'])->name('select.categories');
					Route::get('/selectProducts', [ParserController::class, 'selectProducts'])->name('select.products');
					Route::get('/selectBrands', [ParserController::class, 'selectBrands'])->name('select.brands');
					Route::get('/cancelParser', [ParserController::class, 'cencelParser'])->name('cencel');
        });

    });

});

