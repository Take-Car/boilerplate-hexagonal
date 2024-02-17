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
            'Application\\Controller\\',
            '%kernel.project_dir%/src/Application/Controller/**/*Controller.php'
        )
        ->tag('controller.service_arguments')
        ->private()
        ->autowire()
    ;
};
