# Laravel Tailwind Config

I've recently found myself using Tailwind more and more but have run into a few situations where I need to access tailwind config values within my blade templates. The most recent event occurred when building a admin section and i needed to access a color defined within the tailwind config file to pass to a charting library. Instead of hardcoding the value I decided to create this library

## Installation

```bash
composer require approvedio/laravel-tailwind-config
```

### Laravel 5.5+

The application service provider and facade will be automatically registered for you.

### Laravel 5.4 and Below

Add the service provider to your app.php config file

```
ApprovedDigital\LaravelTailwindConfig\LaravelTailwindConfigServiceProvider::class,
```

Optionally you can add the facade to the Aliases section of your app.php config file

```
'Tailwind' => ApprovedDigital\LaravelTailwindConfig\Facades\LaravelTailwindConfigFacade::class.
```

## Usage

You can use the facade

```php
Tailwind::get('colors.red-light', '#FF0000');
```

You can use the helper method

```php
tailwind('colors.ted-light', '#FF0000');
```

## Config

By default we assume your tailwind config file is called tailwind.js in the root of your project. you can override this configuration by publishing the config and updating the path to your tailwind.js file.

```php
'tailwind_config_file' => base_path('tailwind.json'),
```

To generate the tailwind.json file from your config you will need to add the following Mix extension to your webpack.mix.js

```js
mix.extend('exportTailwindConfig', function(webpackConfig, configPath = './tailwind.js') {
    let fs = require('fs');
    let config = require(configPath);
    let json = JSON.stringify(config, null, 2);

    fs.writeFile('./tailwind.json', json);
});
```

And then call the following mix function to generate this file

```js
mix.exportTailwindConfig('./tailwind.js');
```

##Future Development

- Extract Tailwind Config Extractor into a dedicated package and less janky package
