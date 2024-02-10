<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container): void {
    $container->extension(
        'doctrine_migrations',
        [
            'migrations_paths' => [
                'Migrations' => '%kernel.project_dir%/src/Migrations',
            ],
            'enable_profiler' => false,
            'storage' => [
                'table_storage' => [
                    'table_name' => 'migration_versions',
                    'version_column_name' => 'version',
                    'executed_at_column_name' => 'executed_at',
                ],
            ],
            'all_or_nothing' => true,
            'check_database_platform' => true,
        ]
    );
};
