<?php

use Tests\TestCase\FeatureCase;
use Tests\TestCase\UnitCase;

pest()->extend(UnitCase::class)->group('unit')->in('Unit');
pest()->extend(FeatureCase::class)->group('feature')->in('Feature');
