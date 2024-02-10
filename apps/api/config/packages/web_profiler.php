<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container, string $env): void {
    $container->extension(
        'web_profiler',
        [
            'toolbar' => 'dev' === $env,
            'intercept_redirects' => 'dev' === $env,
        ]
    );

    $container->extension(
        'framework',
        [
            'profiler' => [
                'only_exceptions' => false,
                'collect_serializer_data' => 'dev' === $env,
                'collect' => 'dev' === $env,
            ],
        ]
    );
};
