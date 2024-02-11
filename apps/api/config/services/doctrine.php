<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->defaults()
        ->private()
        ->autowire()
    ;

    $services
        ->load(
            'Domain\\Collection\\',
            '%kernel.project_dir%/src/Domain/Collection'
        )
        ->load(
            'Infrastructure\\Doctrine\\Collection\\',
            '%kernel.project_dir%/src/Infrastructure/Doctrine/Collection'
        )
        ->load(
            'Infrastructure\\Doctrine\\Repository\\',
            '%kernel.project_dir%/src/Infrastructure/Doctrine/Repository'
        )
    ;
};
