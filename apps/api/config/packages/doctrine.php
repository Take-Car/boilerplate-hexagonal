<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container, string $env): void {
    $container->extension(
        'doctrine',
        [
            'dbal' => [
                'dbname' => '%env(DATABASE_NAME)%',
                'host' => '%env(DATABASE_HOST)%',
                'port' => '%env(DATABASE_PORT)%',
                'user' => '%env(DATABASE_USER)%',
                'password' => '%env(DATABASE_PASSWORD)%',
                'charset' => '%env(DATABASE_CHARSET)%',
                'server_version' => '%env(DATABASE_VERSION)%',
                'driver' => 'pdo_mysql',
                'profiling_collect_backtrace' => '%kernel.debug%',
                'dbname_suffix' => 'test' === $env ? '_test' : '',
            ],
            'orm' => [
                'auto_generate_proxy_classes' => 'prod' !== $env,
                'enable_lazy_ghost_objects' => true,
                'report_fields_where_declared' => true,
                'validate_xml_mapping' => true,
                'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
                'auto_mapping' => true,
                'mappings' => [
                    'Model' => [
                        'type' => 'xml',
                        'is_bundle' => false,
                        'dir' => '%kernel.project_dir%/src/Infrastructure/Doctrine/ORM/Model',
                        'prefix' => 'Domain\\Model',
                    ],
                ],
                'proxy_dir' => 'prod' === $env
                    ? '%kernel.build_dir%/doctrine/orm/Proxies'
                    : '%kernel.cache_dir%/doctrine/orm/Proxies',
                'query_cache_driver' => 'prod' === $env
                    ? ['type' => 'pool', 'pool' => 'doctrine.system_cache_pool']
                    : null,
                'result_cache_driver' => 'prod' === $env
                    ? ['type' => 'pool', 'pool' => 'doctrine.result_cache_pool']
                    : null,
            ],
        ]);
};
