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

class SetupWebpackAction implements InstallActionInterface
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
        $argumentDefinitions = $actionDefinition['arguments'] ?? [];
        $interactiveArguments = new InteractiveActionArguments($this->output);
        $arguments = $interactiveArguments->populate($argumentDefinitions, $options);
        if ($arguments['fontawesomeToken'] === '') {
            return true;
        }
        return $this->createNpmrcFile($arguments['fontawesomeToken']);
    }

    private function createNpmrcFile($token): bool
    {
        $npmrcFile = getenv('TYPO3_PATH_COMPOSER_ROOT') . '/.npmrc';
        if (!file_exists($npmrcFile)) {
            if (file_put_contents($npmrcFile, [
                '@fortawesome:registry=https://npm.fontawesome.com/',
                PHP_EOL,
                '//npm.fontawesome.com/:_authToken=',
                $token
                ]
            ) !== false) {
                $this->output->outputLine('.npmrc created successfully. Ready to run npm install && npm run dev');
                return true;
            }
        } else {
            $this->output->outputLine('.npmrc already exists. Skipping.');
            return true;
        }
        return false;
    }
}
