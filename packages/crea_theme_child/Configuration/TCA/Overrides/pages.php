<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'crea_theme_child',
    'Configuration/PageTS/tsconfig.txt',
    'EXT:crea_theme_child :: Add custom backend layouts');
