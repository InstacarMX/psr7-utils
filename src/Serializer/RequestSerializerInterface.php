<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Serializer;

use Psr\Http\Message\RequestInterface;

interface RequestSerializerInterface
{
    public function serialize(RequestInterface $request, mixed $payload, string $format): RequestInterface;
}
