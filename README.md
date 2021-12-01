# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Instalando o Lument Passport

GitHub [dusterio/lumen-passport](https://github.com/dusterio/lumen-passport)

### Via composer

```bash
$ composer require dusterio/lumen-passport
```

### Configurações

Altere o arquivo ```bootstrap/app.php```

```php

// $app->register(App\Providers\EventServiceProvider::class);
// $app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);                   //Descomentar
$app->register(Laravel\Passport\PassportServiceProvider::class);            //Criar
$app->register(Dusterio\LumenPassport\PassportServiceProvider::class);      //Criar

```

### Migrate and install Laravel Passport

```bash
# Create new tables for Passport
php artisan migrate

# Install encryption keys and other necessary stuff for Passport
php artisan passport:install
```

Após rodar o passport:install será criado as chaves publica e privada em storage. Altere o arquivo ```.gitignore``` para não tornar essas chaves públicas.

```text

storage/*.key

```

### Configurações 

Altere o arquivo ```App\Providers\AuthServiceProvider```

```php

use Dusterio\LumenPassport\LumenPassport;

## code

public function boot()
{
    // Here you may define how you wish users to be authenticated for your Lumen
    // application. The callback which receives the incoming request instance
    // should return either a User instance or null. You're free to obtain
    // the User instance via an API token or any other method necessary.

    // $this->app['auth']->viaRequest('api', function ($request) {
    //     if ($request->input('api_token')) {
    //         return User::where('api_token', $request->input('api_token'))->first();
    //     }
    // });

    LumenPassport::routes($this->app->router);
}

```

Copie o conteúdo do arquivo ```vendor\laravel\lumen-framework\config\auth.php```

Crie um arquivo chamado ```config\auth.php``` e cole o conteúdo copiado nesse arquivo.

Agora faça as seguintes alterações no arquivo criado.

```php

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    */

    'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ]
    ],

```

Altere novamente o arquivo ```bootstrap/app.php```

```php

/**
 * Register config files
 */

$app->configure('services');
$app->configure('auth');            //Adicionar

```

Faça um teste nos endpoints referente as litages de authors e books no gateway


### Configurar o Midddleware

Altere o arquivo ```bootstrap/app.php```


```php
/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
*/

$app->routeMiddleware([
    'client.credentials' => Laravel\Passport\Http\Middleware\CheckClientCredentials::class,
]);

```

### Protegendo as rotas

Altere o arquivo ```routes\web.php```

```php
$router->group(['middleware' => 'client.credentials'], function() use ($router) { 
    #ROTAS
    #ROTAS
    #ROTAS
});
```