<?php

namespace Rpg;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        PdfProvider::class => Barryvdh\DomPDF\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $commands = [
        \Rpg\Commands\RpgDummiesCommand::class
    ];

    /**
     * @var string
     */
    protected $database = __DIR__.'/../database/';

    /**
     * @var string
     */
    protected $route = __DIR__.'/../routes/';

    /**
     * @var string
     */
    protected $config = __DIR__.'/../publishable/config.php';

    /**
     * @var string
     */
    protected $dummy = __DIR__.'/../publishable/dummy.php';

    /**
     * @var string
     */
    protected $resources = __DIR__.'/../resources/';

    /**
     * @var string
     */
    protected $graphql = __DIR__.'/../publishable/graphql/';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config, 'rpg');
        $this->mergeConfigFrom($this->dummy, 'rpg_dummy');
        $this->commands($this->commands);

        if (config('rpg.http.back-office.enabled')) {
            $this->mapWebRoutes();
        }
        $this->blade();
        $this->registerMigrations();
        $this->loadViewsFrom($this->resources.'views', 'rpg');

        $loader = AliasLoader::getInstance();
        foreach (config('rpg.aliases') as $alias => $class) {
            $loader->alias($alias, $class);
        }

        $this->app->singleton('rpg', fn () => new Rpg());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([$this->config => config_path('rpg.php')], 'rpg-config');
        $this->publishes([$this->dummy => config_path('rpg_dummy.php')], 'rpg-dummy');
        $this->publishes([$this->graphql => base_path('graphql')], 'rpg-graphql');

        // Routing Model Bindings
        foreach($this->app['rpg']->getModels() as $key => $class) {
            $this->app['router']->model(Str::lower($key), $class);
        }

        // Polymorphic morph map
        Relation::morphMap(config('rpg.morphMaps'));
    }

    public function registerMigrations()
    {
        $this->loadMigrationsFrom($this->database.'migrations');
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $this->app['router']
            ->prefix(config('rpg.http.back-office.prefix'))
            ->middleware(config('rpg.http.back-office.middleware'))
            ->namespace(config('rpg.http.namespace'))
            ->group($this->route . 'web.php');
    }

    /**
     * register blade component
     */
    protected function blade()
    {
        /**
         * @route('/') return true if is current route
         *
         * @return bool
         */
        $this->app['blade.compiler']->if('route', fn ($argument) => url()->current() === $argument);
    }
}
