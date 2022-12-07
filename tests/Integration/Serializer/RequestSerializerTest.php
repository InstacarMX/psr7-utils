<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Integration\Serializer;

use Instacar\Psr7Utils\Serializer\RequestSerializer;
use Instacar\Psr7Utils\Test\Models\DummyModel;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class RequestSerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $serializer = new Serializer([new PropertyNormalizer()], [new JsonEncoder()]);
        $streamFactory = new Psr17Factory();
        $requestSerializer = new RequestSerializer($serializer, $streamFactory);
        $request = new Request('POST', 'https://example.com');

        $payload = new DummyModel('John', 'Doe', 29);
        $updatedRequest = $requestSerializer->serialize($request, $payload, 'json');

        $this->assertNotEquals($request, $updatedRequest);

        $body = (string) $updatedRequest->getBody();
        $this->assertEquals('{"firstName":"John","lastName":"Doe","age":29}', $body);
    }
}
