<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductCategory;
use Eliaskorolev\Menu\Facades\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        \Schema::defaultStringLength(191);


        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        if (! $this->app->runningInConsole()) {
            \View::share('product_categories', ProductCategory::select(['id', 'name', 'slug', 'icon', 'parent_id'])->where('parent_id', 0)->get());

            \View::composer('front.layouts.header', function($view) {
                $view->with([
                    'mainMenus' => Menu::getByName('main-menu'),
                    'topMenus' => Menu::getByName('top-menu'),
                    'mobileMainMenus' => Menu::getByName('mobile-main-menu')
                ]);
            });

            \View::composer('front.layouts.footer', function($view) {
                $view->with([
                    'footer_1' => Menu::getByName('footer_1'),
                    'footer_2' => Menu::getByName('footer_2'),
                    'footer_3' => Menu::getByName('footer_3'),
                ]);
            });
        }
    }
}
