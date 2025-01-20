<?php

use Tests\TestCase\FeatureCase;
use Tests\TestCase\UnitCase;

pest()->extend(UnitCase::class)->in('Unit');
pest()->extend(FeatureCase::class)->in('Feature');
