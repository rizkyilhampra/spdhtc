<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:rizkyilhampra/spdhtc.git');

// it will be override by laravel recipe. See https://deployer.org/docs/7.x/recipe/laravel
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('spdhtc.rizkyilhampra.me')
    ->set('hostname', getenv('HOSTNAME'))
    ->set('remote_user', getenv('REMOTE_USER'))
    ->set('deploy_path', getenv('DEPLOY_PATH'));

// Tasks

task('deploy:secrets', function () {
    file_put_contents(__DIR__.'/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path').'/shared');
});

task('deploy', [
    'deploy:prepare',
    'deploy:secrets',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:optimize:clear',
    'deploy:publish',
]);

// Hooks

after('deploy:failed', 'deploy:unlock');
