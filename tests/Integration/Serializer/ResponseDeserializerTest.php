<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Integration\Serializer;

use Instacar\Psr7Utils\Serializer\RequestSerializer;
use Instacar\Psr7Utils\Serializer\ResponseDeserializer;
use Instacar\Psr7Utils\Test\Models\DummyModel;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseDeserializerTest extends TestCase
{
    public function testDeserialize(): void
    {
        $deserializer = new Serializer([new PropertyNormalizer()], [new JsonEncoder()]);
        $responseDeserializer = new ResponseDeserializer($deserializer);
        $response = new Response(body: '{"firstName":"John","lastName":"Doe","age":29}');

        $payload = $responseDeserializer->deserialize($response, DummyModel::class, 'json');
        $this->assertIsObject($payload);
        $this->assertObjectHasAttribute('firstName', $payload);
        $this->assertObjectHasAttribute('lastName', $payload);
        $this->assertObjectHasAttribute('age', $payload);
        $this->assertEquals('John', $payload->firstName);
        $this->assertEquals('Doe', $payload->lastName);
        $this->assertEquals(29, $payload->age);
    }
}
