# php-gpg-keyinfo

See: https://github.com/gpg/gnupg/blob/gnupg-2.2.9/doc/DETAILS

## Usage

```php
require 'vendor/autoload.php';

use NINEJKH\GPGkeyinfo\Parser;

$parser = new Parser(file_get_contents(__DIR__ . '/example.txt'));

foreach ($parser as $keyinfo) {
    var_dump($keyinfo);

    foreach ($keyinfo as $record) {
        if ($record->hasCapabilities()) {
            var_dump($record->canEncrypt());
        }
    }
}
```

