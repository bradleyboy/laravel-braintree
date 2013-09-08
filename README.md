Braintree for Laravel 4
==============

Integrates the Braintree PHP library with Laravel 4 via a ServiceProvider, config, and Blade extensions.

### Installation

Include laravel-braintree as a dependency in composer.json:

~~~
"bradleyboy/laravel-braintree": "dev-master"
~~~

Run `composer install` to download the dependency.

Add the ServiceProvider to your provider array within `app/config/app.php`:

~~~
'providers' => array(

    'Bradleyboy\LaravelBraintree\LaravelBraintreeServiceProvider'

)
~~~

Finally, publish the configuration files via `php artisan config:publish bradleyboy/laravel-braintree`.

### Configuration

Once you have published the configuration files, you can set your various API keys in `app/config/packages/bradleyboy/laravel-braintree/braintree.php`:

### Usage

You may use the [Braintree PHP Library](https://www.braintreepayments.com/docs/php/guide/overview) as normal within your application. The Braintree API will automatically be configured with your API Key, so you do not need to set it yourself.

In your Blade views, you may output your Braintree Client Side Encryption Key using the `@braintreeClientSideEncryptionKey` Blade extension:

~~~
<script type="text/javascript" src="https://js.braintreegateway.com/v1/braintree.js"></script>
<script type="text/javascript">
    var braintree = Braintree.create("@braintreeClientSideEncryptionKey");
    ...
</script>
~~~

