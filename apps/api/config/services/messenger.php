<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Application\BusInterface;
use Infrastructure\Messenger\Bus;

return function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->set(Bus::class);
    $services->alias(BusInterface::class, Bus::class);

    $services
        ->load(
            'Domain\\Command\\',
            '%kernel.project_dir%/src/Domain/Command/**/Handler.php'
        )
        ->tag('messenger.message_handler', ['bus' => 'transactional.bus'])
    ;

    $services
        ->load(
            'Domain\\Event\\',
            '%kernel.project_dir%/src/Domain/Event/**/Handler.php'
        )
        ->load(
            'Domain\\Query\\',
            '%kernel.project_dir%/src/Domain/Query/**/Handler.php'
        )
        ->tag('messenger.message_handler', ['bus' => 'simple.bus'])
    ;
};
