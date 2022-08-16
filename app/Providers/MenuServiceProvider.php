<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Nestable;

use App\Traits\CustomCategoryTrait;

class MenuServiceProvider extends Nestable{
	
	use CustomCategoryTrait;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
		// pre('asd');
		 $this->app->bind('nestablemenuservice', 'App\Providers\MenuServiceProvider');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
		$this->publishes([
            __DIR__.'/../config/nestable.php' => config_path('nestable.php'),
        ]);
    }
	
	
}
