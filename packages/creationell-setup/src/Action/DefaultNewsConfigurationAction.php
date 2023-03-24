<?php
declare(strict_types=1);
namespace Creationell\Typo3Setup\Action;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception as DriverException;
use Helhum\TYPO3\ConfigHandling\ConfigDumper;
use Helhum\Typo3Console\Install\Action\InstallActionInterface;
use Helhum\Typo3Console\Mvc\Cli\CommandDispatcher;
use Helhum\Typo3Console\Mvc\Cli\ConsoleOutput;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DefaultNewsConfigurationAction implements InstallActionInterface
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

    /**
     * @var ConnectionPool
     */
    private $connectionPool;

    public function __construct(ConfigDumper $configDumper = null, ConnectionPool $connectionPool = null)
    {
        $this->configDumper = $configDumper ?? new ConfigDumper();
        $this->connectionPool = $connectionPool ?? GeneralUtility::makeInstance(ConnectionPool::class);
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
        if ($this->output->askConfirmation('Setup news extension? [Yn] ')) {
            [$newsPid, $newsStoragePid] = $this->addNewsPages();
            $databaseConnectionForContent = $this->connectionPool->getConnectionForTable('tt_content');
            $databaseConnectionForContent->insert('tt_content', [
                'pid' => $newsPid,
                'colPos' => 0,
                'crdate' => time(),
                'cruser_id' => 1,
                'tstamp' => time(),
                'CType' => 'list',
                'list_type' => 'news_pi1',
                'pi_flexform' => $this->getNewsFlexForm($newsStoragePid),
            ]);
            $this->addNewsTypoScript();
        }
        return true;
    }

    protected function addNewsPages(): array
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $databaseConnectionForPages = $connectionPool->getConnectionForTable('pages');
        $databaseConnectionForPages->insert(
            'pages',
            [
                'pid' => 1,
                'crdate' => time(),
                'cruser_id' => 1,
                'tstamp' => time(),
                'title' => 'News',
                'slug' => '/news',
                'doktype' => 1,
                'is_siteroot' => 0,
                'perms_userid' => 1,
                'perms_groupid' => 1,
                'perms_user' => 31,
                'perms_group' => 31,
                'perms_everybody' => 1,
            ]
        );
        $newsPid = $databaseConnectionForPages->lastInsertId('pages');
        $databaseConnectionForPages->insert(
            'pages',
            [
                'pid' => 0,
                'crdate' => time(),
                'cruser_id' => 1,
                'tstamp' => time(),
                'title' => 'News-Storage',
                'slug' => '/news-storage',
                'doktype' => 254,
                'is_siteroot' => 0,
                'perms_userid' => 1,
                'perms_groupid' => 1,
                'perms_user' => 31,
                'perms_group' => 31,
                'perms_everybody' => 1,
                'module' => 'news',
                'tsconfig_includes' => 'EXT:news/Configuration/TSconfig/Page/news_only.tsconfig',
                'TSconfig' => 'tx_news.showContentElementsInNewsSysFolder = 0'
            ]
        );
        $newsStoragePid = $databaseConnectionForPages->lastInsertId('pages');
        return [$newsPid, $newsStoragePid];
    }

    protected function getNewsFlexForm(string $startingPoint): string
    {
        return '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
<T3FlexForms>
    <data>
        <sheet index="sDEF">
            <language index="lDEF">
                <field index="switchableControllerActions">
                    <value index="vDEF">News-&gt;list;News-&gt;detail</value>
                </field>
                <field index="settings.orderBy">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.orderDirection">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.categoryConjunction">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.categories">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.includeSubCategories">
                    <value index="vDEF">0</value>
                </field>
                <field index="settings.archiveRestriction">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.timeRestriction">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.timeRestrictionHigh">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.topNewsRestriction">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.startingpoint">
                    <value index="vDEF">'. $startingPoint .'</value>
                </field>
                <field index="settings.recursive">
                    <value index="vDEF"></value>
                </field>
            </language>
        </sheet>
        <sheet index="additional">
            <language index="lDEF">
                <field index="settings.detailPid">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.listPid">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.backPid">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.limit">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.offset">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.tags">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.hidePagination">
                    <value index="vDEF">0</value>
                </field>
                <field index="settings.list.paginate.itemsPerPage">
                    <value index="vDEF">10</value>
                </field>
                <field index="settings.topNewsFirst">
                    <value index="vDEF">0</value>
                </field>
                <field index="settings.excludeAlreadyDisplayedNews">
                    <value index="vDEF">0</value>
                </field>
                <field index="settings.disableOverrideDemand">
                    <value index="vDEF">1</value>
                </field>
            </language>
        </sheet>
        <sheet index="template">
            <language index="lDEF">
                <field index="settings.media.maxWidth">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.media.maxHeight">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.cropMaxCharacters">
                    <value index="vDEF"></value>
                </field>
                <field index="settings.templateLayout">
                    <value index="vDEF"></value>
                </field>
            </language>
        </sheet>
    </data>
</T3FlexForms>';
    }

    protected function addNewsTypoScript()
    {
        $connection = $this->connectionPool->getQueryBuilderForTable('sys_template');
        try {
            $templates = $connection->select('uid', 'include_static_file')->from('sys_template')->executeQuery();
            while($template = $templates->fetchAssociative()) {
                if (
                    $template['include_static_file'] &&
                    false === stripos($template['include_static_file'],'EXT:news/Configuration/TypoScript')
                ) {
                    $template['include_static_file'] .= ',EXT:news/Configuration/TypoScript';
                    $connection->update('sys_template')
                        ->where($connection->expr()->eq('uid', $template['uid']))
                        ->set('include_static_file', $template['include_static_file'])
                        ->executeStatement();
                }
            }
        } catch (DBALException|DriverException $e) {
            $this->output->outputLine('Error while connecting to DB:');
            $this->output->output($e->getMessage());
            $this->output->outputLine('You will have to add the static template for EXT:news to your template by yourself if necessary.');
        }
    }
}
