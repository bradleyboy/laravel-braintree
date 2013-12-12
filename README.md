Braintree for Laravel 4
==============

### Installation

In your Laravel project's composer.json file, add `laravel-braintree` as a dependency in the require object:

```js
"bradleyboy/laravel-braintree": "dev-master"
```
    
You do *not* need to add any other dependencies, as `laravel-braintree` loads in the other dependencies automatically.

Finally, do a `composer update`.

Once installed, add the ServiceProvider to your provider array within `app/config/app.php`:

```php
'providers' => array(

    'Bradleyboy\Laravel\BraintreeServiceProvider'

)
```

### Configuration

To publish a boilerplate configuration file, run:

```shell
php artisan config:publish bradleyboy/laravel-braintree
```

Then open `app/config/packages/bradleyboy/laravel-braintree/braintree.php` to setup your environment and keys:

```php
<?php

return array(
	'environment'             => 'sandbox',
	'merchantId'              => 'my-merchant-id',
	'publicKey'               => 'my-public-key',
	'privateKey'              => 'my-private-key',
	'clientSideEncryptionKey' => 'my-client-side-encryption-key',
);
```

You can setup different environmental configurations by creating matching folders inside the `app/config/packages/bradleyboy/laravel-braintree` directory. For instance, if you have a `local` environment, add a config file at `app/config/packages/bradleyboy/laravel-braintree/local/braintree.php` for that environment.

### Usage

Once setup, you can use the Braintree PHP classes as spelled out in the [documentation](https://www.braintreepayments.com/docs/php/transactions/overview).

#### braintree.js

If you are using [braintree.js](https://www.braintreepayments.com/docs/javascript), you can easily output your client side encryption key in your Blade views:

~~~html
<script type="text/javascript" src="https://js.braintreegateway.com/v1/braintree.js"></script>
<script type="text/javascript">
    var braintree = Braintree.create("@braintreeClientSideEncryptionKey");
    ...
</script>
~~~

### Credits

Thanks to the [Abodeo/laravel-stripe](https://github.com/Abodeo/laravel-stripe) package, as I used it as a starting point.
