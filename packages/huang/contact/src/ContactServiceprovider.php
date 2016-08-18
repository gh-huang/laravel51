<?php
namespace Huang\Contact;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
class ContactServiceprovider extends ServiceProvider{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	public function boot()
	{
		$this->loadViewsFrom(realpath(__DIR__.'/../views'), 'contact');
		$this->setupRoutes($this->app->router);
		$this->publishes([
			__DIR__ . '/config/contact.php' => config_path('contact.php'),
		]);
	}

	public function setupRoutes(Router $router)
	{
		$router->group(['namespace' => 'Huang\Contact\Http\Controllers'], function ($router) {
			require __DIR__ . '/Http/route.php';
		});
	}

	public function register()
	{
		$this->registerContact();
		config([
			'config/contact.php',
		]);
	}

	private function registerContact()
	{
		$this->app->bind('contact', function ($app) {
			return new Contact($app);
		});
	}
}
