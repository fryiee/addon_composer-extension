<?php namespace Fryiee\AddonComposerExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Fryiee\AddonComposerExtension\Console\RunComposerCommand;

/**
 * Class AddonComposerExtensionServiceProvider
 * @package Fryiee\AddonComposerExtension
 */
class AddonComposerExtensionServiceProvider extends AddonServiceProvider
{
    protected $commands = [
        RunComposerCommand::class
    ];

}
