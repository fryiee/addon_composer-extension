# Addon Composer Extension
A PyroCMS 3 extension for the Addons Module which provides composer commands across all non-core addons.

## Installation
`composer require fryiee/addon_composer-extension`

## Usage
`php artisan addon:composer <command> --args=<arg1> --flags=<flag1> --excludes=<namespace.type.slug>`

You can add multiple args, flags or excludes by comma separating them, e.g. `--args=no-dev,prefer-dist`

## Examples
### Run composer install no-dev on all addons
`php artisan addon:composer install --flags=no-dev`
