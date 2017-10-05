<?php

namespace App\Providers;

use App\Services\ElasticsearchApi;
use App\Services\ElasticsearchQuery;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if ('admin', function () {
            return auth()->user()->hasRole('Admin');
        });
        Resource::withoutWrapping();
        Cashier::useCurrency('gbp', '£');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
        $this->app->singleton('flash', function () {
            return $this->app->make('App\Libraries\FlashNotifier');
        });

        $this->app->singleton(ElasticsearchApi::class, function ($app) {
            $client = ClientBuilder::create()
                                   ->setHosts(config('services.elasticsearch.host'))
                                   ->build();

            return new ElasticsearchApi($client);
        });

        $this->app->bind(ElasticsearchQuery::class, function ($app) {
            return new ElasticsearchQuery(app(ElasticsearchApi::class));
        });
    }
}
