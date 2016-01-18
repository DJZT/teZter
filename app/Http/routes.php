<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'namespace' => 'Admin'], function(){
	Route::group(['prefix' => 'users'], function(){
		Route::get('list', 				['as' => 'admin.users.list', 		'uses' => "UsersController@index"]);
		Route::get('create', 			['as' => 'admin.users.create', 		'uses' => "UsersController@create"]);
		Route::get('edit/{user}',		['as' => 'admin.users.edit', 		'uses' => "UsersController@edit"]);
		Route::get('delete/{user}', 	['as' => 'admin.users.delete', 		'uses' => "UsersController@destroy"]);
		Route::get('restore/{id}', 		['as' => 'admin.users.restore', 	'uses' => "UsersController@restore"]);
		Route::get('removeGroup/{user}',['as' => 'admin.groups.removeGroup','uses' => "GroupsController@removeGroup"]);

		Route::post('store', 			['as' => 'admin.users.store', 	'uses' => "UsersController@store"]);
		Route::post('update/{user}',	['as' => 'admin.users.update', 	'uses' => "UsersController@update"]);
	});

	Route::group(['prefix' => 'roles'], function(){
		Route::get('list', 				['as' => 'admin.roles.list', 	'uses' => "RolesController@index"]);
		Route::get('create', 			['as' => 'admin.roles.create', 	'uses' => "RolesController@create"]);
		Route::get('edit/{role}',		['as' => 'admin.roles.edit', 	'uses' => "RolesController@edit"]);
		Route::get('delete/{role}',		['as' => 'admin.roles.delete', 	'uses' => "RolesController@destroy"]);

		Route::post('store', 			['as' => 'admin.roles.store', 	'uses' => "RolesController@store"]);
		Route::post('update/{role}',	['as' => 'admin.roles.update', 	'uses' => "RolesController@update"]);
	});

	Route::group(['prefix' => 'groups'], function(){
		Route::get('list', 						['as' => 'admin.groups.list', 		'uses' => "GroupsController@index"]);
		Route::get('create', 					['as' => 'admin.groups.create', 	'uses' => "GroupsController@create"]);
		Route::get('edit/{group}',				['as' => 'admin.groups.edit', 		'uses' => "GroupsController@edit"]);
		Route::get('delete/{group}',			['as' => 'admin.groups.delete', 	'uses' => "GroupsController@destroy"]);

		Route::post('store', 			['as' => 'admin.groups.store', 	'uses' => "GroupsController@store"]);
		Route::post('update/{group}',	['as' => 'admin.groups.update', 'uses' => "GroupsController@update"]);
	});

	Route::group(['prefix' => 'prototypes'], function(){
		Route::get('list', 					['as' => 'admin.prototypes.list', 	'uses' => 'PrototypesController@index']);
		Route::get('create',				['as' => 'admin.prototypes.create', 'uses' => 'PrototypesController@create']);
		Route::post('store',				['as' => 'admin.prototypes.store', 	'uses' => 'PrototypesController@store']);
		Route::get('edit/{prototype}',		['as' => 'admin.prototypes.edit', 	'uses' => 'PrototypesController@edit']);
		Route::post('update/{prototype}',	['as' => 'admin.prototypes.update', 'uses' => 'PrototypesController@update']);
		Route::get('destroy/{prototype}',	['as' => 'admin.prototypes.destroy','uses' => 'PrototypesController@destroy']);
		Route::get('restore/{prototype}',	['as' => 'admin.prototypes.restore','uses' => 'PrototypesController@restore']);

		Route::get('{prototype}/question/create', 	['as' => 'admin.questions.create', 	'uses' => 'QuestionsController@create']);
		Route::post('{prototype}/question/store', 	['as' => 'admin.questions.store', 	'uses' => 'QuestionsController@store']);
	});

	Route::group(['prefix' => 'tests'], function(){
		Route::get('list', 		['as' => 'admin.tests.list', 'uses' => 'TestsController@index']);
		Route::get('{test}', 	['as' => 'admin.tests.show', 'uses' => 'TestsController@show']);
	});

	Route::group(['prefix' => 'questions'], function(){

		Route::get('edit/{question}', 				['as' => 'admin.questions.edit', 	'uses' => 'QuestionsController@edit']);
		Route::post('update/{question}', 			['as' => 'admin.questions.update', 	'uses' => 'QuestionsController@update']);
		Route::get('delete/{question}', 			['as' => 'admin.questions.delete', 	'uses' => 'QuestionsController@destroy']);
	});

	Route::group(['prefix' => 'assigners'], function(){
		Route::get('', 					['as' => 'admin.assigners.list', 'uses' => 'AssignersController@index']);
		Route::get('create', 			['as' => 'admin.assigners.users', 'uses' => 'AssignersController@create']);
		Route::get('delete/{assigner}', ['as' => 'admin.assigners.delete', 'uses' => 'AssignersController@destroy']);
		Route::post('store', 			['as' => 'admin.assigners.store', 'uses' => 'AssignersController@store']);
	});
});

Route::group(['prefix' => 'rest', 'namespace' => 'REST'], function(){
	Route::group(['prefix' => 'users'], function(){
		Route::get('', 'UsersController@index');
		Route::get('{user}', 'UsersController@show');
		Route::post('', 'UsersController@store');
		Route::put('{user}', 'UsersController@update');
		Route::delete('{user}', 'UsersController@destroy');
	});
});

Route::group(['namespace' => 'Client'], function(){
	Route::group(['prefix' => 'auth'], function(){
		Route::get('register', 	['as' => 'client.auth.register', 	'uses' => 'AuthController@registerForm']);
		Route::get('login', 	['as' => 'client.auth.login', 		'uses' => 'AuthController@loginForm']);
	});

	Route::group(['middleware' => 'auth'], function(){
		Route::get('', ['as' => 'client.cabinet', 'uses' => 'CabinetController@cabinet']);
		Route::group(['prefix' => 'cabinet'], function(){
			Route::get('test/{test}/info', 		['as' => 'client.test.info',		'uses' => 'TestController@show']);
			Route::get('assigner/{assigner}', 	['as' => 'client.assigner.show', 	'uses' => 'AssignersController@show']);
		});

		Route::group(['prefix' => 'test'], function(){
			Route::get('start/prototype/{prototype}', 	['as' => 'client.test.prototype.start', 	'uses' => 'TestController@startTestByPrototype']);
			Route::get('start/assigner/{assigner}', 	['as' => 'client.test.assigner.start', 		'uses' => 'TestController@startTestByAssigner']);

			Route::get('{test}', 						['as' => 'client.test', 					'uses' => 'TestController@test']);
			Route::post('{test}/answer/{question}', 	['as' => 'client.test.answer', 				'uses' => 'TestController@answer']);
		});
	});


});