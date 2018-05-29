<?php

namespace ApprovedDigital\LaravelTailwindConfig;

use Illuminate\Support\ServiceProvider;

class LaravelTailwindConfigServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTailwindService();

        if ($this->app->runningInConsole()) {
            $this->registerResources();
        }
    }

    /**
     * Register currency provider.
     *
     * @return void
     */
    public function registerTailwindService()
    {
        $this->app->singleton('tailwind', function ($app) {
            return new Tailwind(
                $app->config->get('tailwind', [])
            );
        });
    }

    /**
     * Register resources.
     *
     * @return void
     */
    public function registerResources()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tailwind.php', 'tailwind'
        );

        $this->publishes([
            __DIR__ . '/../config/tailwind.php' => config_path('tailwind.php'),
        ]);
    }
}