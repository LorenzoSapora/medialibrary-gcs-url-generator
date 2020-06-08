# Google Cloud Platform URL Generator for spatie's medialibrary
A missing Google Cloud Platform URL Generator for [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary).

## Installation
Add the package to your Laravel project using composer:

```bash
composer require terminalsio/medialibrary-gcs-url-generator
```

## Configuration
Set the class as the `url_generator` in `config/medialibrary.php`:

```php
'url_generator' => 'Terminalsio\GcsUrlGenerator\GcsUrlGenerator',
```

## Security

If you discover any security related issues, please send a message using any secure method listed here [terminals.io/security](https://keybase.io/sudos) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
