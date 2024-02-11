<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container, string $env): void {
    $container->extension(
        'framework',
        [
            'secret' => '%env(APP_SECRET)%',
            'http_method_override' => false,

            'session' => [
                'handler_id' => null,
                'cookie_secure' => 'auto',
                'cookie_samesite' => 'lax',
                'storage_factory_id' => 'test' !== $env
                    ? 'session.storage.factory.native'
                    : 'session.storage.factory.mock_file',
            ],

            'php_errors' => [
                'log' => true,
            ],
            'test' => 'test' === $env,
            'cache' => 'prod' === $env
                ? [
                    'pools' => [
                        'doctrine.result_cache_pool' => [
                            'adapter' => 'cache.app',
                        ],
                        'doctrine.system_cache_pool' => [
                            'adapter' => 'cache.system',
                        ],
                    ],
                ]
                : [],
        ]
    );
};
