<?php
declare(strict_types=1);
namespace Creationell\Typo3Setup\Action;

use Helhum\ConfigLoader\Config;
use Helhum\ConfigLoader\ConfigurationReaderFactory;
use Helhum\TYPO3\ConfigHandling\ConfigDumper;
use Helhum\TYPO3\ConfigHandling\SettingsFiles;
use Helhum\Typo3Console\Install\Action\InstallActionInterface;
use Helhum\Typo3Console\Install\Action\InteractiveActionArguments;
use Helhum\Typo3Console\Mvc\Cli\CommandDispatcher;
use Helhum\Typo3Console\Mvc\Cli\ConsoleOutput;

class CreateReadmeAction implements InstallActionInterface
{
    /**
     * @var ConfigDumper
     */
    private $configDumper;

    /**
     * @var ConsoleOutput
     */
    private $output;

    /**
     * @var CommandDispatcher
     */
    private $commandDispatcher;

    public function __construct(ConfigDumper $configDumper = null)
    {
        $this->configDumper = $configDumper ?? new ConfigDumper();
    }

    public function setOutput(ConsoleOutput $output): void
    {
        $this->output = $output;
    }

    public function setCommandDispatcher(CommandDispatcher $commandDispatcher = null): void
    {
        $this->commandDispatcher = $commandDispatcher;
    }

    public function shouldExecute(array $actionDefinition, array $options = []): bool
    {
        return true;
    }

    public function execute(array $actionDefinition, array $options = []): bool
    {
        $readmeTemplate = '../../res/Readme.md';

    }
}
