<?php namespace Larapress\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Larapress\Commands\InstallCommand;
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
        $this->package('larapress-cms/core');

        require __DIR__ . '/../routes.php';
        require __DIR__ . '/../filters.php';

        View::addNamespace('larapress', __DIR__ . '/../Views');

        /**
         * Register dependencies
         */
        $this->app->register('Cartalyst\Sentry\SentryServiceProvider');
        AliasLoader::getInstance()->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');
        $this->app->register('Greggilbert\Recaptcha\RecaptchaServiceProvider');

        /**
         * Register larapress services
         */
        $this->app->register('Larapress\Providers\MockablyServiceProvider');
        AliasLoader::getInstance()->alias('Mockably', 'Larapress\Facades\Mockably');
        $this->app->register('Larapress\Providers\PermissionServiceProvider');
        AliasLoader::getInstance()->alias('Permission', 'Larapress\Facades\Permission');
        $this->app->register('Larapress\Providers\HelpersServiceProvider');
        AliasLoader::getInstance()->alias('Helpers', 'Larapress\Facades\Helpers');
        $this->app->register('Larapress\Providers\NarratorServiceProvider');
        AliasLoader::getInstance()->alias('Narrator', 'Larapress\Facades\Narrator');
        $this->app->register('Larapress\Providers\CaptchaServiceProvider');
        AliasLoader::getInstance()->alias('Captcha', 'Larapress\Facades\Captcha');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['larapress.commands.install.command'] = $this->app->share(function()
        {
            return new InstallCommand;
        });

        $this->commands('larapress.commands.install.command');
    }
}
