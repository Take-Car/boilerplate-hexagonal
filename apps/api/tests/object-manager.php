<?php

use Infrastructure\Symfony\Kernel;

require __DIR__.'/../vendor/autoload.php';

$kernel = new Kernel($_ENV['APP_ENV'], (bool) $_ENV['APP_DEBUG']);
$kernel->boot();

return $kernel->getContainer()->get('doctrine')->getManager();
