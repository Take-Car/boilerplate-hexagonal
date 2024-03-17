<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class FeatureTestCase extends BaseTestCase
{
    private static array $helpers;

    public function __construct(string $name)
    {
        parent::__construct($name);

        static::$helpers = [
            Helper\Http::class,
        ];
    }

    #[\Override]
    protected function setUp(): void
    {
        foreach (static::$helpers as $helper) {
            $helper::setUp();
        }
    }

    #[\Override]
    protected function tearDown(): void
    {
        foreach (static::$helpers as $helper) {
            $helper::tearDown();
        }
    }

    #[\Override]
    public static function setUpBeforeClass(): void
    {
        foreach (static::$helpers as $helper) {
            $helper::setUpBeforeClass();
        }
    }

    #[\Override]
    public static function tearDownAfterClass(): void
    {
        foreach (static::$helpers as $helper) {
            $helper::tearDownBeforeClass();
        }
    }
}
