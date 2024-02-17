<?php

namespace Domain\Query\Movie\All;

final readonly class Output
{
    public function __construct(public iterable $movies)
    {
    }
}