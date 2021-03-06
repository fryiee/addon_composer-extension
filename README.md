# Addon Composer Extension
A PyroCMS 3 extension for the Addons Module which provides composer commands across all non-core addons
(Note: This means it will currently only run on addons in the `addons/` folder, not those installed via Composer.)

## Installation
`composer require fryiee/addon_composer-extension`

If you are installing this on an existing project, then you will also want to run:

`php artisan addon:install fryiee.extension.addon_composer`

## Usage
`php artisan addon:composer <command> --args=<arg1> --flags=<flag1> --excludes=<namespace.type.slug>`

You can add multiple args, flags or excludes by comma separating them, e.g. `--args=no-dev,prefer-dist`

The extension will confirm the parsed command and any exclusions before running, e.g.

`Run composer install --no-dev on each addon (excluding rt.module.profiles)? (yes/no) [no]:`

## Examples
### Run composer install no-dev on all addons
`php artisan addon:composer install --flags=no-dev`
