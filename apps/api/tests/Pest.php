<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\SpecTestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/
uses(Tests\SpecTestCase::class)->in('Specs');
uses(Tests\FeatureTestCase::class)->in('Features');
