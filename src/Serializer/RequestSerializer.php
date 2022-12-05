<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Serializer;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class RequestSerializer implements RequestSerializerInterface
{
    private SerializerInterface $serializer;

    private StreamFactoryInterface $streamFactory;

    public function __construct(
        SerializerInterface $serializer,
        StreamFactoryInterface $streamFactory,
    ) {
        $this->serializer = $serializer;
        $this->streamFactory = $streamFactory;
    }

    public function serialize(RequestInterface $request, mixed $payload, string $format): RequestInterface
    {
        $serializedPayload = $payload !== null ? $this->serializer->serialize($payload, $format) : '';
        $body = $this->streamFactory->createStream($serializedPayload);

        return $request->withBody($body);
    }
}
