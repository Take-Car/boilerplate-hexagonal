<?php

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        '/opt/code/config',
        '/opt/code/public',
        '/opt/code/src',
        '/opt/code/tests',
    ]);
    $rectorConfig->rule(TypedPropertyFromStrictConstructorRector::class);
    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::PHP_83,
    ]);
};
