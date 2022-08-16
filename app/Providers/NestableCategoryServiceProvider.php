<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Nestable;

use App\Traits\CustomCategoryTrait;

class NestableCategoryServiceProvider extends Nestable{
	
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
		 $this->app->bind('nestablecategoryservice', 'App\Providers\NestableCategoryServiceProvider');
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
            __DIR__.'/../config/nestablecategory.php' => config_path('nestablecategory.php'),
        ]);
    }
	
	
}
