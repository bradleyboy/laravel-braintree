Braintree for Laravel 4
==============

### Danger, Will Robinson

This is in alpha. Still trying to work out the kinks. Pull requests and feedback welcome.

Integrates the Braintree PHP library with Laravel 4 via a ServiceProvider, config, and Blade extensions.

### Installation

I'm keeping this off packagist for now until it is more stable. This service provider uses [Matt Jansen's fork of the braintree/braintree_php repo](https://github.com/mattjanssen/braintree_php) for its improved autoloader.

Since neither of the repos are in Packagist, you need to add them to your Laravel project's composer.json file:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/bradleyboy/laravel-braintree"
        },
        {
            "type": "vcs",
            "url": "https://github.com/mattjanssen/braintree_php"
        }
    ],

Then, include them as dependencies:

    "require": {
        "laravel/framework": "4.0.*",
        "braintree/braintree_php": "psr-0-dev",
        "bradleyboy/laravel-braintree": "dev-master",
    },
    
*Important: Be sure to specify the `psr-0-dev` branch for brantree/braintree_php so that it picks up Matt's fork.*

Finally, do a `composer install`.

Once installed, add the ServiceProvider to your provider array within `app/config/app.php`:

~~~
'providers' => array(

    'Bradleyboy\Laravel\BraintreeServiceProvider'

)
~~~

Finally, publish the configuration files via `php artisan config:publish bradleyboy/laravel-braintree`.

### Configuration

Once you have published the configuration files, you can set your various API keys in `app/config/packages/bradleyboy/laravel-braintree/braintree.php`:

~~~
<?php

return array(
	'environment'             => 'sandbox',
	'merchantId'              => 'my-merchant-id',
	'publicKey'               => 'my-public-key',
	'privateKey'              => 'my-private-key',
	'clientSideEncryptionKey' => 'my-client-side-encryption-key',
);
~~~

You can setup different environmental configurations by creating matching folders inside the `app/config/packages/bradleyboy/laravel-braintree` directory. For instance, if you have a `local` environment, add a config file at `app/config/packages/bradleyboy/laravel-braintree/local/braintree.php` for that environment.

### Usage

This service provider automaticall sets up the Braintree PHP library and also configures your API key from the configuration. Use the PHP library as normal, except that you will need to call the classes using the namespace. For example, instead of this:

~~~
Braintree_Transaction::sale( ...
~~~

Use:

~~~
Braintree\Transaction::sale( ...
~~~

In your Blade views, you may output your Braintree Client Side Encryption Key using the `@braintreeClientSideEncryptionKey` Blade extension:

~~~
<script type="text/javascript" src="https://js.braintreegateway.com/v1/braintree.js"></script>
<script type="text/javascript">
    var braintree = Braintree.create("@braintreeClientSideEncryptionKey");
    ...
</script>
~~~

