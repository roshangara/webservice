<?php

namespace Roshangara\Webservice;

use Illuminate\Contracts\Events\Dispatcher;
use Roshangara\Parser\Parser;

class WebserviceServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * All of the event / listener mappings.
     *
     * @var array
     */
    protected $events = [
        AfterSend::class => [
            SaveInformation::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerEvents();
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }

    public function register()
    {
        $this->app->bind(Webservice::class, function () {
            return new Webservice(new Parser());
        });
    }

    /**
     * Register events.
     *
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
}
