<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Ecommerce\Entities\Categories\Category;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class EcommerceServiceProvider extends ServiceProvider
{

    private $categoryInterface;
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(
        CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->categoryInterface = $categoryRepositoryInterface;

        try {
            $categories = $this->categoryInterface->listFrontCategories();
            view()->share('categories', $categories);
        } catch (\Exception $e) {
            //throw $th;
        }

        // try {
        //     $categories = Category::where('is_active', 1)->orderby('name', 'ASC')->get([
        //         'id',
        //         'name',
        //         'slug',
        //         'description',
        //         'cover',
        //         'is_active',
        //     ]);
        //     view()->share('categories', $categories);
        // } catch (\Exception $e) {
        //     //throw $th;
        // }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(PayuClientServiceProvider::class);
        $this->app->bind('cart', 'Modules\Ecommerce\Entities\Shoppingcart\Cart');

        $this->app['events']->listen(Logout::class, function () {
            if ($this->app['config']->get('cart.destroy_on_logout')) {
                $this->app->make(SessionManager::class)->forget('cart');
            }
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $config = __DIR__ . '/../config/cart.php';
        $this->mergeConfigFrom($config, 'cart');

        $this->publishes([__DIR__ . '/../config/payees.php' => config_path('payees.php')], 'config');
        $this->publishes([__DIR__ . '/../config/bank-transfer.php' => config_path('bank-transfer.php')], 'config');
        $this->publishes([__DIR__ . '/../config/efecty.php' => config_path('efecty.php')], 'config');
        $this->publishes([__DIR__ . '/../config/baloto.php' => config_path('baloto.php')], 'config');
        $this->publishes([__DIR__ . '/../config/cart.php' => config_path('cart.php')], 'config');
        $this->publishes([__DIR__ . '/../config/payu.php' => config_path('payu.php')], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/ecommerce');
        $sourcePath = __DIR__ . '/../Resources/views';

        // $this->publishes([
        //     $sourcePath => $viewPath
        // ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/ecommerce';
        }, \Config::get('view.paths')), [$sourcePath]), 'ecommerce');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/ecommerce');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'ecommerce');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'ecommerce');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        } else {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
