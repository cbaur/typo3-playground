<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'crea_theme_bs4_child',
    'Configuration/PageTS/tsconfig.txt',
    'EXT:crea_theme_bs4_child :: Add custom backend layouts');
