<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {

    // Custom RTE config
    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['creationell'] = 'EXT:crea_theme_child/Configuration/RTE/Creationell.yaml';

});
