<?php namespace Bradleyboy\Laravel;

use Illuminate\Support\ServiceProvider;

use Braintree_Configuration;

class BraintreeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('bradleyboy/laravel-braintree');

		Braintree_Configuration::environment(
			$this->app['config']->get('laravel-braintree::braintree.environment')
		);
		
		Braintree_Configuration::merchantId(
			$this->app['config']->get('laravel-braintree::braintree.merchantId')
		);

		Braintree_Configuration::publicKey(
			$this->app['config']->get('laravel-braintree::braintree.publicKey')
		);

		Braintree_Configuration::privateKey(
			$this->app['config']->get('laravel-braintree::braintree.privateKey')
		);

		$encryptionKey = $this->app['config']->get('laravel-braintree::braintree.clientSideEncryptionKey');

		// Register blade compiler for the Stripe publishable key.
		$blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();
		$blade->extend(function($value, $compiler) use($encryptionKey)
		{
			$matcher = "/(?<!\w)(\s*)@braintreeClientSideEncryptionKey/";

			return preg_replace($matcher, $encryptionKey, $value);
		});
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
		return array();
	}

}
