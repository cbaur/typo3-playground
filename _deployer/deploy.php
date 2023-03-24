<?php

namespace Deployer;

const __PROJECT_NAME__ = ''; // in lower-snail-case
const __SSH_USER__ = '';
const __SSH_HOST__ = ''; // preferably use IP address
const __DEPLOY_PATH__ = ''; // /var/www/clients/clientX/webY/web
const __TYPO3_WEB_ROOT__ = 'public';

require 'recipe/common.php';
//require_once(__DIR__ . '/vendor/sourcebroker/deployer-loader/autoload.php');
//new \SourceBroker\DeployerExtendedTypo3\Loader();

set('application', __PROJECT_NAME__);
//set('repository', 'git@github.com:creationell-dev/valairion.de_typo3-11_cv-technology.git');
// set('sub_directory', 'project/web');
set('keep_releases', 5);
set('typo3_webroot', __TYPO3_WEB_ROOT__);
set('shared_dirs', [
    'private-storage',
    '{{typo3_webroot}}/fileadmin',
    '{{typo3_webroot}}/typo3temp',
    '{{typo3_webroot}}/uploads'
]);
set('shared_files', [
    '.env',
    'config/override.settings.yaml',
]);
set('writable_dirs', [
    'config',
    'var',
    '{{typo3_webroot}}/fileadmin',
    '{{typo3_webroot}}/typo3temp',
    '{{typo3_webroot}}/uploads',
    '{{typo3_webroot}}/typo3conf'
]);
//set('bin/php', '/opt/php-8.1/bin/php');
//set('web_path', 'public/');
//set('composer_channel', 2);

host('live')
    ->hostname(__SSH_HOST__)
    ->user(__SSH_USER__)
    ->set('branch', 'main')
    //->set('public_urls', ['https://deployer-sample.c11.creationell.com'])
    ->set('deploy_path', __DEPLOY_PATH__);

// host('stage')
//     ->hostname(__SSH_HOST_STAGE__)
//     ->user(__SSH_USER_STAGE__)
//     ->set('branch', 'stage')
//     ->set('deploy_path', __DEPLOY_PATH_STAGE__); //'/var/www/clients/client2/web2/web'

task('deploy:update_code', static function () {
    upload('.', '{{release_path}}', [
        'options' => [
            '--exclude="/.*"',
            '--exclude=/package.json',
            '--exclude=/package-lock.json',
            '--exclude=/composer.lock',
            '--exclude=/deployer.phar',
            '--exclude=/Readme.md',
            '--exclude=/README.md',
            '--exclude=/CHANGELOG.md',
            '--exclude=/webpack.mix.js',
            '--exclude=/node_modules',
            '--exclude=/frontend',
            '--exclude=/_deploy',
            '--include=/**/frontend',
            '--include=/**/node_modules',
            '--include=/**/_deploy'
        ]
    ]);
});
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    //'deploy:vendors',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy the project.');

after('deploy', 'success');

after('deploy:failed', 'deploy:unlock');
