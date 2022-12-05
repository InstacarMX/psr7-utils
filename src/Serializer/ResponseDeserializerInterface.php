<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Serializer;

use Psr\Http\Message\ResponseInterface;

interface ResponseDeserializerInterface
{
    /**
     * @phpstan-template T of object
     *
     * @phpstan-param class-string<T> $responseClass
     *
     * @phpstan-return T
     */
    public function deserialize(ResponseInterface $response, string $responseClass, string $format): object;
}
