<?php namespace Fryiee\AddonComposerExtension\Console;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

/**
 * Class RunComposerCommand
 * @package Fryiee\AddonComposerExtension\Console
 */
class RunComposerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addon:composer {composerCommand} {--args=} {--flags=} {--exclude=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Composer commands on all addons simultaneously';

    /**
     * @var
     */
    private $addons;

    /**
     * @var array
     */
    private $exclude = [];

    /**
     * @var array
     */
    private $flags = [];

    /**
     * @var array
     */
    private $args = [];

    /**
     * RunComposerCommand constructor.
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        if (!empty($this->option('exclude'))) {
            $this->exclude = explode(',', $this->option('exclude'));
        }

        if (!empty($this->option('flags'))) {
            $this->flags = explode(',', $this->option('flags'));
        }

        if (!empty($this->option('args'))) {
            $this->args = explode(',', $this->option('args'));
        }

        $command = 'composer ' . $this->argument('composerCommand');
        if (count($this->args) > 0) {
            $command .= ' '.implode(' ', $this->args);
        }
        if (count($this->flags) > 0) {
            $command .= ' --'.implode(' --', $this->flags);
        }

        $confirmationText = 'Run '.$command.' on each addon';
        $confirmationText .= (count($this->exclude) > 0 ? ' (excluding '.$this->option('exclude').')' : '').'?';

        if ($this->confirm($confirmationText)) {
            /** @var Addon $addon */
            foreach ($this->getAddons($this->exclude) as $addon) {
                $this->info('Running command for ' . $addon->getNamespace());

                $composerProcess = new Process('(cd ' . $addon->getPath() . '; ' . $command . ')');
                $composerProcess->run(function ($type, $buffer) {
                    /** @todo see whether we can optimise to show different ANSI coloured rows */
                    echo $buffer;
                });
            }
        }
    }

    /**
     * @param array $excludes
     * @return AddonCollection
     */
    public function getAddons($excludes = [])
    {
        return $this->addons->filter(
            /** @var Addon $addon */
            function ($addon) use ($excludes) {
                return !$addon->isCore() &&
                    (count($excludes) > 0 ? !in_array($addon->getNamespace(), $excludes) : true);
            }
        );
    }
}