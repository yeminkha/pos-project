<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\category;
use App\Models\mainCategory;
use App\Models\product;


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
        Paginator::useBootstrap();

        // URL::forceScheme('https');

        // Define a view composer for the layout
        View::composer('user.layout', function ($view) {
            // Fetch the menu items from the database
            $mainCategoryList = mainCategory::get();
            $categoryList = category::get();
            $arthurList = product::select('arthur')->groupBy('arthur')->get();
            $readingGuideList = product::select('reading_guide')->groupBy('reading_guide')->get();
            $books = product::select('name')->distinct()->pluck('name')->toArray();;
            // Pass the menu items to the layout view
            $view->with([
                'mainCategoryList' => $mainCategoryList,
                'categoryList' => $categoryList,
                'arthurList' => $arthurList,
                'readingGuideList' => $readingGuideList,
                'books' => $books,
            ]);
        });
    }
}
