<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // mariadb support
        Schema::defaultStringLength(191);

        // Forçar https em produção
        if (env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }

        //Categoria::observe(CategoriaObserver::class);
        //Corpus::observe(CorpusObserver::class);
        //Text::observe(TextObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
