<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Utils;

final class IterableUtils
{
    public static function iterableToArray(iterable $iterable): array
    {
        return $iterable instanceof \Traversable ? iterator_to_array($iterable) : (array) $iterable;
    }
}
