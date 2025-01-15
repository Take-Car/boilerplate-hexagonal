<?php

namespace Tests\TestCase;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class UnitCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;
}
