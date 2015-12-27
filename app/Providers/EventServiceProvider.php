<?php namespace App\Providers;

use App\Models\Prototype;
use App\Models\Question;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		Question::deleting(function($Question){
			// Deleted all answers for this question
			foreach($Question->answers as $Answer){
				$Answer->delete();
			}
		});

		Question::restoring(function($Question){
			// Restored all answer for this
			foreach($Question->answers()->withTrashed()->get() as $Answer){
				$Answer->restore();
			}
		});

		Prototype::deleting(function($Prototype){
			// Deleted all questions for this
			foreach ($Prototype->questions as $Question) {
				$Question->delete();
			}
		});

		Prototype::restoring(function($Prototype){
			// Restored all question for this
			foreach ($Prototype->questions as $Question) {
				$Question->restore();
			}
		});

	}

}
