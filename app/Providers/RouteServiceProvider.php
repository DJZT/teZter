<?php namespace App\Providers;

use App\Models\Answer;
use App\Models\Assigner;
use App\Models\Group;
use App\Models\Prototype;
use App\Models\Question;
use App\Models\Role;
use App\Models\Test;
use App\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		$router->model('user', 		User::class);
		$router->model('group', 	Group::class);
		$router->model('role', 		Role::class);
		$router->model('question', 	Question::class);
		$router->model('prototype', Prototype::class);
		$router->model('test', 		Test::class);
		$router->model('answer',	Answer::class);
		$router->model('assigner',	Assigner::class);

	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
