<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container): void {
    $container->extension(
        'framework',
        [
            'router' => [
                'utf8' => true,
                'strict_requirements' => true,
            ],
        ]
    );
};
