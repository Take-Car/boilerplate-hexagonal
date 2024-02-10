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
            'Domain\\Command\\',
            '%kernel.project_dir%/src/Domain/Command/**/Handler.php'
        )
        ->load(
            'Domain\\Event\\',
            '%kernel.project_dir%/src/Domain/Event/**/Handler.php'
        )
        ->load(
            'Domain\\Query\\',
            '%kernel.project_dir%/src/Domain/Query/**/Handler.php'
        )
    ;
};
