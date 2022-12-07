<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Integration\Utils;

use Instacar\Psr7Utils\Utils\UriUtils;
use Nyholm\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;

class UriUtilsTest extends TestCase
{
    public function mockUri(): UriInterface
    {
        return new Uri('https://example.org/');
    }

    public function testParams(): void
    {
        $uri = new Uri('https://example.org/');
        $updatedUri = UriUtils::withParams($uri, ['test' => 'true', 'data' => 'hello']);

        $this->assertNotEquals($uri, $updatedUri, 'should be a clone');

        $query = $updatedUri->getQuery();
        $this->assertEquals('test=true&data=hello', $query);

        $params = UriUtils::getParams($updatedUri);
        $this->assertCount(2, $params);
        $this->assertArrayHasKey('test', $params);
        $this->assertArrayHasKey('data', $params);

        $testParam = $params['test'];
        $this->assertEquals('true', $testParam);

        $dataParam = $params['data'];
        $this->assertEquals('hello', $dataParam);
    }
}
