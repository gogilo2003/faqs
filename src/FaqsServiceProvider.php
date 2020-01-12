<?php

namespace Ogilo\Faqs;

use Illuminate\Support\ServiceProvider;
use Ogilo\Faqs\Console\InstallCommand;
use Ogilo\Faqs\Console\UpdateCommand;

use Artisan;
/**
*
*/
class FaqsServiceProvider extends ServiceProvider
{

	protected $commands = [
		UpdateCommand::class
	];

	function register()
	{
		// print(config('app.name').' in register()');
		$this->app->bind('faqs',function($app){
			return new Faqs;
		});

		$file = __DIR__.'/Support/helpers.php';
        if (file_exists($file)) {
            require_once($file);
        }
	}

	public function boot()
	{
		config(['admin.menu.admin-faqs'=>[
			'caption'=>'FAQs',
			'submenu'=>[
				'admin-faqs'=>'List Questions',
				'admin-faqs-add'=>'New Question',
			]
		]]);

		if ($this->app->runningInConsole()) {
			$this->commands($this->commands);
		}

		require_once(__DIR__.'/Support/helpers.php');

		$this->loadRoutesFrom(__DIR__.'/../routes/web.php');
		$this->loadRoutesFrom(__DIR__.'/../routes/api.php');
		$this->loadViewsFrom(__DIR__.'/../resources/views','faqs');
		$this->loadMigrationsFrom(__DIR__.'/../database/migrations');

		$this->publishes([
			__DIR__.'/../database/seeds' => database_path('seeds/vendor/faqs'),
		], 'faqs-database');

		$this->publishes([
			__DIR__.'/../public' => public_path('vendor/faqs')
        ],'faqs-public');

        $this->publishes([
			__DIR__.'/../config/faqs.php' => config_path(''),
		], 'faqs-config');

		$this->publishes([
			__DIR__.'/../resources/views'=>resource_path('views/vendor/faqs')
		],'faqs-views');
	}
}
