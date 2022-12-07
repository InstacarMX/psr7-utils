<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Integration\Utils;

use Instacar\Psr7Utils\Utils\RequestUtils;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class RequestUtilsTest extends TestCase
{
    public function testBasicAuthorization(): void
    {
        $request = new Request('GET', 'https://example.com/');
        $updatedRequest = RequestUtils::withBasicAuthorization($request, 'test', '1234');

        $this->assertNotEquals($request, $updatedRequest, 'should be a clone');

        $authorizationHeader = $updatedRequest->getHeader('Authorization');
        $this->assertCount(1, $authorizationHeader);
        $this->assertEquals('Basic dGVzdDoxMjM0', $authorizationHeader[0]);
    }

    public function testBearerAuthorization(): void
    {
        $request = new Request('GET', 'https://example.com/');
        $updatedRequest = RequestUtils::withBearerAuthorization($request, 'token123');

        $this->assertNotEquals($request, $updatedRequest, 'should be a clone');

        $authorizationHeader = $updatedRequest->getHeader('Authorization');
        $this->assertCount(1, $authorizationHeader);
        $this->assertEquals('Bearer token123', $authorizationHeader[0]);
    }

    public function testHeaders(): void
    {
        $request = new Request('GET', 'https://example.com/');
        $updatedRequest = RequestUtils::withHeaders($request, [
            'Accept' => 'application/json',
            'Content-Type' => 'text/plain',
            'X-Custom-Header' => 'test',
        ]);

        $this->assertNotEquals($request, $updatedRequest, 'should be a clone');

        $headers = $updatedRequest->getHeaders();
        $this->assertCount(4, $headers); // This includes the "Host" header
        $this->assertArrayHasKey('Accept', $headers);
        $this->assertArrayHasKey('Content-Type', $headers);
        $this->assertArrayHasKey('X-Custom-Header', $headers);

        $acceptHeader = $headers['Accept'];
        $this->assertCount(1, $acceptHeader);
        $this->assertEquals('application/json', $acceptHeader[0]);

        $contentTypeHeader = $headers['Content-Type'];
        $this->assertCount(1, $contentTypeHeader);
        $this->assertEquals('text/plain', $contentTypeHeader[0]);

        $customHeader = $headers['X-Custom-Header'];
        $this->assertCount(1, $customHeader);
        $this->assertEquals('test', $customHeader[0]);
    }
}
