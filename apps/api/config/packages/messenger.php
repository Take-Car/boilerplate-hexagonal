<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container, string $env): void {
    $container->extension(
        'framework',
        [
            'messenger' => [
                'transports' => [
                        'async' => '%env(resolve:MESSENGER_TRANSPORT_DSN)%',
                        'sync' => 'sync://',
                ],
                'default_bus' => 'transactional.bus',
                'buses' => [
                    'transactional.bus' => [
                        'middleware' => [
                            'doctrine_transaction',
                        ],
                    ],
                    'simple.bus' => [],
                ],

                'routing' => [
                    'Domain\\Command\\CommandInterface' => 'sync',
                    'Domain\\Query\\QueryInterface' => 'sync',
                    'Domain\\Event\\EventInterface' => 'async',
                ],
            ],
        ]
    );
};
