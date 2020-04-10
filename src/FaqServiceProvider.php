<?php

namespace OpenHaus\LaravelEasyFaq;

use Illuminate\Support\ServiceProvider;

class FaqServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../views', 'laravel-easy-faq');
        $this->loadTranslationsFrom(__DIR__ . '/../lang/de', 'laravel-easy-faq');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-easy-faq.php' => config_path('laravel-easy-faq.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/../lang' => base_path('resources/lang/vendor/laravel-easy-faq'),
        ], 'translation');

        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/laravel-easy-faq'),
            __DIR__ . '/resources/js/components' => base_path('resources/js/components/vendor/laravel-easy-faq'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/app/Nova' => base_path('app/Nova'),
        ], 'nova');

        $this->publishes([
            __DIR__.'/../database/migrations/create_faqs_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_faqs_table.php'),
            __DIR__.'/../database/migrations/create_faq_categories_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_faq_categories_table.php'),
        ], 'migrations');
    }
}
