<?php namespace Larapress\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class LarapressServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        require __DIR__ . '/../artisan.php';
        require __DIR__ . '/../routes.php';
        require __DIR__ . '/../filters.php';

        View::addNamespace('larapress', __DIR__ . '/../Views');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
            'Larapress\Providers\MockablyServiceProvider',
            'Larapress\Providers\PermissionServiceProvider',
            'Larapress\Providers\HelpersServiceProvider',
            'Larapress\Providers\NarratorServiceProvider',
            'Larapress\Providers\CaptchaServiceProvider'
        );
	}

}
