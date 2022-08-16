<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		\Schema::defaultStringLength(191);
		$this->app->bind('chanellog', 'App\Helpers\ChannelWriter');
		if (getenv('APP_ENV') === 'production') {
			$this->app['request']->server->set('HTTPS', true);
			\URL::forceScheme('https');
		}
		\Illuminate\Support\Collection::macro('recursively_strip_tag', function () {
			return $this->map(function ($value) {
				if (is_array($value) || is_object($value)) {
					return collect($value)->recursively_strip_tag();
				}
				
				return preg_replace("#<script(.*?)>(.*?)</script>#is", '', $value);
			});
		});
    }
}
