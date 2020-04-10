<?php

namespace OpenHaus\LaravelEasyFaq;

use Illuminate\Support\Facades\Route;
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
        $this->registerRoutes();

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
            __DIR__ . '/Nova' => base_path('app/Nova'),
        ], 'nova');

        $this->publishes([
            __DIR__.'/../stubs/migrations/create_table_faqs_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_table_faqs_table.php'),
            __DIR__.'/../stubs/migrations/create_table_faq_categories_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_table_faq_categories_table.php'),
            __DIR__.'/../stubs/migrations/create_table_nova_trix_attachments.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_table_nova_trix_attachments.php'),
            __DIR__.'/../stubs/migrations/create_table_nova_pending_trix_attachments.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_table_nova_pending_trix_attachments.php'),
        ], 'migrations');
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'OpenHaus\LaravelEasyFaq\Http\Controllers',
        ];
    }
}
