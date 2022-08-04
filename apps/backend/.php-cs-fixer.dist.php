<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = new Finder();
$finder->in([__DIR__ . '/src', __DIR__ . '/public', __DIR__ . '/config']);

$config = new Config();
$config
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true
    ])
    ->setFinder($finder)
;

return $config;
