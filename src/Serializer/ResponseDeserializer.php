<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Serializer;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class ResponseDeserializer implements ResponseDeserializerInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize(ResponseInterface $response, string $responseClass, string $format): object
    {
        $responseBody = (string) $response->getBody();

        return $this->serializer->deserialize($responseBody, $responseClass, $format);
    }
}
