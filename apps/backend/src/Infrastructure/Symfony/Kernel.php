<?php

declare(strict_types=1);

namespace Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private function getConfigDir(): string
    {
        return $this->getProjectDir().'/src/Infrastructure/Symfony/config';
    }
}
