<?php

namespace Roshangara\Webservice;

use Illuminate\Contracts\Events\Dispatcher;

class WebserviceServiceProvider extends \Illuminate\Support\ServiceProvider
{
    use EventMap;

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->registerEvents();
        $this->registerMigrations();
    }

    public function register()
    {
        $this->app->bind(Webservice::class, function () {
            return new Webservice();
        });
    }

    /**
     * Register the Horizon job events.
     * @return void
     */
    protected function registerEvents()
    {
        $events = $this->app->make(Dispatcher::class);
        foreach ($this->events as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
