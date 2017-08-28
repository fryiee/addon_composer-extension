<?php namespace Fryiee\AddonComposerExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class AddonComposerExtension
 * @package Fryiee\AddonComposerExtension
 */
class AddonComposerExtension extends Extension
{

    /**
     * This extension provides...
     *
     * This should contain the dot namespace
     * of the addon this extension is for followed
     * by the purpose.variation of the extension.
     *
     * For example anomaly.module.store::gateway.stripe
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.addons::console.composer';

}
