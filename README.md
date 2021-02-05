[![Travis (.com)](https://img.shields.io/travis/com/timjmasters/php-base64url?style=for-the-badge)](https://travis-ci.com/timjmasters/php-base64url)
[![License](https://img.shields.io/github/license/timjmasters/php-base64url?color=blue&style=for-the-badge)](https://www.gnu.org/licenses/gpl-3.0.en.html)

# php-base64url
Some Tools for encoding data as URL safe Base64 strings

## Usage
### Installation
Install using composer:
`composer require timjmasters/php-base64url`

If using composer autoloader don't forget to `composer dump-autoload`

Use it in your code:
```php
// Don't forget your use statements!
use TimJMasters\Base64URL\Base64URL;

$encoded = Base64URL::encode("foo");
// $encoded = "Zm9v"

$decoded = Base64URL::decode("YmFy");
// $decoded = "bar"
```

That's it! I hope it's useful

