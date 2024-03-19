<?php

namespace Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class SpecTestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;
}
