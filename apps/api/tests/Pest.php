<?php

use Tests\TestCase\UnitCase;
use Tests\TestCase\FeatureCase;

pest()->extend(UnitCase::class)->in('Unit');
pest()->extend(FeatureCase::class)->in('Feature');
