<?php

declare(strict_types=1);

namespace Tests\Helper;

use Mockery as GlobalMockery;
use Mockery\MockInterface;

final readonly class Mockery
{
    /**
     * @template T of object
     *
     * @param class-string<T> $fqcn
     *
     * @return T&MockInterface
     */
    public static function mock(string $fqcn): MockInterface
    {
        return GlobalMockery::mock($fqcn);
    }
}
