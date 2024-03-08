<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:rizkyilhampra/spdhtc.git');

add('shared_files', ['.env']);
add('shared_dirs', ['storage']);
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/framework',
    'storage/logs',
]);

// Hosts

host('spdhtc.rizkyilhampra.me')
    ->set('remote_user', 'rizkyilhampra-spdhtc')
    ->set('deploy_path', '~/htdocs/spdhtc.rizkyilhampra.me');

// Hooks

after('deploy:failed', 'deploy:unlock');
