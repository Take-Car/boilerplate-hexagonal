<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return function (ContainerConfigurator $container): void {
    $container->extension(
        'twig',
        [
            'default_path' => '%kernel.project_dir%/src/Infrastructure/Twig/templates',
            'strict_variables' => true,
        ]
    );
};
