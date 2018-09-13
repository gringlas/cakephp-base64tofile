# Base64ToFile plugin for CakePHP

## About

This plugin will convert a base64 encoded file string into a "classic" fileupload, like in $_FILES, which can then be passed to other fileuploads, like josegonzalez/cakephp-upload. 

## Installation

To install simply add it to your composer dependencies `composer require gringlas/cakephp-base64tofile`.
The plugin is mainly a behavior, which you should attach to your file entity: 

```php
$this->addBehavior('Base64ToFile.Base64ToFile', [
        'field' => 'file
    ]);
```
Where `field` contains the name of the field with the base64 encoded file.

