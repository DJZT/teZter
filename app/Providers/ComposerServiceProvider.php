<?php namespace App\Providers;

use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Using class based composers...
		View::composer('admin.header', function($view){
			$view->with('CurrentUser', Auth::user());
		});

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
