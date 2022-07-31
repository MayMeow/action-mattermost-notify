<?php

require __DIR__ . '/vendor/autoload.php';

use Maymeow\ActionMattermostNotify\SendCommand;
use Symfony\Component\Console\Application;

$c = json_decode(file_get_contents(__DIR__ . '/composer.json'), true);

$app = new Application('Action Mattermost Notify', $c['version']);

$app->add(new SendCommand());

$app->run();
