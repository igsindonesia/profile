<?php

namespace App\Providers;

use App\Services\SEOMeta;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SEOMeta::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        View::composer('app', function ($view) {
            $seoMeta = app(SEOMeta::class);
            $tags = $seoMeta->getTags();

            if (! empty($tags)) {
                $view->with('seo', $tags);
            }
        });
    }
}
