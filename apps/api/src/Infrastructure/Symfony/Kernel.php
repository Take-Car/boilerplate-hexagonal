<?php

namespace Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Attribute\Exclude;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

#[Exclude]
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->addResource(new FileResource($this->getConfigDir().'/bundles.php'));
        $confDir = $this->getConfigDir();

        $loader->load("{$confDir}/parameters.yaml");
        $loader->load("{$confDir}/services.yaml");
        $loader->load("{$confDir}/packages/*.yaml", 'glob');
    }
}
