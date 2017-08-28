<?php namespace Fryiee\AddonComposerExtension\Test\Unit\Console;

use Fryiee\AddonComposerExtension\Console\RunComposerCommand;

/**
 * Class RunComposerCommandTest
 * @package Fryiee\AddonComposerExtension\Test\Unit\Console
 */
class RunComposerCommandTest extends \TestCase
{
    public function testCommandDoesNotReturnCoreAddons()
    {
        $console = app(RunComposerCommand::class);

        $this->assertFalse($console->getAddons()->contains('namespace', 'anomaly.module.users'));
    }

    public function testCommandFiltersExcludedCorrectly()
    {
        $console = app(RunComposerCommand::class);
        $this->assertFalse($console->getAddons(['fryiee.extension.addon_composer'])->contains('namespace', 'fryiee.extension.addon_composer'));
    }
}
